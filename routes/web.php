<?php
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ServiceController;
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
Route::get('/',[ViewController::class,"indexView"])->name('app.index')->middleware('guest');//vista iniciar o registrarse
Route::get('/register',[ViewController::class,"registerView"])->name('register.view')->middleware('guest');//registro
Route::get('/login',[ViewController::class,'loginView'])->name('login.view')->middleware('guest');//login
Route::get('/welcome',[ViewController::class,'welcomeView'])->name('welcome.view')->middleware('auth');//pagina inicio logueado
Route::get('/information',[ViewController::class,'informationView'])->name('information.view')->middleware('guest');//vista de que se le envio un correo
Route::get('mailresend',[ViewController::class,'mailResendView'])->name('mail.resend.view')->middleware('guest');//vista de que se le reenvio un correo con exito
Route::get('/verified',[ViewController::class,'verifiedCodeView'])->name('verified.view')->middleware('guest');//vista para verificar el codigo





Route::get('/email',[ViewController::class,'emailVerifiedView'])->name('email.view')->middleware('first.user:admin')->middleware('guest');
Route::get('/mailsuccess',[ViewController::class,'mailSuccessView'])->name('mail.success.view')->middleware('guest');//vista de que se le envio un correo con exito
//-------- Acciones -------
Route::post('/register', [UserController::class, 'register'])->name('register.user'); //registro
Route::post('/login', [UserController::class, 'login'])->name('login.user'); //login
Route::post('resendemail',[ServiceController::class,'resendEmail'])->name('resend.email');//reenviar correo
Route::post('/verify',[ServiceController::class,'verifyCode'])->name('verify.whatssApp');//verificar codigo
Route::get('/logout',[UserController::class,'logout'])->name('logout.user')->middleware('auth');
//Servicios
//enviar whatsapp
Route::get('/sendwhatsapp',[ServiceController::class,'sendWhatssApp'])->name('send.whatsapp');
//Reenviar whatsapp
Route::post('/resendwhatsapp',[ServiceController::class,'resendWhatssap'])->name('resend.whatsapp');

//css



