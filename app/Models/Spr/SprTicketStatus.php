<?php

namespace App\Models\Spr;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class SprTicketStatus extends BaseSprModel
{
    use HasFactory;

    /**
     * Name of table in DB.
     */
    protected $table = "spr_ticket_status";
}
