<?php

namespace App\Http\Controllers;

use App\Models\Sensor;
use Illuminate\Http\Request;

class SensorController extends Controller
{
    /*** Mostrar la lista de sensores en la gestión.
    */
   public function index()
   {
       $sensors = Sensor::where('is_visible', true)->get(); // Solo sensores visibles
       return view('admin.sensors.index', compact('sensors'));
   }
    
    /**
     * Mostrar el formulario para agregar un sensor existente.
     */
    public function create()
    {
        $sensors = Sensor::where('is_visible', false)->get(); // Sensores no visibles
        return view('admin.sensors.create', compact('sensors'));
    }
    /**
     * Guardar la información del sensor y hacerlo visible.
     */
    public function store(Request $request)
{
    $request->validate([
        'sensor_id' => 'required|exists:sensors,id',
        'location' => 'required|string|max:255',
        'latitude' => 'required|numeric', // Validar que la latitud sea un número
        'longitude' => 'required|numeric', // Validar que la longitud sea un número
    ]);

    // Actualizar el sensor seleccionado
    $sensor = Sensor::findOrFail($request->sensor_id);
    $sensor->location = $request->location; // Asignar ubicación
    $sensor->latitude = $request->latitude; // Asignar latitud
    $sensor->longitude = $request->longitude; // Asignar longitud
    $sensor->is_visible = true; // Hacer visible
    $sensor->save();

    return redirect()->route('admin.sensors.index')->with('success', 'Sensor agregado y actualizado correctamente.');
}

    public function toggleVisibility($id)
    {
        $sensor = Sensor::findOrFail($id);
        $sensor->is_visible = !$sensor->is_visible;
        $sensor->save();

        return redirect()->route('admin.sensors.index')->with('success', 'Estado de visibilidad actualizado.');
    }
    public function list()
    {
        // Solo obtener sensores visibles
    $sensors = \App\Models\Sensor::where('is_visible', true)->get();

        // Retornar la vista con los sensores
        return view('sensors.list', compact('sensors'));
    }
    public function show(Request $request, $id)
{
    $sensor = \App\Models\Sensor::findOrFail($id);

    // Lecturas con paginación para la tabla y la gráfica
    $paginatedReadings = $sensor->readings()->orderBy('created_at', 'desc')->paginate(10);

    // Preparar datos para la gráfica basados en lecturas paginadas
    $chartData = [
        'labels' => $paginatedReadings->map(function ($reading) {
            return \Carbon\Carbon::parse($reading->created_at)->format('Y-m-d H:i');
        }),
        'temperature' => $paginatedReadings->pluck('temperature'),
        'humidity' => $paginatedReadings->pluck('humidity'),
    ];

    // Obtener la ubicación proporcionada, si existe
    $location = $request->get('location', 'No especificada');

    return view('sensors.show', compact('sensor', 'chartData', 'paginatedReadings', 'location'));
}
public function remove($id)
{
    $sensor = Sensor::findOrFail($id);
    $sensor->is_deleted = true; // Marcar como eliminado
    $sensor->save();

    return redirect()->route('admin.sensors.index')->with('success', 'El sensor ha sido eliminado de la tabla.');
}
public function update(Request $request, $id)
{
    $request->validate([
        'location' => 'required|string|max:255',
    ]);

    $sensor = \App\Models\Sensor::findOrFail($id);
    $sensor->update([
        'location' => $request->location,
    ]);

    return redirect()->route('admin.sensors.index')->with('success', "La ubicación del sensor {$sensor->name} fue actualizada a {$sensor->location}.");
}

    
}
