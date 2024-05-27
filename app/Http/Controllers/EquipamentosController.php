<?php

namespace App\Http\Controllers;

use App\Models\Equipamento;
use App\Models\StatusSensor;
use Illuminate\Http\Request;

class EquipamentosController extends Controller
{
    private function validate_params(Request $request)
    {
        return $request->validate([
            'id' => 'required|unique:c_equipamentos,id',
            'nome' => 'required',
            'descricao' => 'required',
            'endereco' => 'required'
        ]);
    }

    public function index()
    {
        $equipments = Equipamento::all();

        return view('equipments.index', ['equipments' => $equipments]);
    }

    public function edit($id)
    {
        $equipment = Equipamento::findOrFail($id);
        return view('equipments.edit', compact('equipment'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $this->validate_params($request);

        try {
            $equipment = Equipamento::findOrFail($id);
            $equipment->update($validatedData);

            return redirect()->route('equipments')
                            ->with('success', 'Equipamento atualizado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('equipments.edit', $id)
                            ->with('error', 'Erro ao atualizar o equipamento: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $equipment = Equipamento::findOrFail($id);
            $equipment->delete();

            return redirect()->route('equipments')
                            ->with('success', 'Equipamento excluído com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('equipments')
                            ->with('error', 'Erro ao excluir o equipamento: ' . $e->getMessage());
        }
    }

    public function create()
    {
        return view('equipments.create');
    }

    public function store(Request $request)
    {
        $validatedData = $this->validate_params($request);

        try {
            Equipamento::create($validatedData);

            return redirect()->route('equipments')
                             ->with('success', 'Equipamento criado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('equipments.create')
                             ->with('error', 'Erro ao criar o equipamento: ' . $e->getMessage());
        }
    }
}
