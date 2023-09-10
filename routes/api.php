<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MerchandiseController;
use App\Http\Controllers\API\JwtAuthController;
use App\Http\Controllers\API\JwtMerchandiseController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::controller(JwtAuthController::class)->group(function(){
    Route::post('register', 'register');
    Route::post('login', 'login');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// 改為由 JwtMerchandiseController 控制是否有登入
// Route::resource('merchandises', MerchandiseController::class);
Route::middleware('auth:sanctum')->group( function () {
    Route::resource('merchandises', JwtMerchandiseController::class);
});