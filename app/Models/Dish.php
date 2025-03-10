<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    protected $fillable = ['name', 'description', 'price', 'image', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
