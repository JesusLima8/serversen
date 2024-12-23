<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Lista de Usuarios') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-bold mb-4">Usuarios Registrados</h3>
                    
                    <!-- Tabla de Usuarios -->
                    <table class="table-auto w-full border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-500">
                                <th class="border border-gray-300 px-4 py-2 text-black">ID</th>
                                <th class="border border-gray-300 px-4 py-2 text-black">Nombre</th>
                                <th class="border border-gray-300 px-4 py-2 text-black">Email</th>
                                <th class="border border-gray-300 px-4 py-2 text-black">Rol</th>
                                <th class="border border-gray-300 px-4 py-2 text-black">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td class="border border-gray-300 px-4 py-2">{{ $user->id }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $user->name }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $user->email }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $user->role }}</td>
                                    <td class="border border-gray-300 px-4 py-2">
                                        <!-- Botón de editar -->
                                        <a href="{{ route('admin.edit-user', $user->id) }}" class=" green-button px-8 py-1 ">Editar</a> |
                                        
                                        <!-- Botón de eliminar -->
                                        <form method="POST" action="{{ route('admin.delete-user', $user->id) }}" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="custom-button px-8 py-1" onclick="return confirm('¿Estás seguro de eliminar este usuario?')">Eliminar</button>
                                        </form>
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
