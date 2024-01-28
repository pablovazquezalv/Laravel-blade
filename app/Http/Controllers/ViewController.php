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

        return view('/auth/email');
    }

    public function welcomeView()
    {
        return view('/welcome');
    }
}
