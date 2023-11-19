<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserInfoUpdateRequest;
use App\Http\Requests\UserRegistrationRequest;

class UserController extends Controller {
    public function registerView() {
        return view("user.register");
    }

    public function register(UserRegistrationRequest $request) {
     
        $validated = $request->validated();
        
        $user = DB::table("users")->insertGetId([
            "name" => $request->name,
            "username" => $request->username,
            "email" => $request->email,
            "password" => Hash::make($request->password),
            "email_verified_at" => now(),
            "created_at" => now(),
        ]);

        if ($user) {
           
            return redirect("/login")->with("register-success", "Registration successful! Please login.");
        } else {
            return view("user.register", ['message' => 'Email Already Exists']);
        }
    }

    public function login(Request $request) {
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials, true)) {
            
            
            return redirect()->route('home');
           
            
        } else {
            return redirect('/login')->with('login-error', 'Sorry, credentials do not match');
        }
    }
    
    

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('loggedout', 'Successfully Logged Out');
    }

    public function showProfilePage(Request $request) {
        $user = DB::table('posts')
       ->join('users', 'posts.user_id', '=', 'users.id')
       ->select('posts.*', 'users.*')
       ->where("users.id",Auth::user()->id)->get();
        return view('user.profile', ['userAndPostData' => $user]);
    }

    public function showProfileData() {
        $user = Auth::user();
       
        return view('user.edit-profile', ['user' => $user]);
    }

    public function updateProfile(UserInfoUpdateRequest $request) {
        $user = Auth::user();

        $request->validated();

        $userUpdateData = [
            'name' => $request->name,
            'email' => $request->email,
            'bio' => $request->bio,
            'updated_at' => now(),
        ];

        if ($request->password) {
            $userUpdateData['password'] = Hash::make($request->password);
        }
        DB::table('users')
        ->where('id', $user->id)
        ->update($userUpdateData);

        return redirect()->back()->with('profileupdate', 'Profile update successful');
    }
}
