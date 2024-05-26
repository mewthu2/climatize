<?php

namespace App\Http\Controllers;

use App\Models\ClienteNovo;
use Illuminate\Http\Request;

class CadClientesController extends Controller
{
    public function index()
    {   
        $clientes = ClienteNovo::all();

        return view('clientes.index', ['clientes' => $clientes]);
    }

    public function create()
    {
        return view('clientes.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
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
        

        try {
            ClienteNovo::create($validatedData);
    
            return redirect()->route('clients')
                             ->with('success', 'Cadastro de Cliente criado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('clients')
                             ->with('error', 'Erro ao criar o Cadastro do Cliente: ' . $e->getMessage());
        }
    }
}