<?php

namespace App\Http\Controllers;

use App\Models\DatalogSensorSlave;
use App\Models\Degelo;
use App\Models\Freezer;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {   
        $cad_usuario = auth()->user();

        if ($cad_usuario) {
            $freezers = Freezer::where('cad_cliente_id', $cad_usuario->cad_cliente_id)->get();
            foreach ($freezers as $freezer) {
                $statusSensor = $freezer->statusSensor()->first();

                if ($statusSensor) {
                    $sensor = DatalogSensorSlave::where('mac_sensor', $statusSensor->mac_sensor)
                                                ->latest('dt_leitura')
                                                ->first();
                    if ($sensor) {
                        $freezer->atu = $sensor->temperatura;
                        $freezer->dt_leitura = $sensor->dt_leitura;
                        $freezer->estaEmDegelo = Degelo::verificarEtiquetaEmDegelo($freezer->etiqueta_ident);
                    }
                }
            }
        }

        return view('dashboard.index', compact('cad_usuario', 'freezers'));
    }
}
