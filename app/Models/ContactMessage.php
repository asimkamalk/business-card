<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    protected $fillable = [
        'full_name',
        'email',
        'whatsapp_number',
        'message',
        'is_read',
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];
}
