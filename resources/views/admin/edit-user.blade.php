<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Usuario') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="form-container">
            <form method="POST" action="{{ route('admin.update-user', $user->id) }}" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Campo Nombre -->
                <div>
                    <label for="name" class="form-label">Nombre:</label>
                    <input type="text" name="name" id="name" value="{{ $user->name }}" class="form-input" required>
                </div>

                <!-- Campo Email -->
                <div>
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" name="email" id="email" value="{{ $user->email }}" class="form-input" required>
                </div>

                <!-- Campo Contraseña -->
                <div>
                    <label for="password" class="form-label">Contraseña (dejar en blanco si no desea cambiarla):</label>
                    <input type="password" name="password" id="password" class="form-input">
                </div>

                <!-- Campo Rol -->
                <div>
                    <label for="role" class="form-label">Rol:</label>
                    <select name="role" id="role" class="form-input" required>
                        <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>Usuario</option>
                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Administrador</option>
                    </select>
                </div>

                <!-- Botón de Actualizar -->
                <div class="flex justify-end">
                    <button type="submit" class="btn-submit">Actualizar Usuario</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
