<?php

use Illuminate\Http\Request;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

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
Route::prefix('cart/')->name('cart.')->controller(CartController::class)->group(function () {
    Route::post('add/{product}', 'add')->name('add');
    Route::put('remove/{product}', 'remove')->name('remove');
    Route::post('remove', 'removeAll')->name('removeAll');
    Route::get
});
