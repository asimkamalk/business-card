<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialSetting extends Model
{
    protected $fillable = [
        'phone',
        'whatsapp',
        'email',
        'facebook',
        'instagram',
        'twitter',
        'linkedin',
        'youtube',
        'tiktok',
        'bio',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the active social settings (singleton pattern)
     */
    public static function getActive()
    {
        return static::where('is_active', true)->first() ?? static::first();
    }
}
