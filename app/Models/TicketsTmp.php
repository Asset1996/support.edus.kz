<?php
/**
 * Temporary tickets model.
 * If temporary ticket is not activated within 30 days,
 * then it will be removed.
 */
namespace App\Models;

use Illuminate\Support\Facades\Hash;
use App\Helpers\MailSender;

class TicketsTmp extends BaseModel
{
    /**
     * Name of table in DB.
     */
    protected $table = "support_tickets_tmp";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'ticket_uid',
        'title',
        'initial_message',
        'service_types_id',
        'created_by'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the tickets that owns the User.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    /**
     * Get all the uploads of current ticket.
     */
    public function uploads()
    {
        return $this->hasMany(\App\Models\Uploads::class, 'ticket_uid', 'ticket_uid');
    }

    /**
     * Creates temporary ticket.
     *
     * @param array $context
     * @return object
     */
    public function _create(array $context = []){
        $user_model = new User();
        if ($user_model->isUserExist(['email' => $context['email']])){
            $this->errors[] = trans('You already have an account with current email') . ' - ' . $context['email'];
            return false;
        }

        $context = request()->only(['name', 'email', 'title', 'initial_message', 'service_types_id']);
        $password = \Illuminate\Support\Str::random();
        $context['password'] = Hash::make($password);
        $context['verification_token'] = uniqid();

        $user = $user_model->_create($context);

        $context['password'] = $password;
        $context['created_by'] = $user->id;
        $mail_sender = new MailSender(env('VERIFY_EMAIL_ROUTE'), 'mail.VerifyEmailTemp');
        $mail_sender->send($context);

        $context['ticket_uid'] = 't_' . uniqid();
        return $this::create($context);
    }

    /**
     * Updates the temporary ticket.
     *
     * @param array $conditions
     * @param array $context
     * @return object
     */
    public function _update(array $conditions, array $context){
        return $this::where($conditions)->update($context);
    }

    /**
     * Deletes the temporary ticket.
     *
     * @param array $conditions
     * @return object
     */
    public function _delete(array $conditions){
        return $this::where($conditions)->delete();
    }
}
