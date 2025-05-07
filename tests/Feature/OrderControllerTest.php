<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

class OrderControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]

    public function un_usuario_autenticado_puede_crear_o_actualizar_un_pedido()
    {
        $cliente = User::factory()->create();
        $cocinero = User::factory()->create();

        $this->actingAs($cliente);

        $response = $this->postJson('/orders', [
            'cocinero_id' => $cocinero->id,
            'items' => ['paella', 'ensalada'],
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('orders', [
            'user_id' => $cliente->id,
            'cocinero_id' => $cocinero->id,
        ]);
    }

    #[Test]

    public function se_rechaza_un_pedido_sin_items()
    {
        $cliente = User::factory()->create();
        $cocinero = User::factory()->create();

        $this->actingAs($cliente);

        $response = $this->postJson('/orders', [
            'cocinero_id' => $cocinero->id,
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['items']);
    }

    #[Test]

    public function se_rechaza_un_pedido_con_un_cocinero_inexistente()
    {
        $cliente = User::factory()->create();

        $this->actingAs($cliente);

        $response = $this->postJson('/orders', [
            'cocinero_id' => 9999,
            'items' => ['tortilla'],
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['cocinero_id']);
    }

    #[Test]

    public function usuarios_no_autenticados_no_pueden_realizar_pedidos()
    {
        $response = $this->postJson('/orders', [
            'cocinero_id' => 1,
            'items' => ['pizza'],
        ]);

        $response->assertStatus(401);
    }
}
