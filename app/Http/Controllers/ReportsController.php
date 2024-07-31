<?php

namespace App\Http\Controllers;

use App\Models\DatalogSensorSlave;
use App\Models\Freezer;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportsController extends Controller
{
    public function daily_freezer_info(Request $request)
    {
        $user = auth()->user();
        $cad_freezers = collect();

        if ($user && $user->cad_cliente_id) {
            $cad_freezers = Freezer::where('cad_cliente_id', $user->cad_cliente_id)->get();
        }

        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        if ($request->ajax()) {

            $freezer = Freezer::find($request->input('id_freezer'));
            $sensor = $freezer->statusSensor()->first();

            if ($sensor) {
                $logs = DatalogSensorSlave::where('mac_sensor', $sensor->mac_sensor)
                    ->whereBetween('dt_leitura', [$start_date, $end_date])
                    ->get()
                    ->groupBy('mac_sensor');

                return response()->json([
                    'logs' => $logs,
                    'freezer' => $freezer
                ]);
            } else {
                return response()->json('Sensor não encontrado');
            }
            
        } else {
            return view('reports.daily_freezer_info')->with(compact('cad_freezers'));
        }
    }
}

