<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class AuthController extends Controller
{
    public function login(){
        Inertia::render('er/Login');
    }

    public function register(){
        Inertia::render('er/RegisterTest');
    }

}
