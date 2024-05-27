<?php

namespace App\Http\Controllers;

use App\Models\Freezer;
use Illuminate\Http\Request;

class FreezersController extends Controller
{
    private function validate_params(Request $request)
    {
        return $request->validate([
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
    }

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
        $validatedData = $this->validate_params($request);

        try {
            Freezer::create($validatedData);
    
            return redirect()->route('freezers')
                             ->with('success', 'Freezer criado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('freezers')
                             ->with('error', 'Erro ao criar o freezer: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $freezer = Freezer::findOrFail($id);
        return view('freezers.edit', compact('freezer'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $this->validate_params($request);

        try {
            $freezer = Freezer::findOrFail($id);
            $freezer->update($validatedData);

            return redirect()->route('freezers')
                            ->with('success', 'Freezer atualizado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('freezers.edit', $id)
                            ->with('error', 'Erro ao atualizar o freezer: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $freezer = Freezer::findOrFail($id);
            $freezer->delete();

            return redirect()->route('freezers')
                            ->with('success', 'Freezer excluído com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('freezers')
                            ->with('error', 'Erro ao excluir o freezer: ' . $e->getMessage());
        }
    }
}
