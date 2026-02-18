<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'title',
        'message',
        'is_read',
    ];

    /**
     * Relationship: A notification belongs to a specific user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}