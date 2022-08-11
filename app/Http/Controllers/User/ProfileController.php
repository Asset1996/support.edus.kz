<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Renders the profile main view 
     * or redirects to home page, if the user is not a client.
     *
     * @return view/redirect 
     */
    public function getProfile(){
        $user = Auth::user();
        if ($user && $user->roles_id != 1) {
            session()->flash('error_message', trans('Only clients have access to create a ticket'));
            return redirect()->home();
        }

        // echo '<pre>' . print_r($user->evaluated_messages->avg('evaluation'), true);exit();

        return view('pages.user.profile', [
            'user' => $user
        ]);
    }

    /**
     * Processes the POST request to update the user data in DB.
     *
     * @return redirect 
     */
    public function updateProfile(){
        $context = request()->only(
            'phone', 'iin', 'surname'
        );

        $user = Auth::user();
        $condition = ['id' => $user->id];
        $user->_update($condition, $context);

        return redirect()->back();
    }
}
