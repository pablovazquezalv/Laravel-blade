<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Inertia\Inertia;

class ViewController extends Controller
{
    public function indexView()
    {
        return view('app');
    }
    //Visualizacion de la vista de registro
    public function registerView()
    {
        return view('/auth/register');
    }
    //Visualizacion de la vista de login
    public function LoginView()
    {
        return view('/auth/login');
    }

    //Visualizacion de la vista de bienvenida
    public function welcomeView()
    {
        return view('/welcome');
    }

    //Visualizacion de la vista de informacion
    public function informationView()
    {
            $id = session('user_id');
            $user = User::find($id);

            return view('/auth/information', compact('user'));
    
    }
    //vista que se devuelve cuando da confirmacion de correo
    public function mailSuccessView()
    {
        $userId = session('user_id');
        $user = User::find($userId);

        return view('/email/mail_success', compact('user'));
    }

    //Visualizacion de la vista de reenvio de correo
    public function mailResendView()
    {
        $userId = session('user_id');
        $user = User::find($userId);

        return view('/email/email_resend_success', compact('user'));
    }

    //Visualizacion de la vista de codigo verificado enviar
    public function verifiedCodeView()
    {
        $userId = session('user_id');
        $user = User::find($userId);
        return view('/auth/verified_code', compact('user'));
    }

   
    

    // public function emailVerifiedView()
    // {
    //     $userId = session('user_id');
        
    //     $user = User::find($userId);

    //     return view('/auth/email', compact('user'));
    // }

   

    public function receiveView($id)
    {
        $userId = session('user_id');
        $user = User::find($id);
        
        return view('/auth/receive_code', compact('user'));
    }
}
