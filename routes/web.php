<?php
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ViewController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Vistas

Route::get('/',[ViewController::class,"indexView"])->name('app.index')->middleware('guest');
Route::get('/register',[ViewController::class,"registerView"])->name('register.view')->middleware('guest');
Route::get('/login',[ViewController::class,'loginView'])->name('login.view')->middleware('guest');
Route::get('/welcome',[ViewController::class,'welcomeView'])->name('welcome.view')->middleware('auth');
Route::get('/email',[ViewController::class,'emailVerifiedView'])->name('email.view')->middleware('first.user:admin')->middleware('guest');
Route::get('/information',[ViewController::class,'informationView'])->name('information.view')->middleware('guest');

//Acciones
Route::post('/register', [UserController::class, 'register'])->name('register.user');
Route::post('/login', [UserController::class, 'login'])->name('login.user');
Route::post('/verify',[UserController::class,'verifyCode'])->name('verify.whatssApp');
Route::get('/logout',[UserController::class,'logout'])->name('logout.user')->middleware('auth');
//Servicios
//enviar whatsapp
Route::get('/sendwhatsapp',[UserController::class,'sendWhatssApp'])->name('send.whatsapp');
//Reenviar whatsapp
Route::post('/resendwhatsapp',[UserController::class,'resendWhatssap'])->name('resend.whatsapp');


