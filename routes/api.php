<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;

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

Route::post('/loginApp',[AppController::class,'loginAppMobile'])->name('login.app');
Route::post('/loginCodeApp',[AppController::class,'loginCodeApp'])->name('loginCode.app')->middleware('auth:sanctum');
Route::get('/getCodesAccess',[AppController::class,'getCodesAccess'])->name('getCodesAccess.app')->middleware('auth:sanctum')->middleware('roles.create:1')->middleware('status.user')->middleware('code.access');
Route::get('/fillTableCodes',[AppController::class,'fillTableCodes'])->name('fillTableCodes.app');

Route::get('/logout',[AppController::class,'logout'])->name('logout.app')->middleware('auth:sanctum');
Route::get('/validateToken',[AppController::class,'validateToken'])->name('validateToken.app')->middleware('auth:sanctum');