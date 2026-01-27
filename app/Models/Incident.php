<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    //
    protected $fillable = [
        'resource_id',
        'reported_by',
        'description',
        'priority',
        'status'
    ];

    public function resource()
    {
        return $this->belongsTo(Resource::class);
    }

    public function reporter()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
