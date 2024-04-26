<?php

namespace App\Http\Controllers;

use App\Models\Log6temperatura;
use App\Models\Log12temperatura;
use App\Models\Log24temperatura;
use App\Models\Freezer;
use App\Models\Usuario;

class ReportsController extends Controller
{
    public function freezer_info() {
        $cad_usuario = Usuario::where('login', auth()->user()->email)->first();
        $cad_freezers = Freezer::where('cad_cliente_id', $cad_usuario->cad_cliente_id)->get();
    
        $etiqueta_ident_freezer = request()->input('etiqueta_ident_freezer');
        $intervalo = request()->input('intervalo');
    
        if (request()->ajax() && $intervalo && $etiqueta_ident_freezer) {
            switch ($intervalo) {
                case 6:
                    $logs = Log6temperatura::where('etiqueta_ident', $etiqueta_ident_freezer)
                                            ->where('cad_cliente_id', $cad_usuario->cad_cliente_id)
                                            ->get();
                    break;
                case 12:
                    $logs = Log12temperatura::where('etiqueta_ident', $etiqueta_ident_freezer)
                                            ->where('cad_cliente_id', $cad_usuario->cad_cliente_id)
                                            ->get();
                    break;
                case 24:
                    $logs = Log24temperatura::where('etiqueta_ident', $etiqueta_ident_freezer)
                                            ->where('cad_cliente_id', $cad_usuario->cad_cliente_id)
                                            ->get();
                    break;
                default:
                    $logs = [];
                    break;
            }
            
            return response()->json($logs);
        } else {
            return view('reports/freezer_info')->with(compact('cad_freezers'));
        }
    }
    
}

