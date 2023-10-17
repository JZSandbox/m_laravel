<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Companies extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_name',
        'owner',
        'country',
        'state',
        'address',
        'address_number',
        'zip',
        'phone_number',
        'company_logo_folder',
        'company_place',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
