<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PublicProfileController extends Controller
{
    public function index($username){
        $publicuserInfo = DB::table("users")->where("username",$username)->first();
        $userPost = DB::table('posts')
                ->join('users', 'posts.user_id', '=', 'users.id')
                ->select('posts.*')
                ->where("users.username",$username)->get();
     
                return view("public.profile",[
                    'userPosts' => $userPost,
                    'publicuserInfo'  => $publicuserInfo,
                ]);
    }
}
