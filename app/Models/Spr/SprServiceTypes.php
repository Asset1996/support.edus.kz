<?php

namespace App\Models\Spr;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class SprServiceTypes extends Model implements BaseSprInterface
{
    use HasFactory;

    /**
     * Name of table in DB.
     */
    protected $table = "spr_service_types";

    public static function get(){
        return self::all();
    }
}
