<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model {
    protected $fillable = ['user_id', 'seller_id', 'rating', 'comment'];

    // Relación con el cliente (quien califica)
    public function user() {
        return $this->belongsTo(User::class);
    }

    // Relación con el chef (calificado)
    public function seller() {
        return $this->belongsTo(User::class, 'seller_id');
    }
}
