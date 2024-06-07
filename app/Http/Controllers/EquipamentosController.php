namespace App\Http\Controllers;

use App\Models\Equipamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\ValidationException;

class EquipamentosController extends Controller
{
    private $errorMessages = [
        'id.required' => 'O campo ID é obrigatório.',
        'id.unique' => 'O ID informado já existe.',
        'nome.required' => 'O campo Nome é obrigatório.',
        'descricao.required' => 'O campo Descrição é obrigatório.',
        'endereco.required' => 'O campo Endereço é obrigatório.'
    ];

    private function validate_params(Request $request)
    {
        return $request->validate([
            'id' => 'required|unique:c_equipamentos,id',
            'nome' => 'required',
            'descricao' => 'required',
            'endereco' => 'required'
        ], $this->errorMessages);
    }

    public function index()
    {
        $equipments = Equipamento::all();
        return View::make('equipments.index', compact('equipments'));
    }

    public function create()
    {
        return View::make('equipments.create');
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $this->validate_params($request);
            Equipamento::create($validatedData);

            return redirect()->route('equipments')->with('success', 'Equipamento criado com sucesso!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao criar o equipamento: ' . $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        try {
            $equipment = Equipamento::findOrFail($id);
            return View::make('equipments.edit', compact('equipment'));
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao buscar o equipamento: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validatedData = $this->validate_params($request);

            $equipment = Equipamento::findOrFail($id);
            $equipment->update($validatedData);

            return redirect()->route('equipments')->with('success', 'Equipamento atualizado com sucesso!');
        } catch (ValidationException $e) {
            return back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao atualizar o equipamento: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $equipment = Equipamento::findOrFail($id);
            $equipment->delete();

            return redirect()->route('equipments')->with('success', 'Equipamento excluído com sucesso!');
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao excluir o equipamento: ' . $e->getMessage());
        }
    }
}
