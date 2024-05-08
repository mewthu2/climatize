<?php

namespace App\Http\Controllers;

use App\Models\Freezer;
use Illuminate\Http\Request;

class CadFreezersController extends Controller
{
    public function index()
    {   
        $freezers = Freezer::all();

        return view('freezers.index', ['freezers' => $freezers]);
    }

    public function create()
    {
        return view('freezers.create');
    }

    public function store(Request $request)
    {
        // Validação dos dados
        $validatedData = $request->validate([
            'id_equipamento' => 'required',
            'mac_sensor' => 'required',
            'nome_unidade' => 'required',
            'referencia' => 'required',
            'detalhe' => 'required',
            'setpoint' => 'required',
            'etiqueta_ident' => 'required',
            'limite_neg' => 'required',
            'limite_pos' => 'required',
            'cad_cliente_id' => 'required',
            'cad_responsavel_id' => 'required',
        ]);

        // Criação do freezer
        Freezer::create($validatedData);

        // Redirecionamento após a criação
        return redirect()->route('freezers.index')
                         ->with('success', 'Freezer criado com sucesso!');
    }
}
