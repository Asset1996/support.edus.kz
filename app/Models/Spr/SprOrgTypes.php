<?php

namespace App\Models\Spr;

use Illuminate\Database\Eloquent\Model;

class SprOrgTypes extends Model implements BaseSprInterface
{
    /**
     * Name of table in DB.
     */
    protected $table = "spr_org_types";

    public static function get(){
        return self::all();
    }
}
