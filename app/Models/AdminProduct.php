<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class AdminProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'image',
        'is_active',
        'featured',
        'stock_quantity',
        'features',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'featured' => 'boolean',
        'price' => 'decimal:2',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);
            }
        });
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
