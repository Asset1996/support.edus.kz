<?php

namespace App\Models\StaticModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferenceBook extends Model
{
    use HasFactory;

    /**
     * Name of table in DB.
     */
    protected $table = "support_reference_book";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'question_kk',
        'question_ru',
        'answer_kk',
        'answer_ru',
        'link',
    ];
}
