<?php

namespace App\Models\StaticModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    /**
     * Name of table in DB.
     */
    protected $table = "announcements";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'theme_kk',
        'theme_ru',
        'message_kk',
        'message_ru',
        'date',
        'link',
    ];
}
