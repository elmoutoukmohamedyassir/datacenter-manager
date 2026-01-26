<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    //
    protected $fillable = ['user_id', 'resource_id', 'start_time', 'end_time', 'status', 'justification', 'admin_note'];
    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime'
    ];
    public function resource() {
        return $this->belongsTo(Resource::class);
    }
    public function user() {
        return $this->belongsTo(User::class);
    }
}
