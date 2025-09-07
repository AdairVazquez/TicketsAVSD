<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class admin_controller extends Controller
{
    //FUNCIONES PARA INTERFACES
    public function dashboard(){
        return view('dashboards.SuperAdmin.dashboardAdmin');
    }

    public function lista_usuarios(){
        return view('dashboards.SuperAdmin.lista_usuarios');
    }

    
    //FUNCIONES PARA INTERFACES
}
