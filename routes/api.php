<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\userController;
use App\Http\Controllers\Api\productController;

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

Route::post('register', [userController::class, 'register']);
Route::post('login', [userController::class, 'login']);
Route::get('login',[userController::class,'login'])->name('login');
Route::middleware('auth:api')->group( function () {
    Route::post('addMoney', [userController::class, 'addMoney']);
    Route::post('checkout', [productController::class, 'checkout']);

});
