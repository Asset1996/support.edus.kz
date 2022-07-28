<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Registrates new user into the system.
     * 
     * @param RegistrationPostRequest $request
     * @return Redirect 
     */
    public function registration(\App\Http\Requests\Auth\RegistrationPostRequest $request){
        
        $this->user->createUser();
        if($this->user->hasErrors()){
            session()->flash('error_message', $this->user->getFirstError());
            return Redirect::back();
        }
        session()->flash('success_message', 'Registration successfull, now need to confirm credentials.');
        return Redirect::to(route('home'));
    }

    /**
     * Verifies email by verification token.
     * 
     * @param string $token - email verifiacation token.
     * @return Redirect 
     */
    public function verifyEmail(string $lang, string $token){
        
        $this->user->verifyEmail($token);
        session()->forget(['error_message', 'success_message']);
        if($this->user->hasErrors()){
            session()->flash('error_message', $this->user->getFirstError());
        }else{
            session()->flash('success_message', 'Email verified successfully.');
        }
        return view('pages.auth.verifyEmail');
    }

    /**
     * Receives auth credentials from Login form and attemts to log user in.
     *
     * @param credentials
     * @return redirect
     */
    public function authenticate()
    {
        $credentials = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            request()->session()->regenerate();
            request()->session()->flash('success_message', trans('You have successfully logged in.'));
            return redirect()->home();
        }

        request()->session()->flash('error_message', trans('Incorrect email or password.'));
        return back();
    }

    /**
     * Returns the login view.
     *
     * @param credentials
     * @return view
     */
    public function login(){
        return view('pages.auth.login');
    }

    /**
     * Logs the user out of the system(if he(she) was logged in).
     *
     * @return redirect
     */
    public function logout(){
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        request()->session()->flash('success_message', trans('You have successfully logged out.'));

        return redirect()->route('login');
    }
}
