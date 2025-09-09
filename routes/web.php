<?php

use App\Http\Controllers\admin_controller;
use App\Http\Controllers\ProfileController;
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
Route::get('/SuperAdmin/listaUsuarios', [admin_controller::class, 'lista_usuarios'])->name('admin.listUsu');
Route::post('/SuperAdmin/storeUsuario', [admin_controller::class, 'store'])->name('superadmin.usuarios.store');
Route::get('/SuperAdmin/listaUsuario', [admin_controller::class, 'listaUsuario'])->name('superadmin.usuarios.list');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
