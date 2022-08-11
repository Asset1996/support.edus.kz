<?php

namespace App\Models;

class Tickets extends BaseModel
{
    /**
     * Name of table in DB.
     */
    protected $table = "support_tickets";

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
        'status_id',
        'created_by',
        'answered_by',
        'answered_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'answered_at' => 'datetime',
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
     * Get the service type.
     */
    public function service_type()
    {
        return $this->belongsTo(\App\Models\Spr\SprServiceTypes::class, 'service_types_id', 'id');
    }

    /**
     * Get all the uploads of current ticket.
     */
    public function uploads()
    {
        return $this->hasMany(\App\Models\Uploads::class, 'ticket_uid', 'ticket_uid');
    }

    /**
     * Get the tickets status.
     */
    public function ticket_status()
    {
        return $this->belongsTo(\App\Models\Spr\SprTicketStatus::class, 'status_id', 'id');
    }

    /**
     * Creates ticket.
     *
     * @param array $context
     * @return object 
     */
    public function _create(array $context = []){
        $context['created_by'] = auth()->user()->id;
        $context['ticket_uid'] = 't_' . uniqid();
        return $this::create($context);
    }

    /**
     * Updates the ticket.
     *
     * @param array $context
     * @return object 
     */
    public function _update(array $conditions, array $context){
        return $this::where($conditions)->update($context);
    }

    /**
     * Deletes the ticket.
     *
     * @param array $conditions
     * @return object 
     */
    public function _delete(array $conditions){
        $ticket = $this::where($conditions)->first();
        if(!in_array($ticket->status_id, [1,2])) {
            $this->errors[] = trans('Only unproccesed or in-processing tickets can be deleted');
            return False;
        }
        return $this::where($conditions)->delete();
    }

    /**
     * Inserts the tickets, that are deleted from temporary tickets table.
     *
     * @param collection $user->tickets_tmp
     * @return bool 
     */
    public static function get_tickets_from_temp($tickets_tmp){
        foreach ($tickets_tmp as $tickets) {
            unset($tickets['id']);
            unset($tickets['created_at']);
            unset($tickets['updated_at']);
            self::create($tickets->toArray());
        }
        return True;
    }
}
