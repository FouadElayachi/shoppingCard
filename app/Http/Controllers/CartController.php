<?php

namespace App\Http\Controllers;

use App\Cart;
use App\CartProduct;
use App\Discount;
use App\Product;
use Illuminate\Http\Request;
use App\Dtos\ItemDTO;

class CartController extends Controller
{
    
    public function attachDiscountToCart(Request $request, $id) {
        $cart = Cart::find($id);

        $discount_code = $request->discount_code;
        $discount = Discount::where('code', $discount_code)->first();
        $discount_id = $discount->id;

        $cart->discounts()->attach($discount_id);
    }

    public function getCartContent($id) {
        $cart = Cart::find($id);
        $cartProducts = CartProduct::where('cart_id', $id)->get();
        $items = [];

        $cart_id = $cart->id;

        foreach ($cartProducts as $cartProduct) { 
            $product = Product::find($cartProduct->product_id);
            $itemDTO = new ItemDTO();
            $itemDTO->row_id = $cartProduct->row_id;
            $itemDTO->product_id = $product->id;
            $itemDTO->qty = $cartProduct->qty;
            $itemDTO->price = $product->price;
            $itemDTO->options = $product->productImages()->get();
            array_push($items, $itemDTO);
        }

        return response()->json(
                ['cart' => $items]
        );
    }

}
