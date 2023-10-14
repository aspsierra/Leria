<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use function Laravel\Prompts\select;

class SiteController extends Controller
{
    public function index()
    {
        /* 
        * --seleccionar posts de las cuentas a las que sigue el usuario--

        SELECT p.*, u.name, u.user_name, u.profile_pic
        FROM posts AS p 
        JOIN users AS u ON p.user_id = u.id 
        JOIN followers AS f ON u.id = f.user_id 
        WHERE f.follower_id = 3 
        OR p.user_id = 3
        GROUP BY p.id 
        ORDER BY p.date DESC, p.time DESC
        */

        $nPosts = DB::table('posts')
            ->where('user_id', Auth::user()->id)
            ->count('id');

        $nFollowers = DB::table('followers')
            ->where('user_id', Auth::user()->id)
            ->count();

        $nFollowing = DB::table('followers')
            ->where('follower_id', Auth::user()->id)
            ->count();

        return Inertia::render('index', [
            'user' => Auth::user(),
            //'posts' => $posts,
            'nPosts' => $nPosts,
            'nFollowers' => $nFollowers,
            'nFollowing' => $nFollowing
        ]);
    }



    public function storePost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'userPost' => 'required|string|max:140'
        ]);


        if ($validator->fails()) {

            if ($request->alert) {
                //$request->session()->flash('Not Valid');
            }
            //$request->session->flash();
            return redirect()->back()
                ->withErrors($validator);
        }
        date_default_timezone_set($request->tz);

        Post::create([
            'user_id' => Auth::user()->id,
            'message' => $request->userPost,
            'date' => date('Y-m-d'),
            'time' => date('H:i:s'),
            'alert' => $request->alert
        ]);

        return redirect()->back();
    }
}
