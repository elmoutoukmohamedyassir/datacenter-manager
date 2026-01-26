<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    //
    protected $fillable = ['resource_id', 'start_time', 'end_time', 'reason'];
    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];
    public function resource()
    {
        return $this->belongsTo(Resource::class);
    }
}
