<?php

namespace App\Http\Controllers;

use App\Models\ClienteNovo;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    private function validate_params(Request $request)
    {
        return $request->validate([
            'nome' => 'required',
            'cpf' => 'required',
            'cnpj' => 'required',
            'inscricao_estadual' => 'required',
            'tipo' => 'required',
            'endereco' => 'required',
            'numero' => 'required',
            'complemento' => 'required',
            'bairro' => 'required',
            'cidade' => 'required',
            'estado' => 'required',
            'cep' => 'required',
            'telefone' => 'required',
            'celular' => 'required',
            'email' => 'required|email',
            'observacao' => 'required',
            'descricao' => 'required',
            'matriz_id' => 'required',
        ]);
    }

    public function index()
    {   
        $clientes = ClienteNovo::all();

        return view('clients.index', ['clientes' => $clientes]);
    }

    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {
        $validatedData = $this->validate_params($request);

        try {
            ClienteNovo::create($validatedData);
    
            return redirect()->route('clients')
                             ->with('success', 'Cadastro de Cliente criado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('clients')
                             ->with('error', 'Erro ao criar o Cadastro do Cliente: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $client = ClienteNovo::findOrFail($id);
        return view('clients.edit', compact('client'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $this->validate_params($request);

        try {
            $cliente = ClienteNovo::findOrFail($id);
            $cliente->update($validatedData);

            return redirect()->route('clients')
                            ->with('success', 'Cadastro de Cliente atualizado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('clients.edit', $id)
                            ->with('error', 'Erro ao atualizar o Cadastro do Cliente: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $cliente = ClienteNovo::findOrFail($id);
            $cliente->delete();

            return redirect()->route('clients')
                            ->with('success', 'Cadastro de Cliente excluído com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('clients')
                            ->with('error', 'Erro ao excluir o Cadastro do Cliente: ' . $e->getMessage());
        }
    }
}
