<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Enums\VentaStatus;

class UpdateClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nombre' => 'string|required|max:50',
            'razon_social' => 'string|required|min:10|max:10',
            'direccion' => 'string|required|max:200',
            'estimacion_venta' => 'decimal:2|required',
            'observaciones' => 'string',
            'giro' => 'string|max:45',
            'url' => 'string|max:100',
            'fase_venta' => Rule::enum(VentaStatus::class),
        ];
    }
}
