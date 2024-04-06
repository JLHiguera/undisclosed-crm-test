<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ContactTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function create_contact_on_client(): void
    {
        $client = Client::factory()->create();

        $contact_data1 = [
            'nombre' => 'Facebook',
            'telefono' => '8123456789',
            'whatsapp' => '8198765432',
            'correo' => 'example@example.net',
            'puesto' => 'CFO',
        ];

        $contact_data2 = [
            'nombre' => 'Google',
            'telefono' => '8199999999',
            'whatsapp' => '8111111111',
            'correo' => 'example@example.net',
            'puesto' => 'CTO',
        ];

        $this->postJson("/api/client/{$client->id}/contact", $contact_data1)
            ->assertCreated();

        $this->postJson("/api/client/{$client->id}/contact", $contact_data2)
        ->assertCreated();

        $this->get("/api/client/{$client->id}")
            ->assertJsonFragment($contact_data1)
            ->assertJsonFragment($contact_data2);
    }
}
