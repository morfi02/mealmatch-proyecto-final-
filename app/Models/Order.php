<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'cocinero_id',
        'items',
    ];

    protected $casts = [
        'items' => 'array', 
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cocinero()
    {
        return $this->belongsTo(User::class, 'cocinero_id');
    }
}
