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

    public function registerView()
    {
        return view('/auth/register');
    }

    public function LoginView()
    {
        return view('/auth/login');
    }

    public function emailVerifiedView()
    {
        $userId = session('user_id');
        
        $user = User::find($userId);

        return view('/auth/email', compact('user'));
    }

    public function welcomeView()
    {
        return view('/welcome');
    }

    public function informationView()
    {
        return view('/auth/information');
    }

    public function receiveView($id)
    {
        $userId = session('user_id');
        $user = User::find($id);
        
        return view('/auth/receive_code', compact('user'));
    }
}
