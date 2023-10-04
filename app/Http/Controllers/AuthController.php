<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class AuthController extends Controller
{
    public function login(){
        Inertia::render('Auth/Login');
    }

    public function register(){
        Inertia::render('Auth/Register');
    }
}
