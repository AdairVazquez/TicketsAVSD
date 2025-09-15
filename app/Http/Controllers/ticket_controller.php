<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ticket_controller extends Controller
{
    public function todosTickets()
    {
        // Obtenemos tickets con relaciones y paginación
        $tickets = Ticket::with(['creador:id,name', 'asignado:id,name'])
            ->paginate(10);

        // Mapear para incluir nombres y otros campos
        $json = $tickets->map(function ($ticket) {
            return [
                'id' => $ticket->id,
                'titulo' => $ticket->titulo,
                'descripcion' => $ticket->descripcion,
                'nombre_creador' => $ticket->creador?->name ?? 'Sin asignar',
                'nombre_asignado' => $ticket->asignado?->name ?? 'Sin asignar',
                'id_subcategoria' => $ticket->id_subcategoria,
                'id_prioridad' => $ticket->id_prioridad,
                'id_estado' => $ticket->id_estado,
                'id_archivo' => $ticket->id_archivo,
                'id_archivo_respuesta' => $ticket->id_archivo_respuesta,
                'creado_en' => $ticket->creado_en,
                'actualizado_en' => $ticket->actualizado_en,
            ];
        });

        // Devolver JSON con info de paginación
        return response()->json([
            'data' => $json,
            'current_page' => $tickets->currentPage(),
            'last_page' => $tickets->lastPage(),
            'per_page' => $tickets->perPage(),
            'total' => $tickets->total(),
        ]);
    }
}
