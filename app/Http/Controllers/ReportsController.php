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
    
            switch ($intervalo) {
                case 6:
                    $logs = Log6Temperatura::where('etiqueta_ident', $etiqueta_ident_freezer)
                        ->where('cad_cliente_id', $cad_usuario->cad_cliente_id ?? null)
                        ->get();
                    break;
                case 12:
                    $logs = Log12Temperatura::where('etiqueta_ident', $etiqueta_ident_freezer)
                        ->where('cad_cliente_id', $cad_usuario->cad_cliente_id ?? null)
                        ->get();
                    break;
                case 24:
                    $logs = Log24Temperatura::where('etiqueta_ident', $etiqueta_ident_freezer)
                        ->where('cad_cliente_id', $cad_usuario->cad_cliente_id ?? null)
                        ->get();
                    break;
                default:
                    $logs = collect();
                    break;
            }
    
            return response()->json($logs);
        } else {
            return view('reports.freezer_info')->with(compact('cad_freezers'));
        }
    }    
    
}

