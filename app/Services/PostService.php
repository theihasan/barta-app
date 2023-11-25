<?php

namespace App\Services;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PostSubmitRequest;

class PostService
{
    public function createPost(PostSubmitRequest $request)
    {
        $request->validated();

        $uuid = Str::uuid();

        DB::table("posts")->insert([
            "uuid" => $uuid,
            "post_content" => $request->postcontent,
            "user_id" => Auth::user()->id,
            "created_at" => now(),
        ]);

        
    }


    public function getPostData($postuuid)
    {
        DB::table('posts')->where('uuid', $postuuid)->increment('views');

        $totalComment = DB::table('comments')->where('uuid', $postuuid)->count();

        $postData = DB::table('posts')
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->select('users.name', 'users.username', 'posts.*')
            ->where('uuid', $postuuid)
            ->first();

        $comments = DB::table('comments')
            ->join('users', 'comments.user_id', '=', 'users.id')
            ->select('users.name', 'users.username', 'comments.*')
            ->where('comments.uuid', $postuuid)
            ->orderBy('comments.created_at', 'desc')
            ->get();

        return [
            'postData' => $postData,
            'comments' => $comments,
            'totalComment' => $totalComment,
        ];
    }



    public function updatePost(PostSubmitRequest $request, $uuid)
    {
        $request->validated();

        DB::table('posts')->where('uuid', $uuid)->update([
            'post_content' => $request->postcontent,
            'created_at' => now(),
        ]);
    }

    
    public function deletePost($uuid)
    {
        DB::table('posts')->where('uuid', $uuid)->delete();
    }
}