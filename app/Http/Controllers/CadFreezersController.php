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
        $validatedData = $request->validate([
            'id_equipamento' => 'required',
            'mac_sensor' => 'required',
            'nome_unidade' => 'required',
            'referencia' => 'required',
            'detalhe' => 'required',
            'setpoint' => 'required',
            'etiqueta_ident' => 'required',
            'limite_neg' => 'required',
            'limite_pos' => 'required'
        ]);

        try {
            Freezer::create($validatedData);
    
            return redirect()->route('freezers')
                             ->with('success', 'Freezer criado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('freezers')
                             ->with('error', 'Erro ao criar o freezer: ' . $e->getMessage());
        }
    }
}
