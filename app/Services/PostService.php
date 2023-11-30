<?php

namespace App\Services;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Str;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PostSubmitRequest;

class PostService
{
    public function createPost(PostSubmitRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['user_id'] = Auth::user()->id;
        $validatedData['uuid'] = Str::uuid();
        try {
            DB::beginTransaction();
            $post = Post::create($validatedData);

            if($request->hasFile('picture')){
                $media = $post->addMedia($request->file('picture'))->toMediaCollection('post_image');
            }
            DB::commit();
            return $post;
        } catch (\Throwable $th) {
            DB::rollBack();
            return $th;
        }
    
    }


    public function getPostData($postUuid)
        {
            $post = Post::where('uuid', $postUuid)->firstOrFail();
            $post->increment('views');
            $imageUrl = $post->getFirstMediaUrl('post_image');
            $totalComments = $post->comments->count();


            $postData = [
                'name'      => $post->user->name,
                'username'  => $post->user->username,
                'post'      => $post,
            ];

            $comments = Comment::with('user')
                        ->where('uuid',$postUuid)
                        ->orderBy('created_at','desc')
                        ->get();

            return [
                'postData' => $postData,
                'comments' => $comments,
                'totalComment' => $totalComments,
                'image'         => $imageUrl,
                ];
        }



    public function updatePost(PostSubmitRequest $request, $uuid)
    {
        $validatedData = $request->validated();
      
        $post = Post::where('uuid', $uuid)->firstOrFail();
       
        return DB::transaction(function () use ($request, $uuid, $validatedData){
            
            $post = Post::where('uuid', $uuid)->firstOrFail();
            $post->update($validatedData);
            
            if ($request->hasFile('picture')) {
                $post->clearMediaCollection('post_image');
                $media = $post->addMedia($request->file('picture'))
                ->toMediaCollection('post_image');
            }
            
            return $post;
    }, 5);

    }

    
    public function deletePost($uuid)
    {
        DB::table('posts')->where('uuid', $uuid)->delete();
    }
}