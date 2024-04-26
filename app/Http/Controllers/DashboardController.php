<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Degelo;
use App\Models\PanelTemperatura;

class DashboardController extends Controller
{
    public function index()
        {   
            $cad_usuario = Usuario::where('login', auth()->user()->email)->first();
            $employees = PanelTemperatura::where('cad_cliente_id', $cad_usuario->cad_cliente_id)->get();

            foreach ($employees as $employee) {
                $employee->estaEmDegelo = Degelo::verificarEtiquetaEmDegelo($employee->etiqueta_ident);
            }

            return view('dashboard/index')
            ->with(compact('cad_usuario', 'employees'));
        }

}
