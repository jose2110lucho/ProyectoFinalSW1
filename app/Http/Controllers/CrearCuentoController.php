<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CrearCuentoController extends Controller
{
    public function crearCuento(){
        return view('crearCuento');
    }
}
