<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class UserProfileController extends Controller
{
    public function viewProfile(Request $request, String $userName = null)
    {
        if ($userName) {
            $user = User::where('user_name', $userName)->first();
        } else {
            $user = Auth::user();
        }

        $nPosts = DB::table('posts')
            ->where('user_id', $user->id)
            ->count('id');

        $nFollowers = DB::table('followers')
            ->where('user_id', $user->id)
            ->count();

        $nFollowing = DB::table('followers')
            ->where('follower_id', $user->id)
            ->count();

        return Inertia::render('UserProfile', [
            'user' => $user,
            'nPosts' => $nPosts,
            'nFollowers' => $nFollowers,
            'nFollowing' => $nFollowing,
            'posts' => []
        ]);
    }

    public function getOwnPosts(Request $request, String $userName)
    {

        $posts = DB::table('posts as p')
            ->select('p.*', 'u.user_name', 'u.name', 'u.profile_pic')
            ->join('users as u', 'p.user_id', '=', 'u.id')
            ->where('u.user_name', $userName)
            ->orderBy('p.date', 'desc')
            ->orderBy('p.time', 'desc')
            ->get();

        return $posts;
    }

    public function getSharedPosts(Request $request, String $userName)
    {

        DB::statement("SET SQL_MODE=''");

        $user = User::select('id')->first('user_name', $userName);

        $posts = DB::table('posts as p')
            ->select('p.*', 'u.user_name', 'u.name', 'u.profile_pic')
            ->join('shares as s', 'p.id', '=', 's.post_id')
            ->join('users as u', 'p.user_id', '=', 'u.id')
            ->where('s.user_id', $user->id)
            ->groupBy('p.id')
            ->orderBy('p.date', 'desc')
            ->orderBy('p.time', 'desc')
            ->get();

        return $posts;
    }
}
