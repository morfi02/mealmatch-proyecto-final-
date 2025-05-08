<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Dish;
use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;



class UsuariosControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]

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

   #[Test]

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

    #[Test]

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

    #[Test]
    public function filtra_cocineros_por_nombre()
    {
        $cliente = User::factory()->create(['rol' => 'cliente']);
        $this->actingAs($cliente);
    
        $cocinero1 = User::factory()->create(['name' => 'Juan Cocinero', 'rol' => 'cocinero']);
        $cocinero2 = User::factory()->create(['name' => 'Pedro Chef', 'rol' => 'cocinero']);
    
        $response = $this->get('/buscar-cocineros?search=Juan');
    
        $response->assertStatus(200);
        $response->assertSee('Juan Cocinero');
        $response->assertDontSee('Pedro Chef');
    }
    
    
}

