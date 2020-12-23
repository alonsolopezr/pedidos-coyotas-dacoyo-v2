<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'lastname',
        'email',
        'celular',
        'password',
        'street',
        'number',
        'residential',
        'post_code',
        'profile_photo_path',
        'qr_client',
    ];
}
