<?php

namespace App\Models\Spr;

use Illuminate\Database\Eloquent\Model;

class BaseSprModel extends Model
{
    public static function get(){
        return self::all();
    }
}
