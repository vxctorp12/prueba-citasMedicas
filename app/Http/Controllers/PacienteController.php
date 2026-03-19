<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    public function index()
    {
        $pacientes = Paciente::all();
        return response()->json($pacientes, 200);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'dui' => ['required', 'string', 'unique:pacientes', 'regex:/^\d{8}-\d$/'], // Formato exacto del DUI
            'fecha_nacimiento' => 'required|date',
        ]);

        $paciente = Paciente::create($validatedData);

        return response()->json([
            'mensaje' => 'Paciente registrado exitosamente',
            'paciente' => $paciente
        ], 201);
    }

    public function citasPorPaciente($id)
    {
        $paciente = Paciente::with('citas')->find($id);

        if (!$paciente) {
            return response()->json(['mensaje' => 'Paciente no encontrado'], 404);
        }

        return response()->json($paciente->citas, 200);
    }
}