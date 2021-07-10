<?php

use Illuminate\Http\Request;
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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::get('users', 'App\Http\Controllers\UsersControllers@index');
Route::get('users/{id}', 'App\Http\Controllers\UsersControllers@show');
Route::post('users', 'App\Http\Controllers\UsersControllers@store');
Route::put('users/{id}', 'App\Http\Controllers\UsersControllers@update');
Route::delete('users/{id}', 'App\Http\Controllers\UsersControllers@delete');

Route::get('orders', 'App\Http\Controllers\OrdersControllers@index');
Route::get('orders/{id}', 'App\Http\Controllers\OrdersControllers@show');
Route::post('orders', 'App\Http\Controllers\OrdersControllers@store');
Route::put('orders/{id}', 'App\Http\Controllers\OrdersControllers@update');
Route::delete('orders/{id}', 'App\Http\Controllers\OrdersControllers@delete');

Route::get('products', 'App\Http\Controllers\ProductsControllers@index');
Route::get('products/{id}', 'App\Http\Controllers\ProductsControllers@show');
Route::post('products', 'App\Http\Controllers\ProductsControllers@store');
Route::put('products\{id}', 'App\Http\Controllers\ProductsControllers@update');
Route::delete('products\{id}', 'App\Http\Controllers\ProductsControllers@delete');

Route::get('reports/{start}/{end}', 'App\Http\Controllers\ReportsControllers@index');