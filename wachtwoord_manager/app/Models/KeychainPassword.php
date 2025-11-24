<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KeychainPassword extends Model
{
    protected $fillable = [
        'password',
        'username',
        'url',
        'notes',
        'refresh_interval',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
