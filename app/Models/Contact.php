<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'nombre',
        'telefono',
        'whatsapp',
        'correo',
        'puesto',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
