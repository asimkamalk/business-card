<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'banner_image',
        'profile_image',
        'location',
        'company',
        'position',
        'bio',
        'theme'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function contactInfos()
    {
        return $this->hasMany(ContactInfo::class);
    }

    public function socialMedia()
    {
        return $this->hasMany(SocialMedia::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
