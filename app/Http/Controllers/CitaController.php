<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use Illuminate\Http\Request;

class CitaController extends Controller
{
    // POST /api/citas: Programar una nueva cita
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'paciente_id' => 'required|exists:pacientes,id', // Verifica que el paciente exista
            'fecha_cita' => 'required|date|after:today',     // La cita debe ser en el futuro
            'motivo' => 'required|string',
        ]);

        $cita = Cita::create($validatedData);

        return response()->json([
            'mensaje' => 'Cita programada exitosamente',
            'cita' => $cita
        ], 201);
    }
}