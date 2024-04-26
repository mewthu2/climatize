<?php

namespace App\Http\Controllers;

use App\Models\ClienteNovo;

class CadClientesController extends Controller
{
    public function index()
    {   
        $clientes = ClienteNovo::all();

        return view('clientes.index', ['clientes' => $clientes]);
    }
}