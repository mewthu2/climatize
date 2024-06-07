<?php

namespace App\Http\Controllers;

use App\Models\DatalogSensorSlave;
use App\Models\Degelo;
use App\Models\Freezer;
use App\Models\StatusSensor;

class DashboardController extends Controller
{
    public function index()
    {   
        $cad_usuario = auth()->user();

        $painels = collect();

        if ($cad_usuario && $cad_usuario->cad_cliente_id) {

            // $painels = StatusSensor::where('cad_cliente_id', $cad_usuario->cad_cliente_id)->get();
            $painels = StatusSensor::where('status', 'A')
                                    ->where('cad_cliente_id', $cad_usuario->cad_cliente_id)
                                    ->get();

            foreach ($painels as $painel) {
                $sensor = DatalogSensorSlave::where('mac_sensor', $painel->mac_sensor)
                                            ->latest('dt_leitura');
                $freezer = Freezer::where('id_equipamento', $painel->id_equipamento)->first();

                if ($sensor && $freezer) {
                    $painel->atu = $sensor->value('temperatura');
                    $painel->dt_leitura = $sensor->value('dt_leitura');
                    $painel->etiqueta_ident = $freezer->etiqueta_ident;
                    $painel->min = $freezer->limite_neg;
                    $painel->max = $freezer->limite_pos;
                    $painel->setpoint = $freezer->setpoint;
                    $painel->nome_unidade = $freezer->nome_unidade;
                    $painel->referencia = $freezer->referencia;
                    $painel->detalhe = $freezer->detalhe;
                    $painel->estaEmDegelo = Degelo::verificarEtiquetaEmDegelo($painel->etiqueta_ident);
                }
            }
        }

        return view('dashboard.index', compact('cad_usuario', 'painels'));
    }

}
