<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ClienteNovo;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    private function validate_params(Request $request)
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'cad_cliente_id' => 'nullable|exists:cad_clientes,id',
        ]);
    }

    public function index(Request $request)
    {
        $users = User::all();
        return view('users.index', ['users' => $users]);
    }

    public function create()
    {
        $clients = ClienteNovo::all();

        return view('users.create', compact('clients'));
    }

    public function store(Request $request)
    {
        $validatedData = $this->validate_params($request);

        try {
            User::create($validatedData);
    
            return redirect()->route('users')
                             ->with('success', 'Usuário criado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('users.create')
                             ->with('error', 'Erro ao criar usuário: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $clients = ClienteNovo::all();
        $user = User::findOrFail($id);

        return view('users.edit', compact('user', 'clients'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $this->validate_params($request);
        dd($request);
        try {
            $user = User::findOrFail($id);
            $user->update($validatedData);

            return redirect()->route('users')
                            ->with('success', 'Usuário atualizado com sucesso!');
        } catch (\Exception $e) {
            dd($e);
            return redirect()->route('users.edit', $id)
                            ->with('error', 'Erro ao atualizar usuário: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return redirect()->route('users')
                            ->with('success', 'Usuário excluído com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('users')
                            ->with('error', 'Erro ao excluir usuário: ' . $e->getMessage());
        }
    }
}
