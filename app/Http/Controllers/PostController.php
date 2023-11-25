<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PostSubmitRequest;
use App\Services\PostService;
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

    public function show($postuuid)
    {
        $post = $this->postService->getPostData($postuuid);
        return view('public.single-post',$post);
    }




    public function edit($uuid){
        $post = DB::table("posts")->where('uuid', '=', $uuid)->first();
        return view('user.edit-post', ['post'=> $post]);
    }

    public function update( PostSubmitRequest $request, $uuid)
    {
        $post = $this->postService->updatePost($request,$uuid);
        return redirect()->back()->with('post-updated','Post Updated successfully');
    }

    public function delete($uuid){
        $post = $this->postService->deletePost($uuid);
        return redirect()->back()->with('delete-success','Post Delete successfully');
    }


    


}
