<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::post('/loginApp',[UserController::class,'loginAppMobile'])->name('login.app');
Route::post('/loginCodeApp',[UserController::class,'loginCodeApp'])->name('loginCode.app')->middleware('auth:sanctum');
Route::get('/getCodesAccess',[UserController::class,'getCodesAccess'])->name('getCodesAccess.app');
Route::get('/fillTableCodes',[UserController::class,'fillTableCodes'])->name('fillTableCodes.app');
