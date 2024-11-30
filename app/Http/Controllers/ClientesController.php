<?php

namespace App\Http\Controllers;

use App\Models\ClienteNovo;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    private $errorMessages = [
        'nome.required' => 'O campo Nome é obrigatório.',
        'email.required' => 'O campo Email é obrigatório.',
        'email.email' => 'O campo Email deve ser um email válido.',
    ];
    
    private function validate_params(Request $request)
    {
        return $request->validate([
            'nome' => 'required',
            'email' => 'required|email',
        ], $this->errorMessages);
    }    

    public function index(Request $request)
    {
        $query = ClienteNovo::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('nome', 'like', "%{$search}%")
                ->orWhere('cpf', 'like', "%{$search}%")
                ->orWhere('cnpj', 'like', "%{$search}%")
                ->orWhere('inscricao_estadual', 'like', "%{$search}%")
                ->orWhere('tipo', 'like', "%{$search}%")
                ->orWhere('endereco', 'like', "%{$search}%")
                ->orWhere('numero', 'like', "%{$search}%")
                ->orWhere('complemento', 'like', "%{$search}%")
                ->orWhere('bairro', 'like', "%{$search}%")
                ->orWhere('cidade', 'like', "%{$search}%")
                ->orWhere('estado', 'like', "%{$search}%")
                ->orWhere('cep', 'like', "%{$search}%")
                ->orWhere('telefone', 'like', "%{$search}%")
                ->orWhere('celular', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('observacao', 'like', "%{$search}%")
                ->orWhere('descricao', 'like', "%{$search}%");
        }

        $clients = $query->get();

        return view('clients.index', ['clients' => $clients]);
    }

    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $this->validate_params($request);
            ClienteNovo::create($validatedData);

            return redirect()->route('clients')->with('success', 'Cadastro de Cliente criado com sucesso!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao criar o Cadastro do Cliente: ' . $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $client = ClienteNovo::findOrFail($id);
        return view('clients.edit', compact('client'));
    }

    public function update(Request $request, $id)
    {
        try {
            $validatedData = $this->validate_params($request);
            $cliente = ClienteNovo::findOrFail($id);
            $cliente->update($validatedData);

            return redirect()->route('clients')->with('success', 'Cadastro de Cliente atualizado com sucesso!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao atualizar o Cadastro do Cliente: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $cliente = ClienteNovo::findOrFail($id);
            $cliente->delete();

            return redirect()->route('clients')->with('success', 'Cadastro de Cliente excluído com sucesso!');
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao excluir o Cadastro do Cliente: ' . $e->getMessage());
        }
    }
}
