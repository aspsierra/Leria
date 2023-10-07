<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class SiteController extends Controller
{
    public function index(){
        $userPosts = DB::table('posts')->select()->where('user_id', Auth::user()->id)->get();
        return Inertia::render('index',[
            'user' => Auth::user(),
            'posts' => $userPosts
        ]);
    }
}
