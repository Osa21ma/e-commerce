<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('home',[HomeController::class,'index']);
Route::get('changeLang/{lang}',[LangController::class,'index']);

Route::middleware('isAdmin')->group(function(){
    Route::controller(ProductController::class)->group(function(){
        Route::get('products','index')->name('products');
        Route::get('createProduct','create')->name('createProduct');
        Route::post('product','store')->name('storeProduct');
        Route::get('editProduct/{id}','edit');
        Route::put('updateProduct/{id}','update')->name('updateProduct');
        Route::delete('deleteProduct/{id}','delete')->name('deleteProduct');
    });
});

Route::controller(UserProductController::class)->group(function(){
    Route::get('home','index')->name('products');
    Route::get('cart','displayCart');
    Route::get('showProduct/{id}','show');
    Route::post('addProduct/{id}','addCart');
    Route::get('removeProduct/{id}','removeCart');
});

Route::post('placeOrder',[OrderController::class,'placeOrder']);