<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Sensores Disponibles') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Tabla de Sensores Disponibles -->
                    <table class="table-auto w-full border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-500">
                                <th class="border border-gray-300 px-4 py-2 text-black">Nombre</th>
                                <th class="border border-gray-300 px-4 py-2 text-black">Ubicación</th>
                                <th class="border border-gray-300 px-4 py-2 text-black">Latitud</th>
                                <th class="border border-gray-300 px-4 py-2 text-black">Longitud</th>
                                <th class="border border-gray-300 px-4 py-2 text-black">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sensors as $sensor)
                                @if ($sensor->is_visible)
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">{{ $sensor->name }}</td>
                                        <td class="border border-gray-300 px-4 py-2">{{ $sensor->location }}</td>
                                        <td class="border border-gray-300 px-4 py-2">{{ $sensor->latitude ?? 'No Disponible' }}</td>
                                        <td class="border border-gray-300 px-4 py-2">{{ $sensor->longitude ?? 'No Disponible' }}</td>
                                        <td class="border border-gray-300 px-4 py-2">
                                            <a href="{{ route('sensors.show', $sensor->id) }}" class=" green-button px-8 py-1">
                                                Ver
                                            </a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
