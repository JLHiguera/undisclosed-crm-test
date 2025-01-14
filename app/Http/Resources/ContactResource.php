<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContactResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'nombre' => $this->nombre,
            'telefono' => $this->telefono,
            'whatsapp' => $this->whatsapp,
            'correo' => $this->correo,
            'puesto' => $this->puesto,
        ];
    }
}
