<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SocialProfiles extends Model
{
    use HasFactory;
    protected $fillable = [
        'social_id',
        'social_name',
        'social_email',
        'social_avatar',
        'user_id',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
