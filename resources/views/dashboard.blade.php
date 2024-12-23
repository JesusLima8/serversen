<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Proyecto SOFWARE-sensores') }}
        </h2>
    </x-slot>

    <div class="flex">
        <!-- Menú Lateral -->
        <aside class="user-option-title">
            @if (Auth::user()->role === 'admin')
                <!-- Botón Principal: Opciones de Administrador -->
                <h3>
                    <button 
                        class="user-option-title w-full text-left px-4 py-2 bg-blue-500 text-white font-semibold rounded"
                        onclick="toggleMenu('admin-options')">
                        {{ __('Opciones de Administrador') }}
                    </button>
                </h3>

                <!-- Opciones de Administrador -->
                <ul id="admin-options" class="hidden space-y-4 pl-4 mt-4" style="list-style: none;">
                    <!-- Gestión de Usuarios -->
                    <li style="list-style: none;">
                        <button 
                            class="user-option-item w-full text-left px-4 py-2 bg-blue-400 hover:bg-blue-500 text-white rounded"
                            onclick="toggleMenu('user-management')">
                            {{ __('Gestión de Usuarios') }}
                        </button>
                        <ul id="user-management" class="hidden space-y-1 pl-6" style="list-style: none;">
                            <li style="list-style: none;">
                                <a href="{{ route('admin.list-users') }}" class="user-option-sub block text-left">
                                    {{ __('-Lista de Usuarios') }}
                                </a>
                            </li>
                            <li style="list-style: none;">
                                <a href="{{ route('admin.create-user') }}" class="user-option-sub block text-left">
                                    {{ __('-Agregar Usuario') }}
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Gestión de Sensores -->
                    <li style="list-style: none;">
                        <button 
                            class="user-option-item w-full text-left px-4 py-2 bg-blue-400 hover:bg-blue-500 text-white rounded" 
                            onclick="toggleMenu('sensor-management')">
                            {{ __('Gestión de Sensores') }}
                        </button>
                        <ul id="sensor-management" class="hidden space-y-1 pl-6" style="list-style: none;">
                            <li style="list-style: none;">
                                <a href="{{ route('admin.sensors.create') }}" class="user-option-sub block text-left">
                                    {{ __('-Agregar Sensores') }}
                                </a>
                            </li>
                            <li style="list-style: none;">
                                <a href="{{ route('admin.sensors.index') }}" class="user-option-sub block text-left">
                                    {{ __('-Lista de Sensores') }}
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>

                <!-- Opciones de Usuario -->
                <li style="list-style: none;">
                    <button 
                        class="user-option-title w-full text-left px-4 py-2 bg-green-500 hover:bg-green-600 text-white font-semibold rounded mt-4"
                        onclick="toggleMenu('user-options')">
                        {{ __('Opciones de Usuario') }}
                    </button>
                    <ul id="user-options" class="hidden user-option-item w-full hidden space-y-1 pl-6 mt-2" style="list-style: none;">
                        <li style="list-style: none;">
                            <a href="{{ route('sensors.list') }}" 
                               class="block text-center  bg-blue-400 hover:bg-blue-500 text-white rounded">
                                {{ __('-Ver Sensores') }}
                            </a>
                        </li>
                    </ul>
                </li>
            @else
                <!-- Opciones de Usuario -->
                <li style="list-style: none;">
                    <button 
                        class="user-option-title w-full text-left px-4 py-2 bg-green-500 hover:bg-green-600 text-white font-semibold rounded mt-4"
                        onclick="toggleMenu('user-options')">
                        {{ __('Opciones de Usuario') }}
                    </button>
                    <ul id="user-options" class=" hidden user-option-item space-y-1 pl-6 mt-2" style="list-style: none;">
                        <li style="list-style: none;">
                            <a href="{{ route('sensors.list') }}" 
                               class="block text-center  bg-blue-400 hover:bg-blue-500 text-white rounded">
                                {{ __('-Ver Sensores') }}
                            </a>
                        </li>
                    </ul>
                </li>
            @endif
        </aside>

        <!-- Contenido Principal -->
        <main class="flex-1 p-6 bg-gray-100 dark:bg-gray-900">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 text-white">
                <h3 class="font-semibold text-xl text-white">
                    @if (Auth::user()->role === 'admin')
                        {{ __('Bienvenido Administrador') }}
                    @else
                        {{ __('Bienvenido Usuario') }}
                    @endif
                </h3>
                <p class="mt-2">{{ __('Selecciona una opción del menú para continuar.') }}</p>
            </div>
        </main>
    </div>

    <script>
        function toggleMenu(id) {
            const menu = document.getElementById(id);
            menu.classList.toggle('hidden');
        }
    </script>
</x-app-layout>
