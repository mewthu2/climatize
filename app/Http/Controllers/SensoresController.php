<?php

namespace App\Http\Controllers;

use App\Models\StatusSensor;
use Illuminate\Http\Request;

class SensoresController extends Controller
{
    private function validate_params(Request $request)
    {
        return $request->validate([
            'id_equipamento' => 'required',
            'mac_sensor' => 'required',
            'status' => 'required',
            'ip_cliente' => 'required'
        ]);
    }

    public function index()
    {
        $sensors = StatusSensor::all();

        return view('sensors.index', ['sensors' => $sensors]);
    }

    public function edit($id)
    {
        $sensor = StatusSensor::findOrFail($id);
        return view('sensors.edit', compact('sensor'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $this->validate_params($request);
    
        try {
            $sensor = StatusSensor::findOrFail($id);
            $sensor->update($validatedData);
    
            return redirect()->route('sensors')
                            ->with('success', 'Sensor atualizado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('sensors.edit', $id)
                            ->with('error', 'Erro ao atualizar o sensor: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $sensor = StatusSensor::findOrFail($id);
            $sensor->delete();

            return redirect()->route('sensors')
                            ->with('success', 'Sensor excluído com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('sensors')
                            ->with('error', 'Erro ao excluir o sensor: ' . $e->getMessage());
        }
    }

    public function create()
    {
        return view('sensors.create');
    }

    public function store(Request $request)
    {
        $validatedData = $this->validate_params($request);

        try {
            StatusSensor::create($validatedData);

            return redirect()->route('sensors')
                            ->with('success', 'Sensor criado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('sensors.create')
                            ->with('error', 'Erro ao criar o sensor: ' . $e->getMessage());
        }
    }
}
