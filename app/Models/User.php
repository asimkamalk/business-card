<?php

namespace App\Models;

use App\Notifications\PasswordResetNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'status',
        'is_admin'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $dates = ['deleted_at'];

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    // Status attribute for badge display
    public function getStatusBadgeAttribute()
    {
        return match ($this->status) {
            'active' => '<span class="px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">Active</span>',
            'suspended' => '<span class="px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">Suspended</span>',
            'pending' => '<span class="px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">Pending</span>',
            default => '<span class="px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">Unknown</span>',
        };
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeSuspended($query)
    {
        return $query->where('status', 'suspended');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PasswordResetNotification($token));
    }
}
