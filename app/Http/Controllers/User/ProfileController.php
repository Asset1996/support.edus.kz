<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class ProfileController extends Controller
{
    /**
     * Renders the profile main view
     * or redirects to home page, if the user is not a client.
     *
     * @return View/redirect
     */
    public function getProfile(): View
    {
        $user = Auth::user();

        return View('pages.user.profile', [
            'user' => $user
        ]);
    }

    /**
     * Processes the POST request to update the user data in DB.
     *
     * @return RedirectResponse
     */
    public function updateProfile(\App\Http\Requests\User\UpdateProfileRequest $request): RedirectResponse
    {
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
