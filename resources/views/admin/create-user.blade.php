<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Crear Usuario') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="form-container">
            <form method="POST" action="{{ route('admin.store-user') }}">
                @csrf

                <!-- Campo Nombre -->
                <div>
                    <label for="name" class="form-label">Nombre:</label>
                    <input type="text" name="name" id="name" class="form-input" required>
                </div>

                <!-- Campo Email -->
                <div>
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" name="email" id="email" class="form-input" required>
                </div>

                <!-- Campo Contraseña -->
                <div>
                    <label for="password" class="form-label">Contraseña:</label>
                    <input type="password" name="password" id="password" class="form-input" required>
                </div>

                <!-- Campo Rol -->
                <div>
                    <label for="role" class="form-label">Rol:</label>
                    <select name="role" id="role" class="form-input" required>
                        <option value="user">Usuario</option>
                        <option value="admin">Administrador</option>
                    </select>
                </div>

                <!-- Botón de Enviar -->
                <button type="submit" class="btn-submit">Crear Usuario</button>
            </form>
        </div>
    </div>
</x-app-layout>
