<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'image_path',
        'memo',
        'latitude',
        'longitude',
        'user_id',
        'category',
        'spotted_at',
        'individual_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
