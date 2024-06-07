<?php

namespace App\Http\Controllers;

use App\Models\Freezer;
use App\Models\ClienteNovo;
use Illuminate\Http\Request;

class FreezersController extends Controller
{
    private $errorMessages = [
        'id_equipamento.required' => 'O campo ID do Equipamento é obrigatório.',
        'mac_sensor.required' => 'O campo Mac Sensor é obrigatório.',
        'nome_unidade.required' => 'O campo Nome Unidade é obrigatório.',
        'referencia.required' => 'O campo Referência é obrigatório.',
        'detalhe.required' => 'O campo Detalhe é obrigatório.',
        'setpoint.required' => 'O campo Setpoint é obrigatório.',
        'etiqueta_ident.required' => 'O campo Etiqueta Ident é obrigatório.',
        'limite_neg.required' => 'O campo Limite Neg é obrigatório.',
        'limite_pos.required' => 'O campo Limite Pos é obrigatório.',
        'cad_cliente_id.required' => 'O campo Cliente é obrigatório.',
        'cad_cliente_id.exists' => 'O Cliente selecionado é inválido.',
    ];

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
            'limite_pos' => 'required',
            'cad_cliente_id' => 'required|exists:cad_clientes,id',
        ], $this->errorMessages);
    }

    public function index(Request $request)
    {
        try {
            $query = Freezer::query();

            if ($request->has('search')) {
                $search = $request->input('search');
                $query->where('id_equipamento', 'like', "%{$search}%")
                    ->orWhere('mac_sensor', 'like', "%{$search}%")
                    ->orWhere('nome_unidade', 'like', "%{$search}%")
                    ->orWhere('referencia', 'like', "%{$search}%")
                    ->orWhere('detalhe', 'like', "%{$search}%")
                    ->orWhere('etiqueta_ident', 'like', "%{$search}%");
            }

            $freezers = $query->get();

            return view('freezers.index', ['freezers' => $freezers]);
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao listar os freezers: ' . $e->getMessage());
        }
    }

    public function create()
    {
        try {
            $all_clients = ClienteNovo::all();

            return view('freezers.create', compact('all_clients'));
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao exibir o formulário de criação: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $this->validate_params($request);
            Freezer::create($validatedData);
        
            return redirect()->route('freezers')->with('success', 'Freezer criado com sucesso!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao criar o freezer: ' . $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        try {
            $all_clients = ClienteNovo::all();
            $freezer = Freezer::findOrFail($id);

            return view('freezers.edit', compact('freezer', 'all_clients'));
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao exibir o formulário de edição: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validatedData = $this->validate_params($request);

            $freezer = Freezer::findOrFail($id);
            $freezer->update($validatedData);

            return redirect()->route('freezers')->with('success', 'Freezer atualizado com sucesso!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao atualizar o freezer: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $freezer = Freezer::findOrFail($id);
            $freezer->delete();
            
            return redirect()->route('freezers')->with('success', 'Freezer excluído com sucesso!');
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao excluir o freezer: ' . $e->getMessage());
        }
    }    
}
        