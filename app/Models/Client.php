<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nombre',
        'razon_social',
        'direccion',
        'estimacion_venta',
        'observaciones',
        'giro',
        'url',
        'fase_venta',
    ];

    /**
     * Returns only active clients.
     */
    public function scopeActive(Builder $query)
    {
        return $this->whereNull('deleted_at');
    }

    /**
     * Returns client's contacts.
     */
    public function contacts()
    {
        return $this->hasMany(Contact::class, 'client_id');
    }
}
