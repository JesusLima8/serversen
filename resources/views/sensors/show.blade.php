<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Datos del Sensor: ') }} {{ $sensor->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <!-- Información del Sensor -->
                    <h3 class=" green-tit px-8 py-1 text-lg font-bold mb-4">Información del Sensor</h3>
                    <p><strong>Nombre:</strong> {{ $sensor->name }}</p>
                    <p><strong>Ubicación:</strong> {{ $sensor->location ?? 'No especificada' }}</p>
                    <p><strong>Latitud:</strong> {{ $sensor->latitude ?? 'No disponible' }}</p>
                    <p><strong>Longitud:</strong> {{ $sensor->longitude ?? 'No disponible' }}</p>

                    <!-- Gráfica -->
                    <h3 class="text-lg font-bold mb-4 mt-6">Gráfica de Lecturas (10 ultimas lecturas)</h3>
                    <div style="height: 400px; width: 100%;">
                        <canvas id="sensorChart"></canvas>
                    </div>

                    <!-- Tabla -->
                    <h3 class="text-lg font-bold mt-8 mb-4">Lecturas de {{ $sensor->name }}</h3>
                    <table class="table-auto w-full border-collapse border border-gray-800">
                        <thead>
                            <tr>
                                <th class="border border-gray-600 px-4 py-2">Tiempo</th>
                                <th class="border border-gray-600 px-4 py-2">Temperatura (°C)</th>
                                <th class="border border-gray-600 px-4 py-2">Humedad (%)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($paginatedReadings as $reading)
                                <tr>
                                    <td class="border border-gray-600 px-4 py-2">{{ $reading->created_at }}</td>
                                    <td class="border border-gray-600 px-4 py-2">{{ $reading->temperature }}</td>
                                    <td class="border border-gray-600 px-4 py-2">{{ $reading->humidity }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Controles de paginación -->
                    <div class="mt-4">
                        {{ $paginatedReadings->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script para la gráfica -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('sensorChart').getContext('2d');
        const sensorChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($chartData['labels']) !!},
                datasets: [
                    {
                        label: 'Temperatura (°C)',
                        data: {!! json_encode($chartData['temperature']) !!},
                        borderColor: 'rgba(255, 99, 132, 1)',
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        fill: true,
                    },
                    {
                        label: 'Humedad (%)',
                        data: {!! json_encode($chartData['humidity']) !!},
                        borderColor: 'rgba(54, 162, 235, 1)',
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        fill: true,
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: true, // Asegura que el tamaño del contenedor se mantenga
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Tiempo',
                        },
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Valores',
                        },
                    },
                },
            },
        });
    </script>
</x-app-layout>
