<?php

namespace Tests\Feature;

use App\Models\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ClientTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function create_client_test(): void
    {
        $client_data = [
            'nombre' => 'Test',
            'razon_social' => 'AAAABBBBCD',
            'direccion' => 'Padre Mier',
            'estimacion_venta' => 200.07,
            'observaciones' => 'ninguna',
            'giro' => 'tecnología',
            'url' => 'http://localhost',
            'fase_venta' => 'iniciada',
        ];

        $response = $this->postJson('/api/clients', $client_data)
            ->assertCreated();
    }

    /** @test */
    public function list_clients(): void 
    {
        Client::factory()->count(15)->create();

        $this->get('/api/clients')
            ->assertJsonCount(15, 'data');
    }

    /** @test */
    public function list_only_active_clients(): void 
    {
        $total_client_count = 15;

        $clients = Client::factory()->count($total_client_count)->create();

        $this->get('/api/clients')
            ->assertJsonCount($total_client_count, 'data');

        $deleted_count = 0;

        foreach($clients as $key => $client) {
            if ($key % 2 == 0) {
                $deleted_count += 1;
                $this->delete("/api/clients/{$client->id}");
            }
        }

        $total_active = $total_client_count - $deleted_count;

        $this->get('/api/clients')
            ->assertJsonCount($total_active, 'data');
    }

    /**
     * Test the retrieval of a single client.
     */
    /** @test */
    public function get_single_client_info(): void
    {
        $client_data = [
            'nombre' => 'Test',
            'razon_social' => 'AAAABBBBCD',
            'direccion' => 'Padre Mier',
            'estimacion_venta' => 200.57,
            'observaciones' => 'ninguna',
            'giro' => 'tecnología',
            'url' => 'http://localhost',
            'fase_venta' => 'iniciada',
        ];

        $client = Client::create($client_data);

        $this->get("/api/clients/{$client->id}")
            ->assertJsonFragment($client_data);
    }

    /** @test */
    public function edit_client_info(): void
    {
        $client_data = [
            'nombre' => 'Test',
            'razon_social' => 'AAAABBBBCD',
            'direccion' => 'Padre Mier',
            'estimacion_venta' => 123.45,
            'observaciones' => 'ninguna',
            'giro' => 'tecnología',
            'url' => 'http://localhost',
            'fase_venta' => 'iniciada',
        ];

        $client = Client::create($client_data);

        $expected_data = [
            'nombre' => 'Test',
            'razon_social' => 'AAAABBBBCD',
            'direccion' => 'Padre Mier',
            'estimacion_venta' => 543.21,
            'observaciones' => 'ninguna',
            'giro' => 'logistica',
            'url' => 'http://localhost',
            'fase_venta' => 'iniciada',
        ];

        $this->patchJson("/api/clients/{$client->id}", $expected_data);

        $this->get("/api/clients/{$client->id}")
            ->assertStatus(200)
            ->assertJsonFragment($expected_data);
    }

    /** @test */
    public function delete_client(): void
    {
        $client = Client::factory()->create();

        $this->assertDatabaseHas('clients', [
            'id' => $client->id,
            'nombre' => $client->nombre,
        ]);

        $this->delete("/api/clients/{$client->id}");

        $this->assertSoftDeleted($client);
    }
}
