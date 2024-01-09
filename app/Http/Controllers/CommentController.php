<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Events\CommentAddedEvent;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CommentSubmitRequest;

class CommentController extends Controller
{
    public function create(CommentSubmitRequest $request, $postuuid){
        $validatedComment = $request->validated();
        
        $post = Post::where('uuid', $postuuid)->first();
        
        $validatedComment['post_id'] = $post->id;
        $validatedComment['user_id'] = Auth::user()->id;
        $validatedComment['uuid'] = $post->uuid;
    
        $comment = Comment::create($validatedComment);
        event(new CommentAddedEvent($comment));
        return redirect()->back()->with('comment-success','Comment added successfully');
    }
}
