<?php

namespace App\Models\Spr;

use Illuminate\Database\Eloquent\Model;

class SprRoles extends Model implements BaseSprInterface
{
    /**
     * Name of table in DB.
     */
    protected $table = "spr_roles";

    public static function get(){
        return self::all();
    }
}
