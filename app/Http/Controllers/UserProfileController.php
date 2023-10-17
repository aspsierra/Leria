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

        if($user === null){
            abort(404);
        };
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




}
