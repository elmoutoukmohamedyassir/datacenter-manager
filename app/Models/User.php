<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 
        'email', 
        'password', 
        'role', 
        'role_id', 
        'is_active'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // =========================================================================
    // ROLE HELPERS
    // =========================================================================

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isManager()
    {
        return $this->role === 'manager';
    }

    public function isTechnician()
    {
        return $this->role === 'technician';
    }

    public function isUser()
    {
        return $this->role === 'user';
    }

    // =========================================================================
    // RELATIONSHIPS
    // =========================================================================

    /**
     * Get all notifications for the user.
     */
    public function notifications()
    {
        return $this->hasMany(Notification::class)->latest();
    }

    /**
     * Get all reservations made by this user.
     */
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    /**
     * If the user is a manager, get the resources they are responsible for.
     */
    public function managedResources()
    {
        return $this->hasMany(Resource::class, 'manager_id');
    }
}