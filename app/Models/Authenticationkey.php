<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Authenticationkey extends Model
{
    use HasFactory;

    protected $fillable = [
        "used",
        "authenicationkey",
    ];

}
