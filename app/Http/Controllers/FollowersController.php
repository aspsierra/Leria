<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class FollowersController extends Controller
{

    public function list(String $userName, String $method)
    {
        $user = User::select('id', 'name', 'user_name')->where('user_name', $userName)->first();
        switch ($method) {
            case 'following':
            case 'followers':
                $data = $this->$method($user->id);
                break;
            default:
                abort(404);
                break;
        }
        return Inertia::render('ListFollows', [
            'user' => $user,
            'data' => $data,
            'method' => $method
        ]);
    }

    public function followers($id)
    {
        return DB::table('users as u')
            ->select('name', 'user_name', 'bio', 'profile_pic')
            ->join('followers as f', 'u.id', '=', 'f.follower_id')
            ->where('f.user_id', $id)
            ->get();
    }

    public function following($id)
    {
        return DB::table('users as u')
            ->select('name', 'user_name', 'bio', 'profile_pic')
            ->join('followers as f', 'u.id', '=', 'f.user_id')
            ->where('f.follower_id', $id)
            ->get();
    }
}
