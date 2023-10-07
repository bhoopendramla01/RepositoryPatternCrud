<?php

use App\Http\Controllers\UserController;
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

Route::middleware(['auth:sanctum','verified'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login',[UserController::class,'login']);
Route::post('/profile',[UserController::class,'profile']);
Route::get('/index',[UserController::class,'index']);
Route::post('/store',[UserController::class,'store']);
Route::get('/getUser/{id}',[UserController::class,'getUser']);
Route::post('/update',[UserController::class,'update']);
Route::delete('/destroy/{id}',[UserController::class,'destroy']);