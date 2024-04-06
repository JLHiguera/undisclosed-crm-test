<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ClientTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function create_client_test(): void
    {
        $client_data = [
            'nombre' => 'Test',
            'razon_social' => '',
            'direccion' => 'Padre Mier',
            'estimacion_venta' => '200.00',
            'observaciones' => 'ninguna',
            'giro' => 'tecnología',
            'url' => 'http://localhost',
            'fase_venta' => 'iniciada',
        ];

        $response = $this->postJson('/api/client', $client_data)
            ->assertCreated();
    }

    /**
     * Test the retrieval of a single client.
     */
    public function get_single_client_info(): void
    {
        $client_data = [
            'nombre' => 'Test',
            'razon_social' => '',
            'direccion' => 'Padre Mier',
            'estimacion_venta' => '200.00',
            'observaciones' => 'ninguna',
            'giro' => 'tecnología',
            'url' => 'http://localhost',
            'fase_venta' => 'iniciada',
        ];

        $client = Client::create($client_data);

        $this->get("/api/clients/{$client->id}")
            ->assertJsonFragment($client_data);
    }

    public function edit_client_info(): void
    {
        $client_data = [
            'nombre' => 'Test',
            'direccion' => 'Padre Mier',
            'estimacion_venta' => '200.00',
            'observaciones' => 'ninguna',
            'giro' => 'tecnología',
            'url' => 'http://localhost',
            'fase_venta' => 'iniciada',
        ];

        $client = Clients::create($client_data);

        $expected_data = [
            'nombre' => 'Test',
            'direccion' => 'Padre Mier',
            'estimacion_venta' => '400.00',
            'observaciones' => 'ninguna',
            'giro' => 'logistica',
            'url' => 'http://localhost',
            'fase_venta' => 'iniciada',
        ];

        $this->putJson("/api/client/{$client->id}", $client_data);

        $this->get("/api/client/{$client->id}")
            ->assertStatus('200')
            ->assertJsonFragment($expected_data);
    }

    public function delete_client(): void
    {
        $client = Client::factory()->take(1);

        $this->assertDatabaseHas('clients', [
            'id' => $client->id,
            'nombre' => $client->nombre,
        ]);

        $this->delete("/api/clients/{$client->id}");

        $this->assertSoftDeleted($client);
    }
}
