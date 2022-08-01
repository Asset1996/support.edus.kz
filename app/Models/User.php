<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use App\Helpers\MailSender;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Array of errors.
     */
    protected $errors = [];

    /**
     * Name of table in DB.
     */
    protected $table = "support_user";
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'surname',
        'lastname',
        'email',
        'password',
        'verification_token',
        'email_verified_at',
        'phone_verified_at',
        'has_access',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'verification_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Creates the new user in DB.
     *
     * @return bool 
     */
    public function createUser(){
        $data = request()->only(['name', 'email', 'password']);
        $data['password'] = Hash::make($data['password']);
        $data['verification_token'] = uniqid();
        if(!MailSender::sendVerificationLinkToEmail($data)){
            $this->errors[] = trans('Error occurred while sending email');
            return False;
        };
        return $this::create($data);
    }

    /**
     * Verifies email by verification token.
     *
     * @return bool 
     */
    public function verifyEmail(string $token){

        $verified = $this::where([
            'has_access' => 0, 
            'verification_token' => $token
        ])->update([
            'email_verified_at' => now(),
            'verification_token' => null,
            'has_access' => 1
        ]);
        if(!$verified){
            $this->errors[] = trans('Email verification failed');
            return False;
        }
        return True;
    }

    /**
     * Verifies email and resets the password.
     *
     * @return bool 
     */
    public function ResetPassword(){
        $email = request()->input('email');
        $user = $this::where([
            'email' => $email
        ])->first();

        if(!$user){
            $this->errors[] = trans('User not found');
            return False;
        }
        $user->verification_token = uniqid();
        $user->save();

        $data = [
            'verification_token' => $user->verification_token,
            'email' => $email,
            'name' => $user->name
        ];
        if(!MailSender::sendLinkToEmailToResetThePassword($data)){
            $this->errors[] = trans('Error occurred while sending email');
            return False;
        };
        return True;
    }

    /**
     * Sets the new password.
     *
     * @param User object $user
     * @return bool 
     */
    public function setNewPassword(User $user){
        $user->password = Hash::make(request()->input('password'));
        $user->verification_token = null;
        return $user->save();
    }

    /**
     * Cheks if the errors array is empty.
     *
     * @return bool 
     */
    public function hasErrors(){
        return !empty($this->errors);
    }

    /**
     * Returns the first element of the errors array.
     *
     * @return array 
     */
    public function getFirstError(){
        return $this->errors[0];
    }
}
