<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class HomePageController extends Controller
{
    public function index()
    {
        $posts = DB::table('posts')
    ->join('users', 'posts.user_id', '=', 'users.id')
    ->select('posts.*', 'users.*',
        DB::raw('CONCAT(
            CASE 
                WHEN TIMESTAMPDIFF(MINUTE, posts.created_at, NOW()) < 60 THEN CONCAT(TIMESTAMPDIFF(MINUTE, posts.created_at, NOW()), "m ago")
                WHEN TIMESTAMPDIFF(HOUR, posts.created_at, NOW()) < 24 THEN CONCAT(TIMESTAMPDIFF(HOUR, posts.created_at, NOW()), "h ago")
                WHEN TIMESTAMPDIFF(DAY, posts.created_at, NOW()) < 30 THEN CONCAT(TIMESTAMPDIFF(DAY, posts.created_at, NOW()), "d ago")
                WHEN TIMESTAMPDIFF(MONTH, posts.created_at, NOW()) < 12 THEN CONCAT(TIMESTAMPDIFF(MONTH, posts.created_at, NOW()), "mo ago")
                ELSE CONCAT(TIMESTAMPDIFF(YEAR, posts.created_at, NOW()), "yr ago")
            END
        ) as created_at'),
        DB::raw('CONCAT(
            CASE 
                WHEN TIMESTAMPDIFF(MINUTE, posts.updated_at, NOW()) < 60 THEN CONCAT(TIMESTAMPDIFF(MINUTE, posts.updated_at, NOW()), "m ago")
                WHEN TIMESTAMPDIFF(HOUR, posts.updated_at, NOW()) < 24 THEN CONCAT(TIMESTAMPDIFF(HOUR, posts.updated_at, NOW()), "h ago")
                WHEN TIMESTAMPDIFF(DAY, posts.updated_at, NOW()) < 30 THEN CONCAT(TIMESTAMPDIFF(DAY, posts.updated_at, NOW()), "d ago")
                WHEN TIMESTAMPDIFF(MONTH, posts.updated_at, NOW()) < 12 THEN CONCAT(TIMESTAMPDIFF(MONTH, posts.updated_at, NOW()), "mo ago")
                ELSE CONCAT(TIMESTAMPDIFF(YEAR, posts.updated_at, NOW()), "yr ago")
            END
        ) as updated_at')
    )
    ->orderBy('posts.views', 'desc')
    ->orderBy(DB::raw('RAND()'))
    ->limit(200)
    ->get();


        return view('index',['posts' => $posts]);
    }
}
