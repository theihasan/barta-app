<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SinglePostController extends Controller
{
    public function index(Request $request, $postuuid)
    {

        $views = DB::table('posts')->where('uuid', $postuuid)->increment('views');
      $tatalComment = DB::table('comments')->where('uuid', $postuuid)->count();
     

      $postData = DB::table('posts')
       ->join('users','posts.user_id', '=','users.id')
       ->select('users.name','users.username','posts.*')
       ->where('uuid',$postuuid)->first();
       
       $comments = DB::table('comments')
       ->join('users', 'comments.user_id', '=', 'users.id')
       ->select('users.name','users.username', 'comments.*')
       ->where('comments.uuid', $postuuid)
       ->orderBy('comments.created_at', 'desc') 
       ->get();
   
       return view('public.single-post',[
         'postData'     => $postData,
         'comments'     => $comments,
         'totalComment' => $tatalComment,
         
      ]);

    }
}
