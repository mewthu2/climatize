<?php

namespace App\Http\Controllers;

use App\Models\Log6Temperatura;
use App\Models\Log12Temperatura;
use App\Models\Log24Temperatura;
use App\Models\Freezer;
use App\Models\Usuario;

class ReportsController extends Controller
{
    public function freezer_info()
    {
        $cad_usuario = auth()->user();
    
        $cad_freezers = collect();
    
        if ($cad_usuario && $cad_usuario->cad_cliente_id) {
            $cad_freezers = Freezer::where('cad_cliente_id', $cad_usuario->cad_cliente_id)->get();
        }
    
        $etiqueta_ident_freezer = request()->input('etiqueta_ident_freezer');
        $intervalo = request()->input('intervalo');
    
        if (request()->ajax() && $intervalo && $etiqueta_ident_freezer) {
            $logs = collect();
    
            return response()->json($logs);
        } else {
            return view('reports.freezer_info')->with(compact('cad_freezers'));
        }
    }    
    
}

