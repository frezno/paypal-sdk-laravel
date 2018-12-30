<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', 'HomeController@index');

//-- Cart
Route::post('addtocart', 'CartController@addToCart');
Route::get('cart', 'CartController@getCart');
Route::get('remove/{id}', 'CartController@removeFromCart');
Route::get('delete_cart', 'CartController@deleteCart');
Route::get('add_qty/{id}', 'CartController@addQuantity');
Route::get('sub_qty/{id}', 'CartController@subtractQuantity');

//-- Checkout
Route::group(['prefix' => 'checkout'], function () {
    Route::get('address', 'CheckoutController@address');
    Route::get('confirm', 'CheckoutController@confirm');
    Route::post('confirmed', 'CheckoutController@gotConfirmation');
});

//-- Paypal Payment
// Route::get('checkout_paypal', 'PaypalController@preparePayment');
// Route::get('pay_paypal/payit', [
//     'as' => 'paypal.execute',
//     'uses' => 'PaypalController@executePayment']);
