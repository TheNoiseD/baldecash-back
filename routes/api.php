<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return \Illuminate\Support\Facades\Auth::user();
//});

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/user', [UserController::class,'index'])->name('user');
    Route::post('/user', [UserController::class,'store'])->name('user.store');
    Route::get('/user/{id}', [UserController::class,'show'])->name('user.show');
    Route::put('/user/{id}', [UserController::class,'update'])->name('user.update');
    Route::delete('/user/{id}', [UserController::class,'destroy'])->name('user.destroy');
    Route::post('/logout', [AuthController::class,'logout'])->name('logout');
});

Route::post('/login', [AuthController::class,'authenticate'])->name('login');
