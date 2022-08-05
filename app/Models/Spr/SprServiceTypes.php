<?php

namespace App\Models\Spr;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class SprServiceTypes extends BaseSprModel
{
    use HasFactory;

    /**
     * Name of table in DB.
     */
    protected $table = "spr_service_types";
}
