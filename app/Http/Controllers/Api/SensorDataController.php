<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sensor;
use App\Models\Reading;

class SensorDataController extends Controller
{
    /**
     * Almacenar los datos enviados desde el ESP32.
     */
    public function store(Request $request)
    {
        // Validar los datos recibidos
        $validated = $request->validate([
            'sensor_name' => 'required|string', // Nombre del sensor es obligatorio
            'temperature' => 'required|numeric', // Temperatura debe ser un número
            'humidity' => 'required|numeric', // Humedad debe ser un número
        ]);

        // Buscar o crear el sensor según su nombre
        $sensor = Sensor::firstOrCreate(
            ['name' => $validated['sensor_name']],
            [
                'location' => 'No especificada', // Ubicación por defecto
                'is_visible' => false, // No visible por defecto
            ]
        );

        // Almacenar la lectura asociada al sensor
        Reading::create([
            'sensor_id' => $sensor->id,
            'temperature' => $validated['temperature'],
            'humidity' => $validated['humidity'],
            'created_at' => now(),
        ]);

        // Responder al cliente con un mensaje de éxito
        return response()->json(['message' => 'Lectura recibida con éxito'], 200);
    }
}
