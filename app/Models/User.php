<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    protected $fillable = ['name', 'email', 'password', 'role_id', 'is_active'];
    protected $casts = [
        'password' => 'hashed',
        'is_active' => 'boolean'
    ]; # Whenever we store a password it's automatically hashed and the same for is_active automatically turned into a boolean.
    public function role() {
        return $this->belongsTo(Role::class);
    }
}
