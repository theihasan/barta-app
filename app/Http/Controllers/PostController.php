<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\PostService;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PostSubmitRequest;

class PostController extends Controller
{
    protected $postService;
    public function __construct(PostService $postService){
        $this->postService = $postService;
    }


    public function create(PostSubmitRequest $request){
        $post = $this->postService->createPost($request);
        
        return redirect()->back()->with("post-success","Posted Successfully");

    }

    public function show(string $postuuid)
    {
        $post = $this->postService->getPostData($postuuid);
        return view('public.single-post',$post);
    }




    public function edit(string $uuid){
        $post = Post::where('uuid', $uuid)->firstOrFail();
        $images = $post->getFirstMediaUrl('post_image');
        
       
        if(!$images){
            $images = '';
        }
        return view('user.edit-post', ['post'=> $post, 'image' => $images]);
    }

    public function update(PostSubmitRequest  $request, string $uuid)
    {
        
        $post = $this->postService->updatePost($request,$uuid);
       
        return redirect()->back()->with('post-updated','Post Updated successfully');
    }

    public function delete(string $uuid){
        $post = $this->postService->deletePost($uuid);
        return redirect()->back()->with('delete-success','Post Delete successfully');
    }


    


}
