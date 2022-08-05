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
        'tickets_id',
        'user_id',
        'user_type',
        'message_body',
        'order_num',
        'replied_message_id',
        'evaluation',
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
     * Creates message.
     *
     * @param array $context
     * @return object 
     */
    public function _create(array $context = []){
        $context['user_id'] = auth()->user()->id;
        return $this::create($context);
    }
}
