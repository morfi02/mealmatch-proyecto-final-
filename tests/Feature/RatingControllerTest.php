<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Rating;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class RatingControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]

    public function store_crea_nueva_calificacion()
    {
        $user = User::factory()->create();
        $seller = User::factory()->create();

        $response = $this->actingAs($user)->post(route('rate.chef'), [
            'seller_id' => $seller->id,
            'rating' => 5,
            'comment' => 'Excelente!',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('ratings', [
            'user_id' => $user->id,
            'seller_id' => $seller->id,
            'rating' => 5,
            'comment' => 'Excelente!',
        ]);
    }

    #[Test]

    public function store_actualiza_calificacion_existente()
    {
        $user = User::factory()->create();
        $seller = User::factory()->create();

        Rating::create([
            'user_id' => $user->id,
            'seller_id' => $seller->id,
            'rating' => 3,
            'comment' => 'Normal',
        ]);

        $this->actingAs($user)->post(route('rate.chef'), [
            'seller_id' => $seller->id,
            'rating' => 4,
            'comment' => 'Mejoró',
        ]);

        $this->assertDatabaseHas('ratings', [
            'user_id' => $user->id,
            'seller_id' => $seller->id,
            'rating' => 4,
            'comment' => 'Mejoró',
        ]);
    }

    #[Test]

    public function store_requiere_campos()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('rate.chef'), []);

        $response->assertSessionHasErrors(['seller_id', 'rating']);
    }

    #[Test]

    public function store_rechaza_calificacion_fuera_de_rango()
    {
        $user = User::factory()->create();
        $seller = User::factory()->create();

        $response = $this->actingAs($user)->post(route('rate.chef'), [
            'seller_id' => $seller->id,
            'rating' => 6,
        ]);

        $response->assertSessionHasErrors(['rating']);
    }

    #[Test]

    public function usuarios_no_autenticados_no_pueden_guardar_calificacion()
    {
        $seller = User::factory()->create();

        $response = $this->post(route('rate.chef'), [
            'seller_id' => $seller->id,
            'rating' => 4,
        ]);

        $response->assertRedirect('/login');
    }
}