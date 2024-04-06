<?php

namespace Database\Factories;

use App\Enums\VentaStatus;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => fake()->name(),
            'razon_social' => Str::random(10),
            'direccion' => fake()->address(),
            'estimacion_venta' => fake()->randomFloat(),
            'observaciones' => fake()->text(20),
            'giro' => fake()->word(),
            'url' => fake()->url(),
            'fase_venta' => fake()->randomElement(VentaStatus::cases()),
        ];
    }
}
