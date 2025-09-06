<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    const CREATED_AT = 'creado_en';
    const UPDATED_AT = 'actualizado_en';

    protected $fillable = [
        'titulo',
        'descripcion',
        'id_usuario_creador',
        'id_usuario_asignado',
        'id_subcategoria',
        'id_prioridad',
        'id_estado',
        'id_archivo',
        'id_archivo_respuesta'
    ];
}
