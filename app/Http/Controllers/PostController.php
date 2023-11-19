<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PostSubmitRequest;

class PostController extends Controller
{
    public function addPost(PostSubmitRequest $request){
        $request->validated();
        $post = DB::table("posts")->insert([
            "uuid"              => Str::uuid(),
            "post_content"      => $request->postcontent,
            "user_id"           => Auth::user()->id,
            "created_at"        => now(),
        ]);
        return redirect()->back()->with("post-success","Posted Successfully");

    }

    public function updatePostData($uuid){
        $post = DB::table("posts")->where('uuid', '=', $uuid)->first();
        return view('user.edit-post', ['post'=> $post]);
    }

    public function updatePost( PostSubmitRequest $request, $uuid){
        $request->validated();
        $post = DB::table('posts')->where('uuid', $uuid)->update([
            'post_content'  => $request->postcontent,
            'created_at'    => now(),
        ]);
        return redirect()->back()->with('post-updated','Post Updated successfully');
    }

    public function deletePost($uuid){
        $post = DB::table('posts')
        ->where('uuid', $uuid)
        ->delete();
        return redirect()->back()->with('delete-success','Post Delete successfully');
    }


    


}
