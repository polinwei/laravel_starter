<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|

Route::get('login', function () { return view('login'); });
Route::get('register', function () { return view('register'); });

*/

/**
 * 全域首頁的控制 HomeController
 */
Route::get('/', function () { return view('welcome'); })->name('welcome');

Route::controller(HomeController::class)->group( function() {
  Route::get('home' , 'index')->name('home');
  Route::get('dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
  Route::get('login', 'login')->name('login');
  Route::get('jwtLogin', 'jwtLogin')->name('jwtLogin');
  Route::post('auth-login', 'authLogin')->name('authLogin');
  Route::get('signOut', 'signOut')->name('signOut');
  Route::get('register','register')->name('register');
  Route::post('custom-registration', 'customRegistration')->name('register.custom');

  // 信件驗證
  Route::get('account/verify/{token}', 'verifyAccount')->name('user.verify'); 
  Route::get('jwt/account/verify/{token}', 'JwtVerifyAccount')->name('jwt.user.verify');

  // 重設密碼
  Route::get('forget-password', 'showForgetPasswordForm')->name('forget.password.get');
  Route::post('forget-password', 'submitForgetPasswordForm')->name('forget.password.post'); 
  Route::get('reset-password/{email}&{token}', 'showResetPasswordForm')->name('reset.password.get');
  Route::post('reset-password', 'submitResetPasswordForm')->name('reset.password.post');
});

Route::get('user-profile', function() {return view('user.profile'); })->name('user.profile.get');

//Route::get('dashboard', [HomeController::class, 'dashboard'])->middleware(['auth', 'is_verify_email'])->name('dashboard');


/**
 * Vue 3 頁面
 */
Route::get('/vueWelcome', function () { return view('vueWelcome'); })->name('vueWelcome');