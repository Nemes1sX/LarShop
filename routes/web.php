<?php

use Illuminate\Support\Facades\Route;

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

Route::name('product.*')->controller(\App\Http\Controllers\ProductController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('whiskey', 'whiskey')->name('index');
    Route::get('vodka', 'vodka')->name('index');
    Route::get('sorttitleeasc', 'sorttitleasc')->name('index');
    Route::get('sorttitledesc', 'orttitledesc')->name('index');
    Route::get('sorttitlevodkaasc', 'sorttitlevodkaasc')->name('shop.index');
    Route::get('sorttitlevodkadesc', 'orttitlevodkadesc')->name('shop.index');
    Route::get('sorttitlewhiskeyasc', 'sorttitlewhiskeyasc')->name('shop.index');
    Route::get('sorttitlewhiskeydesc', 'sorttitlewhiskeydesc')->name('shop.index');
    Route::post('search', 'postSearch')->name('shop.search');
    Route::post('sorting', 'ProductController@sorting')->name('shop.index');
    Route::get('cart', 'ProductController@cart')->name('shop.shoppingcart');
    Route::get('wishlist', 'ProductController@wishlist')->name('shop.wishlist');
    Route::get('/add-to-cart/{id}','ProductController@getAddToCart')->name('product.addToCart');
    Route::get('/deleteItem/{id}', 'ProductController@deleteItem')->name('product.deleteItem');
    Route::get('deletecart', 'ProductController@deleteCart')->name('product.deleteCart');
    Route::get('/add-to-wishlist/{id}','ProductController@getAddToWishlist')->name('product.addToWishlist');
});




