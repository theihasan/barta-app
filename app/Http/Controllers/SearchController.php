<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SearchFormRequest;

class SearchController extends Controller
{
    public function index(SearchFormRequest $request){
        $validatedData = $request->validated();
        $posts = Post::with(['user','comments','media'])
                ->where('post_content','like','%'.$validatedData['query'].'%')
                ->inRandomOrder()
                ->get();

        if($posts->isNotEmpty()){
            return view('search.search',['posts' => $posts]);
        }else{
            return view('error.no-data',['searchTerm'=> $validatedData['query']]);
        }
        
    }
}
