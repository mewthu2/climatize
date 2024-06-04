<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Degelo;
use App\Models\PanelTemperatura;

class DashboardController extends Controller
{
    public function index()
    {   
        $cad_usuario = auth()->user();

        $employees = collect();

        if ($cad_usuario && $cad_usuario->cad_cliente_id) {

            $employees = PanelTemperatura::where('cad_cliente_id', $cad_usuario->cad_cliente_id)->get();

            foreach ($employees as $employee) {
                $employee->estaEmDegelo = Degelo::verificarEtiquetaEmDegelo($employee->etiqueta_ident);
            }
        }

        return view('dashboard.index', compact('cad_usuario', 'employees'));
    }

}
