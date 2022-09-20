<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Helpers\MailSender;
use Illuminate\Support\Facades\Cache;

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
        $context = request()->only(['name', 'email', 'password']);
        $context['password'] = \Illuminate\Support\Facades\Hash::make($context['password']);
        $context['verification_token'] = uniqid();

        $this->user->_create($context);
        $mail_sender = new MailSender(env('VERIFY_EMAIL_ROUTE'), 'mail.VerifyEmail');
        $mail_sender->send($context);

        if($this->user->hasErrors()){
            session()->flash('error_message', $this->user->getFirstError());
        }elseif($mail_sender->hasErrors()){
            session()->flash('error_message', $mail_sender->getFirstError());
        }else{
            session()->flash('success_message', trans('Registration successfull, now need to confirm credentials'));
        }
        return redirect()->home();
    }

    /**
     * Verifies email by verification token.
     *
     * @param string $token - email verifiacation token.
     * @return Redirect
     */
    public function verifyEmail(string $lang, string $token){

        $user = $this->user->verifyEmail($token);
        session()->forget(['error_message', 'success_message']);
        if($this->user->hasErrors()){
            session()->flash('error_message', $this->user->getFirstError());
        }else{
            Auth::login($user);
            session()->flash('success_message', trans('Email verified successfully'));
        }
        return view('pages.auth.verifyEmail');
    }

    /**
     * Receives auth credentials from Login form and attemts to log user in.
     *
     * @param credentials
     * @return redirect
     */
    public function authenticate(\App\Http\Requests\Auth\LoginRequest $request)
    {
        $credentials = request()->only(['email', 'password']);

        if (Auth::attempt($credentials)) {
            if(request()->user()->has_access == 0) {
                Auth::logout();
                request()->session()->flash('error_message', trans('First, you must verify your email'));
                return redirect()->home();
            }
            request()->session()->regenerate();
            request()->session()->flash('success_message', trans('You have successfully logged in'));
            Cache::flush();
            return redirect()->home();
        }

        request()->session()->flash('error_message', trans('Incorrect email or password'));
        return back();
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
        request()->session()->flash('success_message', trans('You have successfully logged out'));
        Cache::flush();

        return redirect()->home();
    }

    /**
     * Checks the email before ret the new password if forgot.
     *
     * @return redirect
     */
    public function resetPassword(\App\Http\Requests\Auth\ResetPasswordRequest $request){

        $context = $this->user->resetPassword();

        if($this->user->hasErrors()){
            session()->flash('error_message', $this->user->getFirstError());
            return redirect()->home();
        }

        $mail_sender = new MailSender(env('SET_NEW_PASSWORD_ROUTE'), 'mail.ResetPassword');
        $mail_sender->send($context);

        if($mail_sender->hasErrors()){
            session()->flash('error_message', $mail_sender->getFirstError());
        }else{
            session()->flash('success_message', trans('Your request successfully processed. Please, follow the link, that we sent to you email'));
        }
        return redirect()->home();
    }

    /**
     * Page for setting the new password.
     *
     * @return redirect|view
     */
    public function setNewPassword(string $lang, string $token){

        $user = $this->user->where(
            ['verification_token' => $token]
        )->first();
        if(!$user){
            session()->flash('error_message', trans('User not found'));
            return redirect()->home();
        }
        return view('pages.auth.setNewPassword', ['token' => $token, 'name' => $user->name]);
    }

    /**
     * Page for changing the password only for Authenticated user.
     *
     * @return view
     */
    public function changePassword(){

        return view('pages.auth.changePassword');
    }

    /**
     * Handle post request for changing the password only for Authenticated user.
     *
     * @return view
     */
    public function changePasswordPost(\App\Http\Requests\Auth\ChangePasswordRequest $request)
    {
        $user = auth()->user();
        $user->password = \Illuminate\Support\Facades\Hash::make(request()->input('password'));
        $user->save();
        session()->flash('success_message', trans('The new password was successfully saved'));
        return redirect()->route('profile');
    }

    /**
     * Post request for setting the new password.
     *
     * @return redirect
     */
    public function setNewPasswordPost(\App\Http\Requests\Auth\SetNewPasswordRequest $request, string $lang, string $token){

        $user = $this->user->where(
            ['verification_token' => $token]
        )->first();

        if(!$user){
            session()->flash('error_message', trans('User not found'));
            return redirect()->home();
        }
        $this->user->setNewPassword($user);
        session()->flash('success_message', trans('The new password successfully set'));
        return redirect()->home();
    }
}
