<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
Use App\CartProduct;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/carts/{id}', 'CartProductController@addItem');
Route::put('/carts/{id}', 'CartProductController@editItem');
Route::delete('/carts/{id}', 'CartProductController@deleteItem');
Route::post('/carts/{id}/discount', 'CartController@attachDiscountToCart');
Route::get('/carts/{id}', 'CartController@getCartContent');
