<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserInfoUpdateRequest;
use App\Models\User;

class UserController extends Controller {
   
  
    public function showProfileData() {
        $user = Auth::user();
        $profilePicture = $user->getFirstMediaUrl('profile_picture');
        return view('user.edit-profile', ['user' => $user, 'profilePicture' => $profilePicture]);
    }

    public function updateProfile(UserInfoUpdateRequest $request) {
        $request->validated();
        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->bio  = $request->bio;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        if($request->hasFile('avatar')){
            $user->addMedia($request->file('avatar'))->toMediaCollection('profile_picture');
        }

        $user->save();
        return redirect()->back()->with('profileupdate', 'Profile update successful');
    }
}
