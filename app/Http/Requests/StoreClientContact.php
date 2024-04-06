<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientContact extends FormRequest
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
            'nombre' => 'required|string|min:6|max:60',
            'telefono' => 'required|string|min:10|max:10',
            'whatsapp' => 'required|string|min:10|max:10',
            'correo' => 'required|bail|email|max:50',
            'puesto' => 'required|string|min:3|max:50',
        ];
    }
}
