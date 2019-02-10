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


Route::get('/', 'ProductController@index')->name('shop.index');
Route::get('whiskey', 'ProductController@whiskey')->name('shop.index');
Route::get('vodka', 'ProductController@vodka')->name('shop.index');
Route::get('sorttitleeasc', 'ProductController@sortpriceasc')->name('shop.index');
Route::get('sorttitledesc', 'ProductController@sortpricedesc')->name('shop.index');
Route::get('sorttitlevodkaasc', 'ProductController@sorttitlevodkaasc')->name('shop.index');
Route::get('sorttitlevodkadesc', 'ProductController@sorttitlevodkadesc')->name('shop.index');
Route::get('sorttitlewhiskeyasc', 'ProductController@sorttitlewhiskeyasc')->name('shop.index');
Route::get('sorttitlewhiskeydesc', 'ProductController@sorttitlewhiskeydesc')->name('shop.index');
Route::get('cart', 'ProductController@cart')->name('shop.shoppingcart');
Route::get('wishlist', 'ProductController@wishlist')->name('shop.wishlist');
Route::get('/add-to-cart/{id}','ProductController@getAddToCart')->name('product.addToCart');
Route::get('/deleteItem/{id}', 'ProductController@deleteItem')->name('product.deleteItem');
Route::get('deletecart', 'ProductController@deleteCart')->name('product.deleteCart');
Route::get('/add-to-wishlist/{id}','ProductController@getAddToWishlist')->name('product.addToWishlist');


