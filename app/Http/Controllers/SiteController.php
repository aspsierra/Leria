<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class SiteController extends Controller
{
    public function index()
    {
        $userPosts = DB::table('posts')->select()->where('user_id', Auth::user()->id)->get();
        /* 
        * --seleccionar posts de las cuentas a las que sigue el usuario--

        SELECT p.* FROM posts AS p 
        JOIN users as u ON p.user_id = u.id 
        JOIN followers AS f ON u.id = f.user_id 
        WHERE f.follower_id = 1 OR u.id = 1
        */

        $posts = DB::table('posts as p')
            ->select('p.*', 'u.user_name', 'u.name', 'u.profile_pic' )
            ->join('users as u', 'p.user_id', '=', 'u.id')
            ->join('followers as f', 'u.id', '=', 'f.user_id')
            ->where('f.follower_id', Auth::user()->id)
            ->orderBy('p.date', 'asc')
            ->orderBy('p.time', 'asc')
            ->get();
        return Inertia::render('index', [
            'user' => Auth::user(),
            'posts' => $posts
        ]);
    }
}
