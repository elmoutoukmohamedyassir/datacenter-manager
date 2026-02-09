<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Resource extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'type', 'cpu', 'ram', 'os', 'location', 
        'category_id', 'manager_id', 'specifications', 'status', 'is_active'
    ];

    // This converts the JSON from the DB into a PHP array automatically
    protected $casts = [
        'specifications' => 'array',
        'is_active' => 'boolean',];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }
    }