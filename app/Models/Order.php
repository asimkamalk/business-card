<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_product_id',
        'customer_name',
        'customer_email',
        'customer_whatsapp',
        'customer_phone',
        'customer_address',
        'notes',
        'total_amount',
        'payment_method',
        'status',
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
    ];

    public function adminProduct()
    {
        return $this->belongsTo(AdminProduct::class);
    }
}
