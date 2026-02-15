<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 
        'email', 
        'password', 
        'role', 
        'role_id', 
        'is_active'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // =========================================================================
    // ROLE HELPERS (Requirement 4.1)
    // =========================================================================

    /**
     * Check if user is an Administrator
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Check if user is a Manager
     */
    public function isManager()
    {
        return $this->role === 'manager';
    }

    /**
     * Check if user is a Technician
     */
    public function isTechnician()
    {
        return $this->role === 'technician';
    }

    /**
     * Check if user is a regular Client/User
     */
    public function isUser()
    {
        return $this->role === 'user';
    }

    // =========================================================================
    // RELATIONSHIPS (Requirement 3.1)
    // =========================================================================

    /**
     * Get all reservations made by this user.
     * This allows you to call Auth::user()->reservations in your dashboard.
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