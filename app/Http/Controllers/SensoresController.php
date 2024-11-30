<?php

namespace App\Http\Controllers;

use App\Models\StatusSensor;
use App\Models\ClienteNovo;
use Illuminate\Http\Request;

class SensoresController extends Controller
{
    private $errorMessages = [
        'id_equipamento.required' => 'O campo ID do Equipamento é obrigatório.',
        'status.required' => 'O campo Status é obrigatório.',
        'cad_cliente_id.exists' => 'O Cliente selecionado é inválido.',
    ];

    private function validate_params(Request $request)
    {
        return $request->validate([
            'id_equipamento' => 'required',
            'status' => 'required',
            'cad_cliente_id' => 'nullable|exists:cad_clientes,id'
        ], $this->errorMessages);
    }

    public function index(Request $request)
    {
        $query = StatusSensor::query();

        if (auth()->check() && auth()->user()->email === 'rodrigo@4climatize.com.br') {
            $query->where('cad_cliente_id', '3');
        } else {
            if ($request->has('search')) {
                $search = $request->input('search');
                $query->where('id', 'like', "%{$search}%")
                    ->orWhere('id_equipamento', 'like', "%{$search}%")
                    ->orWhere('mac_sensor', 'like', "%{$search}%")
                    ->orWhere('status', 'like', "%{$search}%")
                    ->orWhere('ip_cliente', 'like', "%{$search}%")
                    ->orWhere('offset', 'like', "%{$search}%");
            }
        }

        $sensors = $query->get();

        return view('sensors.index', ['sensors' => $sensors]);
    }

    public function create()
    {
        $clients = ClienteNovo::all();
        return view('sensors.create', compact('clients'));
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $this->validate_params($request);
            StatusSensor::create($validatedData);

            return redirect()->route('sensors')->with('success', 'Sensor criado com sucesso!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao criar o sensor: ' . $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $clients = ClienteNovo::all();
        $sensor = StatusSensor::findOrFail($id);
        return view('sensors.edit', compact('sensor', 'clients'));
    }

    public function update(Request $request, $id)
    {
        try {
            $validatedData = $this->validate_params($request);
            $sensor = StatusSensor::findOrFail($id);
            $sensor->update($validatedData);
            return redirect()->route('sensors')->with('success', 'Sensor atualizado com sucesso!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao atualizar o sensor: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $sensor = StatusSensor::findOrFail($id);
            $sensor->delete();

            return redirect()->route('sensors')->with('success', 'Sensor excluído com sucesso!');
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao excluir o sensor: ' . $e->getMessage());
        }
    }
}
