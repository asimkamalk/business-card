<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactInfo extends Model
{
    use HasFactory;

    protected $fillable = ['profile_id', 'type', 'value'];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
