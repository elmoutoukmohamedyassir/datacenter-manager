<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role', 'role_id', 'is_active'
    ];

    // Helper to check if user is Admin
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    // Helper to check if user is Manager
    public function isManager()
    {
        return $this->role === 'manager';
    }

    // Helper to check if user is Technician
    public function isTechnician()
    {
        return $this->role === 'technician';
    }
}