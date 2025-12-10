<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'profile_id',
        'name',
        'image',
        'description',
        'price',
        'product_link_url',
        'featured'
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
