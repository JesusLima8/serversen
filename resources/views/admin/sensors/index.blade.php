<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Gestión de Sensores') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <!-- Botón de Agregar Sensor -->
                    <div class="mb-4">
                        <a href="{{ route('admin.sensors.create') }}" class="user-option-title text-white px-1 py-1">
                            Agregar Sensor
                        </a>
                    </div>

                    <!-- Tabla de Sensores -->
                    <table class="table-auto w-full border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-500">
                                <th class="border border-gray-300 px-4 py-2 text-black">Nombre del Sensor</th>
                                <th class="border border-gray-300 px-4 py-2 text-black">Ubicación</th>
                                <th class="border border-gray-300 px-4 py-2 text-black">Latitud</th>
                                <th class="border border-gray-300 px-4 py-2 text-black">Longitud</th>
                                <th class="border border-gray-300 px-4 py-2 text-black">Visible</th>
                                <th class="border border-gray-300 px-4 py-2 text-black">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sensors as $sensor)
                                <tr>
                                    <td class="border border-gray-300 px-4 py-2">{{ $sensor->name }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $sensor->location ?? 'Sin Ubicación' }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $sensor->latitude ?? 'No disponible' }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $sensor->longitude ?? 'No disponible' }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $sensor->is_visible ? 'Sí' : 'No' }}</td>
                                    <td class="border border-gray-300 px-4 py-2 flex space-x-2">
                                        <!-- Botón para cambiar visibilidad -->
                                        <form method="POST" action="{{ route('admin.sensors.toggle', $sensor->id) }}">
                                            @csrf
                                            <button type="submit" class=" custom-button px-8 py-1">
                                                {{ $sensor->is_visible ? 'Eliminar' : 'Mostrar' }}
                                            </button>
                                        </form>|

                                        <!-- Botón para Ver -->
                                        <a href="{{ route('sensors.show', $sensor->id) }}" class=" green-button px-8 py-1">
                                            Ver
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
