<?php

namespace App\Http\Controllers;

use App\Models\StatusSensor;
use App\Models\PanelTemperatura;
use App\Models\ClienteNovo;
use Illuminate\Http\Request;

class PanelTemperaturasController extends Controller
{
    private function validate_params(Request $request)
    {
        return $request->validate([
            'id_equipamento' => 'required',
            'mac_sensor' => 'required',
            'nome_unidade' => 'required',
            'referencia' => 'nullable',
            'detalhe' => 'nullable',
            'etiqueta_ident' => 'required',
            'cad_cliente_id' => 'required|exists:cad_clientes,id',
            'setpoint' => 'required|numeric',
            'max' => 'required|numeric',
            'min' => 'required|numeric',
            'atu' => 'nullable',
        ]);
    }

    public function index(Request $request)
    {
        $query = PanelTemperatura::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('mac_sensor', 'like', "%{$search}%")
                ->orWhere('nome_unidade', 'like', "%{$search}%")
                ->orWhere('referencia', 'like', "%{$search}%")
                ->orWhere('etiqueta_ident', 'like', "%{$search}%")
                ->orWhere('detalhe', 'like', "%{$search}%")
                ->orWhere('setpoint', 'like', "%{$search}%")
                ->orWhere('dt_leitura', 'like', "%{$search}%")
                ->orWhere('max', 'like', "%{$search}%")
                ->orWhere('min', 'like', "%{$search}%")
                ->orWhere('atu', 'like', "%{$search}%");
        }

        $panels = $query->get();

        return view('panel_temperaturas.index', ['panels' => $panels]);
    }

    public function create()
    {
        $all_clients = ClienteNovo::all();

        return view('panel_temperaturas.create', ['all_clients' => $all_clients]);
    }

    public function store(Request $request)
    {
        $validatedData = $this->validate_params($request);

        try {
            PanelTemperatura::create($validatedData);
    
            return redirect()->route('painel_temperaturas')
                             ->with('success', 'Paínel de temperatura criado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('painel_temperaturas.create')
                             ->with('error', 'Erro ao criar Paínel de temperatura: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $all_clients = ClienteNovo::all();
        $panel = PanelTemperatura::findOrFail($id);

        $sensors = StatusSensor::all();
        return view('panel_temperaturas.edit', compact('panel', 'all_clients', 'sensors'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $this->validate_params($request);
      
        try {
            $panel = PanelTemperatura::findOrFail($id);
            $panel->update($validatedData);

            return redirect()->route('painel_temperaturas')
                            ->with('success', 'Paínel de temperatura atualizado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('painel_temperaturas.edit', $id)
                            ->with('error', 'Erro ao atualizar o Paínel de temperatura: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $panel = PanelTemperatura::findOrFail($id);
            $panel->delete();

            return redirect()->route('panel_temperaturas')
                            ->with('success', 'Paínel de temperatura excluído com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('panel_temperaturas')
                            ->with('error', 'Erro ao excluir o Paínel de temperatura: ' . $e->getMessage());
        }
    }
}
