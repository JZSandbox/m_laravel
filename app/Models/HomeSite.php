<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeSite extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'img_path',
        'wartungs',
        'preloader',
        'image_toggle'
    ];
}
