<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminUserController;

use App\Http\Controllers\SensorController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
///////////////////////////////////////////////////////////////
//Rutas admin directamente
// Ruta para crear usuarios, acceso limitado a administradores
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/create-user', function () {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            return redirect('/'); // Redirige si no cumple los requisitos
        }
        return app(AdminUserController::class)->create();
    })->name('admin.create-user');

    Route::post('/admin/store-user', function () {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            return redirect('/'); // Redirige si no cumple los requisitos
        }
        return app(AdminUserController::class)->store(request());
    })->name('admin.store-user');
});

// Ruta para listar usuarios, acceso general
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/list-users', function () {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            return redirect('/'); // Redirige si no cumple los requisitos
        }
        return app(AdminUserController::class)->listUsers();
    })->name('admin.list-users');
});

// Ruta para editar usuarios, acceso general
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/edit-user/{id}', function ($id) {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            return redirect('/'); // Redirige si no cumple los requisitos
        }
        return app(AdminUserController::class)->edit($id);
    })->name('admin.edit-user');

    Route::put('/admin/update-user/{id}', function ($id) {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            return redirect('/'); // Redirige si no cumple los requisitos
        }
        return app(AdminUserController::class)->update(request(), $id);
    })->name('admin.update-user');
});

// Ruta para eliminar usuarios
Route::delete('/admin/delete-user/{id}', function ($id) {
    if (!auth()->check() || auth()->user()->role !== 'admin') {
        return redirect('/'); // Redirige si no cumple los requisitos
    }
    return app(AdminUserController::class)->destroy($id);
})->name('admin.delete-user');

// Rutas para sensores
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/sensors', function () {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            return redirect('/'); // Redirige si no cumple los requisitos
        }
        return app(SensorController::class)->index();
    })->name('admin.sensors.index');

    Route::get('/admin/sensors/create', function () {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            return redirect('/'); // Redirige si no cumple los requisitos
        }
        return app(SensorController::class)->create();
    })->name('admin.sensors.create');

    Route::post('/admin/sensors', function () {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            return redirect('/'); // Redirige si no cumple los requisitos
        }
        return app(SensorController::class)->store(request());
    })->name('admin.sensors.store');

    Route::post('/admin/sensors/{id}/toggle', function ($id) {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            return redirect('/'); // Redirige si no cumple los requisitos
        }
        return app(SensorController::class)->toggleVisibility($id);
    })->name('admin.sensors.toggle');

    Route::post('/admin/sensors/{sensor}/remove', function ($sensor) {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            return redirect('/'); // Redirige si no cumple los requisitos
        }
        return app(SensorController::class)->remove($sensor);
    })->name('admin.sensors.remove');
});

// Prefijo para sensores
Route::prefix('admin/sensors')->name('admin.sensors.')->group(function () {
    Route::get('/', function () {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            return redirect('/'); // Redirige si no cumple los requisitos
        }
        return app(SensorController::class)->index();
    })->name('index');

    Route::get('/create', function () {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            return redirect('/'); // Redirige si no cumple los requisitos
        }
        return app(SensorController::class)->create();
    })->name('create');

    Route::post('/store', function () {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            return redirect('/'); // Redirige si no cumple los requisitos
        }
        return app(SensorController::class)->store(request());
    })->name('store');
});

//////////////////////////////////////////////////////////////////////
Route::middleware(['auth'])->group(function () {
    Route::get('/sensors', [SensorController::class, 'list'])->name('sensors.list');
});
Route::get('/sensors/{id}', [SensorController::class, 'show'])->name('sensors.show');

require __DIR__.'/auth.php';
