<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\TicketController;
use GuzzleHttp\Middleware;

//RUTAS DE VERIFICACION DE CORREO
Route::middleware(['guest'])->group(function () {
});

//INICIO
Route::get('/',[ViewController::class,"indexView"])->name('app.index');
//VISTA DE REGISTRO
Route::get('/register',[ViewController::class,"registerView"])->name('register.view');
//FUNCION DE REGISTRO
Route::post('/register', [UserController::class, 'register'])->name('register.user');
//VISTA DE LOGIN
Route::get('/login',[ViewController::class,'loginView'])->name('login.view');
//FUNCION DE LOGIN
Route::post('/login', [UserController::class, 'login'])->name('login.user')->middleware('vpn.access');
//FUNCION DE VERIFICACION DE CORREO
Route::post('/logincode',[UserController::class,'verifiedLoginCode'])->name('login.code');
Route::get('/logincode',[ViewController::class,'loginCodeVerifiedView'])->name('login.code.view');

//Route::get('/information',[ViewController::class,'informationView'])->name('information.view')->middleware('status.user');//vista de que se le envio un correo
// Route::get('mailresend',[ViewController::class,'mailResendView'])->name('mail.resend.view')->middleware('status.user');//vista de que se le reenvio un correo con exito
// Route::get('/verified',[ViewController::class,'verifiedCodeView'])->name('verified.view');//vista para verificar el codigo
// Route::get('/mailsuccess',[ViewController::class,'mailSuccessView'])->name('mail.success.view');//vista de que se le envio un correo con exito
// Route::get('/sendwhatsapp',[ServiceController::class,'sendWhatssApp'])->name('send.whatsapp');//enviar whatsapp
// Route::post('/resendwhatsapp',[ServiceController::class,'resendWhatssap'])->name('resend.whatsapp');//Reenviar whatsapp
// Route::post('resendemail',[ServiceController::class,'resendEmail'])->name('resend.email');//reenviar correo
// Route::post('/verify',[ServiceController::class,'verifyCode'])->name('verify.whatssApp');//verificar codigo
//Route::post('/logincode',[UserController::class,'verifiedLoginCode'])->name('login.code');#->middleware('status.user');//funcion login

Route::get('/logout',[UserController::class,'logout'])->name('logout.user')->middleware('auth');//cerrar sesion
Route::get('/welcome',[ViewController::class,'welcomeView'])->name('welcome.view')->middleware('auth')->middleware('status.user');#->middleware('vpn.access')->middleware('status.user');#->middleware('auth');#->middleware('loginip');
//RUTAS LISTAS SOLO FALTA PONER LA DE LA VPN
//USUARIOS
Route::middleware(['roles.create:1','auth','status.user'])->group(function () {
    Route::get('/users', [ViewController::class, 'UserEditView'])->name('users.view');
    Route::post('/changeRol', [UserController::class, 'changeRol'])->name('change.rol')->where('id', '[0-9]+');
    Route::post('/changeStatus/{id}', [UserController::class, 'changeStatus'])->name('change.status')->where('id', '[0-9]+');
});
//TICKETS
Route::middleware(['roles.create:1,2','auth','status.user'])->group(function () {
    Route::get('/tickets', [ViewController::class, 'TicketCreateView'])->name('tickets.create.view');
    Route::post('/tickets', [TicketController::class, 'createTicket'])->name('tickets.create');
    Route::get('/ticket/{id}', [ViewController::class, 'TicketEditView'])->name('tickets.edit.view')->where('id', '[0-9]+');
    Route::post('/ticket/{id}', [TicketController::class, 'editTicket'])->name('tickets.edit')->where('id', '[0-9]+');
    Route::get('/ticketDelete/{id}', [TicketController::class, 'deleteTicket'])->name('tickets.delete')->where('id', '[0-9]+');
    Route::post('resolveTicket/{id}',[TicketController::class,'resolveTicket'])->name('tickets.resolve')->where('id', '[0-9]+');
});





