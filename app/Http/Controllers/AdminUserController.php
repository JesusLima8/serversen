<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Importa el modelo User
class AdminUserController extends Controller
{
    public function listUsers()
    {
        $users = User::all(); // Obtiene todos los usuarios de la base de datos
        return view('admin.list-users', compact('users')); // Pasa los datos a la vista
    }
    ////////////////////////////////////////////////////////////
    public function edit($id)
{
    $user = User::findOrFail($id); // Busca el usuario por su ID
    return view('admin.edit-user', compact('user')); // Pasa el usuario a la vista
}

public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $id, // Ignora el correo actual del usuario
        'password' => 'nullable|string|min:8', // Contraseña opcional
        'role' => 'required|in:user,admin',
    ]);

    $user = User::findOrFail($id);
    $user->name = $request->name;
    $user->email = $request->email;
    if ($request->password) {
        $user->password = bcrypt($request->password);
    }
    $user->role = $request->role;
    $user->save();

    return redirect()->route('admin.list-users')->with('success', 'Usuario actualizado exitosamente.');
}////////////////////////////////////////////////////////
public function destroy($id)
{
    $user = User::findOrFail($id);
    $user->delete();

    return redirect()->route('admin.list-users')->with('success', 'Usuario eliminado exitosamente.');
}
///////////////////////////////////////////////////////
    // Muestra el formulario de creación de usuarios
    public function create()
    {
        return view('admin.create-user');
    }

    // Maneja el envío del formulario y guarda el usuario
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:user,admin',
        ]);

        \App\Models\User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.create-user')->with('success', 'Usuario creado exitosamente.');
    }
    
}
