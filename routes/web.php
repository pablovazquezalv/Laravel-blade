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

//
Route::post('/verify',[UserController::class,'verifySMS'])->name('verify.sms')->where('id','[0-9]+');

Route::get('/',[ViewController::class,"indexView"])->name('app.index');
Route::get('/register',[ViewController::class,"registerView"])->name('register.view');
Route::get('/login',[ViewController::class,'loginView'])->name('login.view');
Route::get('/welcome',[ViewController::class,'welcomeView'])->name('welcome.view')->middleware('auth');
Route::get('/email',[ViewController::class,'emailVerifiedView'])->name('email.view')->where('id','[0-9]+')->middleware('first.user')->middleware('auth');
Route::get('/logout',[UserController::class,'logout'])->name('logout.user')->middleware('auth');
//Acciones
Route::post('/register', [UserController::class, 'register'])->name('register.user');
Route::post('/login', [UserController::class, 'login'])->name('login.user');

Route::get('/resend',[UserController::class,'resendMail'])->name('resend.sms');
//Validacion correo
//ruta firmada
Route::get('/sendwhatsap',[UserController::class,'sendSMS'])->name('send.whatsapp');
//Confirmar codigo
