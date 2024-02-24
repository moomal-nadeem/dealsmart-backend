<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ImagController;
use App\Http\Controllers\DealController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\QuoteController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// public routes
Route::post('/signup', [UserController::class,'signup']); 
Route::post('login',[UserController::class,'login']);
Route::get('user',[UserController::class,'user']);
Route::get('userList',[UserController::class,'userList']);
Route::delete('userDelete/{id}',[UserController::class,'userDelete']);
Route::put('userEdit/{id}',[UserController::class,'userEdit']);
Route::get('showByIdUser/{id}',[UserController::class,'showByIdUser']);

Route::post('addProduct',[ProductController::class,'addProduct']);
Route::get('productList',[ProductController::class,'productList']);
Route::get('zeroP',[ProductController::class,'zeroP']);
Route::get('cnt',[ProductController::class,'cnt']);
Route::get('notZeroP',[ProductController::class,'notZeroP']);
Route::delete('productDelete/{id}',[ProductController::class,'productDelete']);
Route::put('productEdit/{id}',[ProductController::class,'productEdit']);
Route::get('showByIdProduct/{id}',[ProductController::class,'showByIdProduct']);
Route::get('search/{id}',[ProductController::class,'search']);

Route::delete('del',[OrderController::class,'del']);

Route::delete('orderDelete/{id}',[OrderController::class,'orderDelete']);

Route::post('addImg/{id}',[ImagController::class,'addImg']);
Route::get('searchImg/{id}',[ImagController::class,'searchImg']);
Route::delete('imagDelete/{id}',[ImagController::class,'imagDelete']);

Route::post('addDeal',[DealController::class,'addDeal']);
Route::post('addOrder',[OrderController::class,'addOrder']);
Route::get('showByIdOrder/{id}',[OrderController::class,'showByIdOrder']);
Route::get('billd',[DealController::class,'billd']);
Route::get('showByIdDeal/{id}',[DealController::class,'showByIdDeal']);
Route::put('dealCheck/{id}',[DealController::class,'dealCheck']);
Route::put('confi/{id}',[DealController::class,'confi']);
Route::get('vUc',[DealController::class,'vUc']);
Route::get('allBill',[DealController::class,'allBill']);
Route::get('vc',[DealController::class,'vc']);
Route::get('dealList',[DealController::class,'dealList']);
Route::get('cnt',[DealController::class,'cnt']);
Route::post('change_password',[UserController::class,'change_password']);


//protected routes
Route::middleware(['auth:sanctum'])->group(function(){
    Route::post('logout',[UserController::class,'logout']);
    // Route::get('user',[UserController::class,'user']);
    // Route::post('change_password',[UserController::class,'change_password']);
});
