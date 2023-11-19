<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PublicController extends Controller
{
   public function homePagePost(){
      $posts = DB::table('posts')
              ->join('users', 'posts.user_id', '=', 'users.id')
              ->select('posts.*', 'users.*')
              ->inRandomOrder()
              ->limit(20)
              ->get();
      return view('index',['posts' => $posts]);
  }
    public function publicProfile($username){
       $users = DB::table('posts')
       ->join('users', 'posts.user_id', '=', 'users.id')
       ->select('posts.*', 'users.*')
       ->where("users.username",$username)->get();

       
       return view("public.profile",['users' => $users]);
    }

    public function singlePostShow($postuuid){
       $postData = DB::table('posts')
       ->join('users','posts.user_id', '=','users.id')
       ->select('users.name','users.username','posts.*')
       ->where('uuid',$postuuid)->first();
       return view('public.single-post',['postData'=> $postData]);
    }


   
}
