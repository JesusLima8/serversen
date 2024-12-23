<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Agregar Sensor Existente') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('admin.sensors.store') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="sensor" class="block text-base font-medium">Seleccionar Sensor:</label>
                            <select id="sensor" name="sensor_id" required class="mt-1 text-black block w-full border-gray-300 rounded-md shadow-sm">
                                @foreach ($sensors as $sensor)
                                    <option value="{{ $sensor->id }}">{{ $sensor->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="location" class="block text-base font-medium">Ubicación del Sensor:</label>
                            <input type="text" id="location" name="location" required class="mt-1 text-black block w-full border-gray-300 rounded-md shadow-sm">
                        </div>
                        <div class="mb-4">
                            <label for="latitude" class="block text-base font-medium">Latitud:</label>
                            <input type="text" id="latitude" name="latitude" required class="mt-1 text-black block w-full border-gray-300 rounded-md shadow-sm">
                        </div>
                        <div class="mb-4">
                            <label for="longitude" class="block text-base font-medium">Longitud:</label>
                            <input type="text" id="longitude" name="longitude" required class="mt-1 text-black block w-full border-gray-300 rounded-md shadow-sm">
                        </div>
                        <a href="/map_selector.php" class="inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                            Seleccionar en el Mapa
                        </a>
                        <button type="submit" class="user-option-item bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                            Guardar Información
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Cargar las coordenadas del mapa seleccionadas si están disponibles
        document.addEventListener("DOMContentLoaded", () => {
            const lat = localStorage.getItem("selectedLatitude");
            const lng = localStorage.getItem("selectedLongitude");
            if (lat && lng) {
                document.getElementById("latitude").value = lat;
                document.getElementById("longitude").value = lng;

                // Limpiar localStorage
                localStorage.removeItem("selectedLatitude");
                localStorage.removeItem("selectedLongitude");
            }
        });
    </script>
</x-app-layout>
