<?php

namespace App\Models\Spr;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class SprTicketStatus extends Model implements BaseSprInterface
{
    use HasFactory;

    /**
     * Name of table in DB.
     */
    protected $table = "spr_ticket_status";

    public static function get(){
        return self::all();
    }
}
