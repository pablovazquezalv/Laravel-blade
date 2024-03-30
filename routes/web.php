<?php
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\TicketController;

//--VISTAS

Route::get('/',[ViewController::class,"indexView"])->name('app.index')->middleware('guest');//vista iniciar o registrarse
Route::get('/register',[ViewController::class,"registerView"])->name('register.view')->middleware('guest');//registro
Route::post('/register', [UserController::class, 'register'])->name('register.user')->middleware('guest');//funcion registro

Route::get('/login',[ViewController::class,'loginView'])->name('login.view');//login
Route::post('/login', [UserController::class, 'login'])->name('login.user')->middleware('guest');//funcion login

Route::get('/welcome',[ViewController::class,'welcomeView'])->name('welcome.view')->middleware('auth')->middleware('status.user');//pagina inicio logueado
Route::get('/information',[ViewController::class,'informationView'])->name('information.view')->middleware('guest');//vista de que se le envio un correo
Route::get('mailresend',[ViewController::class,'mailResendView'])->name('mail.resend.view')->middleware('guest');//vista de que se le reenvio un correo con exito
Route::get('/verified',[ViewController::class,'verifiedCodeView'])->name('verified.view')->middleware('guest');//vista para verificar el codigo
Route::get('/mailsuccess',[ViewController::class,'mailSuccessView'])->name('mail.success.view')->middleware('guest');//vista de que se le envio un correo con exito

Route::get('/sendwhatsapp',[ServiceController::class,'sendWhatssApp'])->name('send.whatsapp');//enviar whatsapp
Route::post('/resendwhatsapp',[ServiceController::class,'resendWhatssap'])->name('resend.whatsapp');//Reenviar whatsapp

Route::post('resendemail',[ServiceController::class,'resendEmail'])->name('resend.email');//reenviar correo
Route::post('/verify',[ServiceController::class,'verifyCode'])->name('verify.whatssApp');//verificar codigo
Route::get('/logout',[UserController::class,'logout'])->name('logout.user')->middleware('auth');

//Tickets

Route::get('/tickets', [ViewController::class, 'TicketCreateView'])->name('tickets.create.view')->middleware('roles.create:1,2')->middleware('auth');
Route::post('/tickets', [TicketController::class, 'createTicket'])->name('tickets.create')->middleware('roles.create:1,2')->middleware('auth');

Route::get('/ticket/{id}', [ViewController::class, 'TicketEditView'])->name('tickets.edit.view')->middleware('roles.create:1,2')->middleware('auth')->where('id', '[0-9]+');
Route::post('/ticket/{id}', [TicketController::class, 'editTicket'])->name('tickets.edit')->middleware('roles.create:1,2')->middleware('auth')->where('id', '[0-9]+');

Route::get('/ticketDelete/{id}', [TicketController::class, 'deleteTicket'])->name('tickets.delete')->middleware('auth')->middleware('roles.create:1,2')->where('id', '[0-9]+');
Route::post('resolveTicket/{id}',[TicketController::class,'resolveTicket'])->name('tickets.resolve')->middleware('roles.create:1,2')->middleware('auth')->where('id', '[0-9]+');

//USUARIOS

Route::get('/users', [ViewController::class, 'UserEditView'])->name('users.view')->middleware('auth')->middleware('roles.create:1');
Route::post('/changeRol', [UserController::class, 'changeRol'])->name('change.rol')->middleware('auth')->middleware('roles.create:1')->where('id', '[0-9]+');
Route::post('/changeStatus/{id}', [UserController::class, 'changeStatus'])->name('change.status')->middleware('auth')->middleware('roles.create:1')->where('id', '[0-9]+');



