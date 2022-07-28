<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
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
}
