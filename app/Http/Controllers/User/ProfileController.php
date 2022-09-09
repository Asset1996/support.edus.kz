<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class ProfileController extends Controller
{
    /**
     * Renders the profile main view 
     * or redirects to home page, if the user is not a client.
     *
     * @return view/redirect 
     */
    public function getProfile(){
        $user = Cache::remember('user', 86400, function () {
            return Auth::user();
        });
        if ($user && $user->roles_id != 1) {
            session()->flash('error_message', trans('Only clients have access to create a ticket'));
            return redirect()->home();
        }

        return view('pages.user.profile', [
            'user' => $user
        ]);
    }

    /**
     * Processes the POST request to update the user data in DB.
     *
     * @return redirect 
     */
    public function updateProfile(\App\Http\Requests\User\UpdateProfileRequest $request){
        $context = request()->only(
            'phone', 'iin', 'surname', 'name'
        );

        $user = Auth::user();
        $condition = ['id' => $user->id];
        $user->_update($condition, $context);
        session()->flash('success_message', trans('Successfully updated'));

        Cache::put('user', '', 0);
        return redirect()->back();
    }
}
