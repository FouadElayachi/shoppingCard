<?php

namespace App\Http\Controllers;

use App\CartProduct;
use App\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CartProductController extends Controller
{

    public function addItem(Request $request, $id) {
        $this->validate($request, array(
            'product_id'   => 'required|integer',
            'quantity'   => 'required|integer',
        ));

        $cart = Cart::find($id);

        $cartProduct = new CartProduct;
        $cartProduct->product_id = $request->product_id;
        $cartProduct->cart_id = $id;
        $cartProduct->quantity = $request->quantity;
        $cartProduct->row_id = Str::random(20);
        $cartProduct->save();
        return response()->json($cartProduct, 201);
    }

    public function editItem(Request $request, $id) {
        $this->validate($request, array(
            'product_id'   => 'required|integer',
            'quantity'   => 'required|integer',
            'row_id'   => 'required|max:20',
        ));

        $product_id = $request->input('product_id');

        $cartProduct = CartProduct::where('product_id', $product_id)->where('cart_id', $id)->first();
        $cartProduct->quantity = $request->input('quantity');
        $cartProduct->row_id = $request->input('row_id');
        $cartProduct->save();
        return response()->json($cartProduct, 201);
    }

    public function deleteItem(Request $request, $id) {
        $this->validate($request, array(
            'row_id'   => 'required|max:20',
        ));

        $row_id = $request->input('row_id');

        $cartProduct = CartProduct::where('row_id', $row_id)->where('cart_id', $id)->first();
        $cartProduct->delete();

        // Testing the api by returning a response
        if($cartProduct->first()) {
            $response =  "NOk";
        }
        $response =  "Ok";
        return $response;
    }
}
