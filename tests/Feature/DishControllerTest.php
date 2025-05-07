<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Dish;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

class DishControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]

    public function un_cocinero_puede_crear_un_nuevo_plato()
    {
        Storage::fake('public');

        $cocinero = User::factory()->create();
        $this->actingAs($cocinero);

        $imagen = UploadedFile::fake()->image('plato.jpg');

        $response = $this->post(route('dishes.store'), [
            'name' => 'Tacos de carne',
            'description' => 'Deliciosos tacos mexicanos con salsa picante.',
            'price' => 9.99,
            'image' => $imagen,
            'tags' => ['mexicano', 'picante']
        ]);

        $response->assertRedirect(route('cocinero.dashboard'));
        $this->assertDatabaseHas('dishes', [
            'name' => 'Tacos de carne',
            'user_id' => $cocinero->id,
        ]);

        Storage::disk('public')->assertExists('dishes/' . $imagen->hashName());
    }

    #[Test]

    public function no_se_puede_crear_un_plato_sin_datos_requeridos()
    {
        $cocinero = User::factory()->create();
        $this->actingAs($cocinero);

        $response = $this->post(route('dishes.store'), []); // Vacío

        $response->assertSessionHasErrors(['name', 'description', 'price', 'image']);
    }

    #[Test]

    public function no_autenticado_no_puede_guardar_plato()
    {
        $response = $this->post(route('dishes.store'), [
            'name' => 'Paella',
            'description' => 'Arroz con mariscos.',
            'price' => 12.5,
        ]);

        $response->assertRedirect('/login');
    }
}
