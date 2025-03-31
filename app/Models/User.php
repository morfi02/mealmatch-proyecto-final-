<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function dishes()
    {
        return $this->hasMany(Dish::class);
    }
    // Para chefs (vendedores): Relación con sus valoraciones
    public function ratingsReceived() {
        return $this->hasMany(Rating::class, 'seller_id');
    }

    // Calcular promedio de estrellas
    public function getAverageRatingAttribute() {
        return $this->ratingsReceived()->avg('rating') ?? 0;
    }

    // Para clientes: Relación con valoraciones hechas
    public function ratingsGiven() {
        return $this->hasMany(Rating::class, 'user_id');
    }
    public function hasRated($sellerId)
    {
        return $this->ratingsGiven()->where('seller_id', $sellerId)->exists();
    }
}

