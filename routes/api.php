<?php

use App\Http\Controllers\ProductController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], static function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('profile', 'AuthController@profile');
    Route::post('register', 'AuthController@register');

});

Route::get('/product', ProductController::class . '@index');
Route::post('/product/new', ProductController::class . '@store');
Route::put('/product/update/{id}', ProductController::class . '@update');
Route::delete('/product/delete/{id}', ProductController::class . '@destroy');
Route::get('/product/show/{id}', ProductController::class . '@show');
