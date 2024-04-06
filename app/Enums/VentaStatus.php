<?php

namespace App\Enums;

enum VentaStatus: string
{
    case Iniciada = 'iniciada';
    case Procesando = 'procesando';
    case Completada = 'completada';
    case Rechazada = 'rechazada';
}
