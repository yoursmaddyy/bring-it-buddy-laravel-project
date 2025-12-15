<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'username',
        'email',
        'phone',
        'cnic',
        'password',
        'otp',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Relationships
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_roles');
    }

    public function travellerPosts()
    {
        return $this->hasMany(TravellerPost::class);
    }

    public function buyerRequests()
    {
        return $this->hasMany(BuyerRequest::class);
    }

    // Helper to check roles easily
    public function hasRole($role)
    {
        return $this->roles()->where('role_name', $role)->exists();
    }
}
