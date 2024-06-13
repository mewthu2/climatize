<?php

namespace App\Http\Controllers;

use App\Models\DatalogSensorSlave;
use App\Models\Freezer;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function freezer_info(Request $request)
    {
        $cad_usuario = auth()->user();
    
        $cad_freezers = collect();
    
        if ($cad_usuario && $cad_usuario->cad_cliente_id) {
            $cad_freezers = Freezer::where('cad_cliente_id', $cad_usuario->cad_cliente_id)->get();
        }
    
        $id_equipamento_freezer = $request->input('id_equipamento');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        
        if ($request->ajax() && $id_equipamento_freezer) {
            $logs = DatalogSensorSlave::where('id_equipamento', $id_equipamento_freezer)
                ->whereBetween('dt_leitura', [$start_date, $end_date])
                ->get()
                ->groupBy('mac_sensor');
            
            return response()->json($logs);
        } else {
            return view('reports.freezer_info')->with(compact('cad_freezers'));
        }
    }
}
