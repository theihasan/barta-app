<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\UserInfoUpdateRequest;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    
    public function index(Request $request): View
    {   
        $user = Auth::user();
        $profilePicture = $user->getFirstMediaUrl('profile_picture');
        $userInfo = Post::with(['user', 'media','comments'])
        ->orderBy('views','desc')
        ->where('user_id', $user->id)->get();
        
        return view('user.profile', [
            'userInfos'          => $userInfo,
            'profilePicture'    => $profilePicture,
            
            
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(UserInfoUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
