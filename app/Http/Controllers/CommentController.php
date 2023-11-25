<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CommentSubmitRequest;

class CommentController extends Controller
{
    public function create(CommentSubmitRequest $request, $id){
        $validatedComment = $request->validated();
        $uuid = DB::table("posts")->where('id', $id)->value("uuid");
        DB::table('comments')->insert([
            'post_id'       => $id,
            'user_id'       => Auth::user()->id,
            'comments'      => $validatedComment['comment'],
            'uuid'          => $uuid,
            'created_at'    => now(),
            'updated_at'    => now()
        ]);
        return redirect()->back()->with('comment-success','Comment added successfully');
    }
}
