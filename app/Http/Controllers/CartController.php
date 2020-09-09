<?php

namespace App\Http\Controllers;

use App\Cart;
use App\CartProduct;
use App\Discount;
use App\Product;
use Illuminate\Http\Request;
use App\Dtos\ItemDTO;
use App\Dtos\SummaryDTO;
use App\Dtos\DiscountDTO;
use App\Dtos\CartDTO;

class CartController extends Controller
{
    
    public function attachDiscountToCart(Request $request, $id) {
        $cart = Cart::find($id);

        $discount_code = $request->discount_code;
        $discount = Discount::where('code', $discount_code)->first();
        $discount_id = $discount->id;

        $cart->discounts()->attach($discount_id);

        return response()->json(
                $cart->discounts()->get()
        );
    }

    public function getCartContent($id) {
        $cart = Cart::find($id);
        $cartProducts = CartProduct::where('cart_id', $id)->get();
        $items = [];
        $discountArray = [];
        $taxSum = 0;
        $totalSum = 0;
        $priceOriginalSum = 0;
        $discount_amount = 0;

        $TAX = config('app.tax');

        $cart_id = $cart->id;

        foreach ($cartProducts as $cartProduct) { 
            $product = Product::find($cartProduct->product_id);
            $quantity = $cartProduct->quantity;
            $price = $product->price;
            $totalPrice = $price * $quantity;

            $itemDTO = new ItemDTO();
            $itemDTO->row_id = $cartProduct->row_id;
            $itemDTO->product_id = $product->id;
            $itemDTO->qty = $quantity;
            $itemDTO->price = $price;
            $itemDTO->options = $product->productImages()->pluck('url');
            $itemDTO->tax = (($price * $TAX) / 100) * $quantity;
            $itemDTO->subtotal = $totalPrice + $itemDTO->tax;
            
            $taxSum += $itemDTO->tax;
            $totalSum += $itemDTO->subtotal;
            $priceOriginalSum += $price;

            array_push($items, $itemDTO);
        }

        foreach ($cart->discounts()->get() as $discount) {
            $discountDTO = new DiscountDTO();
            $discountDTO->code =  $discount->code;
            $discountDTO->value =  $discount->percentage;
            $discountDTO->discounted_amount =  ($priceOriginalSum * $discount->percentage) / 100;
            $discount_amount += $discountDTO->discounted_amount;
            array_push($discountArray, $discountDTO);
        }

        $summaryDTO = new SummaryDTO();
        $summaryDTO->discount_amount = $discount_amount;
        $summaryDTO->tax = $taxSum;
        $summaryDTO->total_amount = $totalSum - $summaryDTO->discount_amount - $taxSum;

        $cartDTO = new CartDTO();
        $cartDTO->identifier = $cart_id;
        $cartDTO->items = $items;
        $cartDTO->discount = $discountArray;
        $cartDTO->summary = $summaryDTO;


        return response()->json(
                ['cart' => $cartDTO]
        );
    }

}
