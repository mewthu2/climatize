<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ClienteNovo;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    private $errorMessages = [
        'name.required' => 'O campo Nome é obrigatório.',
        'name.string' => 'O campo Nome deve ser uma string.',
        'name.max' => 'O campo Nome não pode exceder 255 caracteres.',
        'email.required' => 'O campo Email é obrigatório.',
        'email.string' => 'O campo Email deve ser uma string.',
        'email.email' => 'O campo Email deve ser um email válido.',
        'email.max' => 'O campo Email não pode exceder 255 caracteres.',
        'email.unique' => 'O campo Email já está em uso.',
        'password.required' => 'O campo Senha é obrigatório.',
        'password.string' => 'O campo Senha deve ser uma string.',
        'password.min' => 'O campo Senha deve ter pelo menos 8 caracteres.',
        'cad_cliente_id.exists' => 'O Cliente selecionado é inválido.',
    ];

    private function validate_params(Request $request)
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'cad_cliente_id' => 'nullable|exists:cad_clientes,id',
        ], $this->errorMessages);
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
        try {
            $validatedData = $this->validate_params($request);
            
            if (isset($validatedData['password'])) {
                $validatedData['password'] = bcrypt($validatedData['password']);
            }

            User::create($validatedData);

            return redirect()->route('users')->with('success', 'Usuário criado com sucesso!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao criar usuário: ' . $e->getMessage())->withInput();
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
        try {
            $validatedData = $this->validate_params($request);
            $user = User::findOrFail($id);
    
            if (isset($validatedData['password'])) {
                $validatedData['password'] = bcrypt($validatedData['password']);
            }
    
            $user->update($validatedData);
    
            return redirect()->route('users')->with('success', 'Usuário atualizado com sucesso!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao atualizar usuário: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return redirect()->route('users')->with('success', 'Usuário excluído com sucesso!');
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao excluir usuário: ' . $e->getMessage());
        }
    }
}

