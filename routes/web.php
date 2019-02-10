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

/*Route::get('/', function () {
    return view('shop.index');
});*/
Route::get('/', 'ProductController@index')->name('shop.index');
Route::get('whiskey', 'ProductController@whiskey')->name('shop.index');
Route::get('vodka', 'ProductController@vodka')->name('shop.index');
// Route::get('cart', 'ProductController@cart')->name('shop.shoppingcart');
Route::get('wishlist', 'ProductController@wishlist')->name('shop.wishlist');
Route::get('/add-to-cart/{id}','ProductController@getAddToCart')->name('product.addToCart');


