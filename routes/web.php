<?php

use App\Http\Controllers\CartController;
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

Route::name('product.')->controller(\App\Http\Controllers\ProductController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('search', 'postSearch')->name('shop.search');
    Route::post('sorting', 'ProductController@sorting')->name('shop.index');
    Route::get('wishlist', 'ProductController@wishlist')->name('shop.wishlist');
    Route::get('/add-to-wishlist/{id}','ProductController@getAddToWishlist')->name('addToWishlist');
});
Route::get('/cart',  [CartController::class, 'index'])->name('cart');
Route::get('/home', 'HomeController@home')->name('home');




