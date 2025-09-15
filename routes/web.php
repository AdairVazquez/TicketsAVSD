<?php

use App\Http\Controllers\admin_controller;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ticket_controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

Route::get('/SuperAdmin/inicio', [admin_controller::class, 'dashboard'])->name('admin.dash');
//rutas crud usuario
Route::get('/SuperAdmin/obtenerUsuario/{id}', [admin_controller::class, 'obtenerUsuario'])->name('admin.listUsuOne'); //obtener un solo usuario
Route::get('/SuperAdmin/listaUsuarios', [admin_controller::class, 'lista_usuarios'])->name('admin.listUsu'); //vista
Route::post('/SuperAdmin/storeUsuario', [admin_controller::class, 'store'])->name('superadmin.usuarios.store'); //creacion de usuario
Route::post('/SuperAdmin/editUsuario/{id}', [admin_controller::class, 'actualizarUsuario'])->name('superadmin.usuarios.edit');//edicion de usuario
Route::delete('/SuperAdmin/deleteUsuario/{id}', [admin_controller::class, 'eliminarUsuario'])->name('superadmin.usuarios.delete');//eliminacion de usuario
Route::get('/SuperAdmin/listaUsuario', [admin_controller::class, 'listaUsuario'])->name('superadmin.usuarios.list');//select de los usuarios en json
//rutas crud roles
Route::get('/SuperAdmin/listaRoles', [admin_controller::class, 'vista_roles'])->name('admin.listRol'); //vista
Route::get('/SuperAdmin/listaRolesJson', [admin_controller::class, 'lista_roles'])->name('admin.listRolJson'); //lista Json
//rutas tickets
Route::get('/general/listaTickets', [ticket_controller::class, 'todosTickets'])->name('tickets.listTicketsJson'); //lista Json


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
