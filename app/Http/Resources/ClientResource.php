<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
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
            'razon_social' => $this->razon_social,
            'direccion' => $this->direccion,
            'estimacion_venta' => $this->estimacion_venta,
            'observaciones' => $this->observaciones,
            'giro' => $this->giro,
            'url' => $this->url,
            'fase_venta' => $this->fase_venta,
            'contacts' => ContactResource::collection($this->whenLoaded('contacts', $this->contacts)),
            //'contacts' => $this->whenLoaded('contacts', new ContactCollection($this->contacts)),
        ];
    }
}
