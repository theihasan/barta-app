<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class HomePageController extends Controller
{
    public function index()
    {
        $posts = Post::with(['user','media','comments'])
                ->orderBy('views','desc')
                ->inRandomOrder()
                ->limit(200)
                ->get();
        
        
        return view('index',['posts' => $posts]);
    }
}
