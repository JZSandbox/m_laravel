<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutSite extends Model
{
    use HasFactory;

    protected $fillable = [
        'small_title',
        'big_title',
        'text_1',
        'text_2',
        'text_3'
    ];
}
