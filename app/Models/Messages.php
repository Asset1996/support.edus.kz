<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Messages extends BaseModel
{
    use HasFactory;

    /**
     * Name of table in DB.
     */
    protected $table = "support_messages";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'ticket_uid',
        'created_by',
        'created_by_type',
        'message_body',
        'order_num',
        'replied_message_id',
        'evaluation',
        'answered_in_ru',
        'answered_in_kk'
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
     * Get the creator of the message.
     */
    public function message_created_by()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    /**
     * Get the evaluator of the message.
     */
    public function message_evaluated_by()
    {
        return $this->belongsTo(User::class, 'evaluated_by', 'id');
    }

    /**
     * Creates message.
     *
     * @param array $context
     * @return object
     */
    public function _create(array $context = []){
        $context['created_by'] = auth()->user()->id;
        return $this::create($context);
    }

    /**
     * Updates the message ticket.
     *
     * @param array $conditions
     * @param array $context
     * @return object
     */
    public function _update(array $conditions = [], array $context = []){
        return $this::where($conditions)->update($context);
    }

    /**
     * Deletes the message from DB.
     *
     * @param array $conditions
     * @return object
     */
    public function _delete(array $conditions){
        return $this::where($conditions)->delete();
    }
}
