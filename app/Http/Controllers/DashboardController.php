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
            $painels = StatusSensor::all();

            foreach ($painels as $painel) {
                # colocar depois para mostrar somente os status sensor ativos
                $sensor = DatalogSensorSlave::where('mac_sensor', $painel->mac_sensor)
                                            ->latest('dt_leitura');
                $freezer = Freezer::where('id_equipamento', $painel->id_equipamento)->first();
                $painel->atu = $sensor->value('temperatura');
                $painel->dt_leitura = $sensor->value('dt_leitura');
                $painel->etiqueta_ident = $freezer->value('etiqueta_ident');
                $painel->min = $freezer->value('limite_neg');
                $painel->max = $freezer->value('limite_pos');
                $painel->setpoint = $freezer->value('setpoint');
                $painel->nome_unidade = $freezer->value('nome_unidade');
                $painel->referencia = $freezer->value('referencia');
                $painel->detalhe = $freezer->value('detalhe');
                $painel->estaEmDegelo = Degelo::verificarEtiquetaEmDegelo($painel->etiqueta_ident);
            }
        }

        return view('dashboard.index', compact('cad_usuario', 'painels'));
    }

}
