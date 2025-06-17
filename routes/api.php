<?php

use App\Http\Controllers\ApiProductController;
use App\Http\Controllers\AutController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::middleware('apiAuth')->group(function(){

    Route::controller(ApiProductController::class)->group(function(){
        Route::get('products','index');
        Route::get('product/{id}','show');
        Route::post('product','store');
        Route::post('updateProduct/{id}','update');
        Route::post('deleteProduct/{id}','delete');
    });
});

Route::post('register',[AutController::class,'register']);
Route::post('login',[AutController::class,'login']);