<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PublicProfileController extends Controller
{
    public function index(string $username){
        
        $userInfoWithPosts = User::with(['posts.comments','media','comments'])->where("username", $username)->firstOrFail();
        $profileImage = $userInfoWithPosts->getFirstMediaUrl('profile_picture');
        $postImage = $userInfoWithPosts->getFirstMediaUrl('post_image');

                return view("public.profile",[
                 
                    'publicuserInfo'    => $userInfoWithPosts,
                    'profilePicture'      => $profileImage,
                    'postImage'         => $postImage
                ]);
    }
}
