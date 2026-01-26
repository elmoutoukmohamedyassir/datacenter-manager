<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    //
    protected $casts = [
        'is_active' => 'boolean',
        'specifications' => 'array'
    ];
    protected $fillable = ['name', 'category_id', 'manager_id', 'specifications', 'is_active'];
    public function category() {
        return $this->belongsTo(Category::class);
    }
    public function manager() {
        return $this->belongsTo(User::class, 'manager_id');
    }
}
