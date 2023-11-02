<?php 
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller {
    public function registerView() {
        return view("user.register");
    }

    public function register(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

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

        if (Auth::attempt($credentials)) {
            return redirect('/home')->with('loggedin', 'Successfully Logged In');
        } else {
            return redirect('/login')->with('login-error', 'Sorry, credentials do not match');
        }
    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect('/login')->with('loggedout', 'Successfully Logged Out');
    }

    public function showProfilePage(Request $request) {
        $user = Auth::user();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return view('user.profile', ['user' => $user]);
    }

    public function showProfileData() {
        $user = Auth::user();
       
        return view('user.edit-profile', ['user' => $user]);
    }

    public function updateProfile(Request $request) {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
        ]);

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
