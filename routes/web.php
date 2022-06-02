<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Seller\SellerController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::prefix('user')->name('user.')->group(function(){
Route::middleware(['guest:web','PreventBackHistory'])->group(function(){
    Route::view('/login','mydashboard.user.login')->name('login');
    Route::view('/register','mydashboard.user.register')->name('register');
    Route::post('/create',[UserController::class,'create'])->name('create');
    Route::post('/check',[UserController::class,'check'])->name('check');
});
Route::middleware(['auth:web','PreventBackHistory'])->group(function(){
    Route::view('/home','mydashboard.user.home')->name('home');
    Route::post('/logout',[UserController::class,'logout'])->name('logout');
    Route::get('/add-new',[UserController::class,'add'])->name('add');
});
});

Route::prefix('admin')->name('admin.')->group(function(){

    Route::middleware(['guest:admin','PreventBackHistory'])->group(function(){
          Route::view('/login','mydashboard.admin.login')->name('login');
          Route::post('/check',[AdminController::class,'check'])->name('check');
    });

    Route::middleware(['auth:admin','PreventBackHistory'])->group(function(){
        Route::view('/home','mydashboard.admin.home')->name('home');
        Route::post('/logout',[AdminController::class,'logout'])->name('logout');
    });

});

Route::prefix('seller')->name('seller.')->group(function(){

       Route::middleware(['guest:seller','PreventBackHistory'])->group(function(){
            Route::view('/login','mydashboard.seller.login')->name('login');
            Route::view('/register','mydashboard.seller.register')->name('register');
            Route::post('/create',[sellerController::class,'create'])->name('create');
            Route::post('/check',[sellerController::class,'check'])->name('check');
       });

       Route::middleware(['auth:seller','PreventBackHistory'])->group(function(){
            Route::view('/home','mydashboard.seller.home')->name('home');
            Route::post('logout',[sellerController::class,'logout'])->name('logout');
       });

});
