<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SensorDataController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Aquí puedes registrar las rutas API para tu aplicación. Estas rutas
| están cargadas por el RouteServiceProvider dentro de un grupo que
| tiene el middleware "api". Disfruta construyendo tu API!
|
*/

// Ruta para recibir los datos enviados desde el ESP32
Route::post('/send-data', function (Request $request) {
    $validated = $request->validate([
        'sensor_name' => 'required|string',
        'temperature' => 'required|numeric',
        'humidity' => 'required|numeric',
    ]);

    // Busca o crea el sensor
    $sensor = Sensor::firstOrCreate(['name' => $validated['sensor_name']]);

    // Almacena la lectura
    Reading::create([
        'sensor_id' => $sensor->id,
        'temperature' => $validated['temperature'],
        'humidity' => $validated['humidity'],
        'created_at' => now(),
    ]);

    return response()->json(['message' => 'Data received successfully'], 200);
});
