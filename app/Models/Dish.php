<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Dish extends Model
{
    protected $fillable = ['name', 'description', 'price', 'image', 'tags','user_id'];


    protected $casts = [
        'tags' => 'array',
    ];
    

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
