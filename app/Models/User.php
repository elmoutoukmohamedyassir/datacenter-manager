<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Factories\Relationship;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    //
    use HasFactory, Notifiable;
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'account_status'
    ];

    public function roles() {
        return $this->belongsTo(Role::class, 'user_role');
    }
}
