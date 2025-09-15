<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;

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

    public function vista_roles(){
        return view('dashboards.SuperAdmin.lista_roles');
    }

    //FUNCIONES PARA INTERFACES

    //FUNCIONES CRUD USUARIOS
    //crear usuario
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
    //READ
    public function listaUsuario()
    {
        // Trae 10 usuarios por página
        $usuarios = User::paginate(10);

        $json = $usuarios->map(function ($usuario) {

            $nombreRol = match ($usuario->rol_id) {
                1 => 'Super Administrador',
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

        // Devuelve datos junto con la info de paginación
        return response()->json([
            'data' => $json,
            'current_page' => $usuarios->currentPage(),
            'last_page' => $usuarios->lastPage(),
            'per_page' => $usuarios->perPage(),
            'total' => $usuarios->total(),
        ]);
    }
    public function obtenerUsuario($id)
    {
        $usuario = User::find($id);
        $json = [
            'id'     => $usuario->id,
            'nombre' => $usuario->name,
            'email'  => $usuario->email,
            'rol'    => $usuario->rol_id,
        ];
        return response()->json($json);
    }
    //UPDATE
    public function actualizarUsuario(Request $request, $id)
    {
        // Buscar usuario
        $user = User::findOrFail($id);

        // Validar datos
        $rules = [
            'nombre' => 'required|string|max:255',
            'email'  => 'required|email|unique:users,email,' . $id,
            'rol'    => 'required|string',
        ];

        // Validar contraseña solo si se envía
        if ($request->filled('pass')) {
            $rules['pass'] = 'string|min:6|confirmed'; // espera pass_confirmation
        }

        $validated = $request->validate($rules);

        // Actualizar campos
        $user->name = $validated['nombre'];
        $user->email = $validated['email'];
        $user->rol_id = $validated['rol'];

        // Solo actualizar contraseña si se envió
        if (!empty($validated['pass'])) {
            $user->password = Hash::make($validated['pass']);
        }

        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Usuario actualizado correctamente',
            'user' => $user
        ]);
    }
    //DELETE
    public function eliminarUsuario($id){
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Usuario actualizado correctamente',
            'user' => $user
        ]);
    }
    //FUNCIONES CRUD USUARIOS

    //FUNCIONES CRUD ROL
    //Listar roles existentes
    public function lista_roles(){
       // Trae 10 roles por página
        $roles = Rol::paginate(10);

        $json = $roles->map(function ($rol) {
            return [
                'id' => $rol->id,
                'nombre_rol' => $rol->nombre_rol,
            ];
        });

        // Devuelve datos junto con la info de paginación
        return response()->json([
            'data' => $json,
            'current_page' => $roles->currentPage(),
            'last_page' => $roles->lastPage(),
            'per_page' => $roles->perPage(),
            'total' => $roles->total(),
        ]);
    }
    //FUNCIONES CRUD ROL


}
