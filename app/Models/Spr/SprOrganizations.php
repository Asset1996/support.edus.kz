<?php

namespace App\Models\Spr;

use Illuminate\Database\Eloquent\Model;

class SprOrganizations extends Model implements BaseSprInterface
{
    /**
     * Name of table in DB.
     */
    protected $table = "spr_organizations";

    public static function get(){
        return self::all();
    }
}
