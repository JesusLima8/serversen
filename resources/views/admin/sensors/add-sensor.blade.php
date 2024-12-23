<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Agregar Sensor') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('admin.sensors.store') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium">Nombre del Sensor:</label>
                            <input type="text" id="name" name="name" required
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        </div>
                        <div class="mb-4">
                            <label for="location" class="block text-sm font-medium">Ubicación del Sensor:</label>
                            <input type="text" id="location" name="location" required
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        </div>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                            Guardar Sensor
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
