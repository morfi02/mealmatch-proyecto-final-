<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Dish;
use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsuariosControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function cliente_puede_ver_dashboard()
    {
        $cliente = User::factory()->create([
            'rol' => 'cliente',
        ]);

        $this->actingAs($cliente); 

        $response = $this->get('/cliente/dashboard');

        $response->assertStatus(200);
        $response->assertViewIs('cliente.dashboard');
    }

   /** @test */
    public function cocinero_puede_ver_su_dashboard()
    {
        $cocinero = User::factory()->create([
            'rol' => 'cocinero',
        ]);

        $this->actingAs($cocinero);

        $response = $this->get('/cocinero/dashboard'); 
        $response->assertStatus(200);
        $response->assertViewIs('cocinero.dashboard');
    }

    /** @test */
    public function puede_ver_perfil_de_cocinero()
    {
        $cliente = User::factory()->create();
        $cocinero = User::factory()->create(['rol' => 'cocinero']);
        Order::factory()->create([
            'user_id' => $cliente->id,
            'cocinero_id' => $cocinero->id,
        ]);

        $this->actingAs($cliente);

        $response = $this->get("/cocineros/{$cocinero->id}");
        $response->assertStatus(200);
        $response->assertViewHas('cocinero');
    }
}

