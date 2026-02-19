<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Resource extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'type', 
        'category_id', 
        'manager_id', 
        'is_active',
        'cpu', 
        'ram', 
        'os', 
        'location', 
        'specifications', 
        'status'
    ];

    protected $casts = [
        'specifications' => 'array',
        'is_active' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }
}