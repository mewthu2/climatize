<?php

namespace App\Http\Controllers;

use App\Models\Contato;

class ContatosController extends Controller
{
    public function index()
    {   
        $contatos = Contato::all();

        return view('contatos.index', ['contatos' => $contatos]);
    }
}