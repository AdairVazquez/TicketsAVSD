<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class admin_controller extends Controller
{
    //FUNCIONES PARA INTERFACES
    public function dashboard()
    {
        return view('dashboards.SuperAdmin.dashboardAdmin');
    }

    public function lista_usuarios()
    {
        return view('dashboards.SuperAdmin.lista_usuarios');
    }

    //FUNCIONES PARA INTERFACES



    //FUNCIONES CRUD
    public function store(Request $request)
    {
        //validar datos
        $validated = $request->validate([
            'nombre'   => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'pass'     => 'required|string|min:6|confirmed', // confirmed espera "pass_confirmation" (confirmacion de la contraseña)
            'rol'      => 'required|string',
        ]);

        // Crear usuario
        $user = User::create([
            'name'     => $validated['nombre'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['pass']),
            'rol_id'     => $validated['rol'],
        ]);

        //Respuesta JSON
        return response()->json([
            'status'  => 'success',
            'message' => 'Usuario creado correctamente',
            'user'    => $user,
        ]);
    }

    public function listaUsuario()
    {
        $usuarios = User::all();

        $json = $usuarios->map(function ($usuario) {
            
            $nombreRol = match ($usuario->rol_id) {
                1 => 'Super Usuario',
                2 => 'Soporte técnico',
                3 => 'Cliente',
                default => 'Desconocido',
            };

            return [
                'id' => $usuario->id,
                'nombre' => $usuario->name,
                'email' => $usuario->email,
                'rol' => $nombreRol,
            ];
        });

        return response()->json($json);
    }

    //FUNCIONES CRUD
}
