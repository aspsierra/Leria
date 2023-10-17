<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{

   /* public function __invoke(Request $request)
    {
        dd('a');
        dd($request);
    }*/
    public function getAllPosts(String $id)
    {     

        DB::statement("SET SQL_MODE=''");

        $posts = DB::table('posts as p')
            ->select('p.*', 'u.user_name', 'u.name', 'u.profile_pic')
            ->join('users as u', 'p.user_id', '=', 'u.id')
            ->join('followers as f', 'u.id', '=', 'f.user_id')
            ->where('f.follower_id', Auth::user()->id)
            ->orWhere('p.user_id', Auth::user()->id)
            ->groupBy('p.id')
            ->orderBy('p.date', 'desc')
            ->orderBy('p.time', 'desc')
            ->get();

            

        return [
            'posts' => $posts,
            'shares' => $this->checkPostType($posts, 'shares'),
            'likes' => $this->checkPostType($posts, 'likes')
        ];
    }

    public function getOwnPosts(Request $request, String $userName)
    {
        if($request->isMethod('get')){
            abort(403);
        }

        $posts = DB::table('posts as p')
            ->select('p.*', 'u.user_name', 'u.name', 'u.profile_pic')
            ->join('users as u', 'p.user_id', '=', 'u.id')
            ->where('u.user_name', $userName)
            ->orderBy('p.date', 'desc')
            ->orderBy('p.time', 'desc')
            ->get();

        return [
            'posts' => $posts,
            'shares' => $this->checkPostType($posts, 'shares'),
            'likes' => $this->checkPostType($posts, 'likes')
        ];
    }

    public function getSharedPosts(Request $request, String $userName)
    {
        $user = User::select('id')->where('user_name', $userName)->first();

        $posts = DB::table('posts as p')
            ->select('p.*', 'u.user_name', 'u.name', 'u.profile_pic')
            ->join('shares as s', 'p.id', '=', 's.post_id')
            ->join('users as u', 'p.user_id', '=', 'u.id')
            ->where('s.user_id', $user->id)
            ->orderBy('p.date', 'desc')
            ->orderBy('p.time', 'desc')
            ->get();

        return [
            'posts' => $posts,
            'shares' => $this->checkPostType($posts, 'shares'),
            'likes' => $this->checkPostType($posts, 'likes')
        ];
    }

    public function getLikedPosts(Request $request, String $userName)
    {
        $user = User::select('id')->where('user_name', $userName)->first();

        $posts = DB::table('posts as p')
            ->select('p.*', 'u.user_name', 'u.name', 'u.profile_pic')
            ->join('likes as l', 'p.id', '=', 'l.post_id')
            ->join('users as u', 'p.user_id', '=', 'u.id')
            ->where('l.user_id', $user->id)
            ->orderBy('p.date', 'desc')
            ->orderBy('p.time', 'desc')
            ->get();

        return [
            'posts' => $posts,
            'shares' => $this->checkPostType($posts, 'shares'),
            'likes' => $this->checkPostType($posts, 'likes')
        ];
    }

    public function checkPostType($posts, $type)
    {
        $shares = [];
        $users = [];
        foreach ($posts as $post) {
            $users[] = DB::table($type)->select('user_id', 'post_id')->where('post_id', $post->id)->get();
        }
        foreach ($users as $user) {
            if(count($user) > 0){
                foreach($user as $item){
                    if($item->user_id == Auth::user()->id){
                        $shares[] = $item;
                    }
                }
            }
        }
        return $shares;
    }
}
