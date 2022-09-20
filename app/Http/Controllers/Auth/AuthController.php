<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ChangePasswordRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegistrationPostRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Http\Requests\Auth\SetNewPasswordRequest;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Helpers\MailSender;
use Illuminate\Support\Facades\Cache;

class AuthController extends Controller
{
    /**
     * @var User
     */
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Sign up a new user into the system.
     *
     * @param RegistrationPostRequest $request
     * @return RedirectResponse
     */
    public function registration(RegistrationPostRequest $request): RedirectResponse
    {
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
     * @param string $lang
     * @param string $token - email verification token.
     * @return View
     */
    public function verifyEmail(string $lang, string $token): View
    {

        $user = $this->user->verifyEmail($token);
        session()->forget(['error_message', 'success_message']);
        if($this->user->hasErrors()){
            session()->flash('error_message', $this->user->getFirstError());
        }else{
            Auth::login($user);
            session()->flash('success_message', trans('Email verified successfully'));
        }
        return View('pages.auth.verifyEmail');
    }

    /**
     * Receives auth credentials from Login form and attemts to log user in.
     *
     * @param LoginRequest $request
     * @return RedirectResponse
     */
    public function authenticate(LoginRequest $request): RedirectResponse
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
     * @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {
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
     * @param ResetPasswordRequest $request
     * @return RedirectResponse
     */
    public function resetPassword(\App\Http\Requests\Auth\ResetPasswordRequest $request): RedirectResponse
    {

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
     * @param string $lang
     * @param string $token
     * @return RedirectResponse|View
     */
    public function setNewPassword(string $lang, string $token){

        $user = $this->user->where(
            ['verification_token' => $token]
        )->first();
        if(!$user){
            session()->flash('error_message', trans('User not found'));
            return redirect()->home();
        }
        return View('pages.auth.setNewPassword', ['token' => $token, 'name' => $user->name]);
    }

    /**
     * Page for changing the password only for Authenticated user.
     *
     * @return View
     */
    public function changePassword(): View
    {

        return View('pages.auth.changePassword');
    }

    /**
     * Handle post request for changing the password only for Authenticated user.
     *
     * @param ChangePasswordRequest $request
     * @return RedirectResponse
     */
    public function changePasswordPost(\App\Http\Requests\Auth\ChangePasswordRequest $request): RedirectResponse
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
     * @param SetNewPasswordRequest $request
     * @param string $lang
     * @param string $token
     * @return RedirectResponse
     */
    public function setNewPasswordPost(
        SetNewPasswordRequest $request,
        string $lang,
        string $token
    ): RedirectResponse
    {

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
