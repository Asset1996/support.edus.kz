<?php
/**
 * User model.
 */
namespace App\Models;

use Illuminate\Support\Facades\Hash;
use App\Helpers\MailSender;
use Illuminate\Auth\Authenticatable;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class User extends BaseModel implements 
    AuthenticatableContract,
    AuthorizableContract
{
    use Authenticatable, Authorizable;

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
     * Get the tickets that owns the User.
     */
    public function tickets()
    {
        return $this->hasMany(Tickets::class, 'created_by', 'id');
    }

    public function tickets_tmp()
    {
        return $this->hasMany(TicketsTmp::class, 'created_by', 'id');
    }

    /**
     * Creates the new user in DB.
     *
     * @return bool|object 
     */
    public function _create(array $context = []){
        return $this::create($context);
    }

    /**
     * Verifies email by verification token.
     *
     * @return bool 
     */
    public function verifyEmail(string $token){

        $user = $this::where([
            'has_access' => 0, 
            'verification_token' => $token
        ])->first();
        if(!$user){
            $this->errors[] = trans('Email verification failed');
            return False;
        }

        $verified = $user->update([
            'email_verified_at' => now(),
            'verification_token' => null,
            'has_access' => 1
        ]);

        if(!$verified){
            $this->errors[] = trans('Email verification failed');
            return False;
        }
        
        if($user->tickets_tmp->isNotEmpty()){
            $temp_tickets_id = $user->tickets_tmp->modelKeys();
            TicketsTmp::whereIn('id', $temp_tickets_id)->delete();
            Tickets::get_tickets_from_temp($user->tickets_tmp);
        }

        return $user;
    }

    /**
     * Verifies email and resets the password.
     *
     * @return bool|array
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

        $context = [
            'verification_token' => $user->verification_token,
            'email' => $email,
            'name' => $user->name
        ];
        
        return $context;
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
     * Checks if user exists by key=>val.
     *
     * @param array $data
     * @return object|bool
     */
    public function isUserExist(array $data){
        return $this::select('id')->where($data)->first();
    }

    /**
     * Updates the user in DB.
     *
     * @param array $conditions
     * @param array $context
     * @return object 
     */
    public function _update(array $conditions = [], array $context = []){
        return $this::where($conditions)->update($context);
    }

    /**
     * Deletes the user from DB.
     *
     * @param array $conditions
     * @return object 
     */
    public function _delete(array $conditions){
        return $this::where($conditions)->delete();
    }
}
