<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class SiteController extends Controller
{
    public function index(){
        return Inertia::render('index',[
            'user' => Auth::user()
        ]);
    }
}
