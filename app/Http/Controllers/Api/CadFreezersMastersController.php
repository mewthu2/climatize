<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CadFreezersMaster;

class CadFreezersMastersController extends Controller
{
    /**
     * Lê os dados de temperatura de um freezer com base no MAC_SENSOR e ID_EQUIPAMENTO.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function le_temperatura(Request $request)
    {
        $macSensor = $request->input('MAC_SENSOR');
        $idEquipamento = $request->input('ID_EQUIPAMENTO');

        if (!$macSensor || !$idEquipamento) {
            return response()->json([
                'message' => 'Parâmetros MAC_SENSOR e ID_EQUIPAMENTO são obrigatórios.',
                'status' => 'error',
            ], 400);
        }

        $freezer = CadFreezersMaster::where('mac_sensor', $macSensor)
            ->where('id_equipamento', $idEquipamento)
            ->first();

        if ($freezer) {
            return response()->json([
                'tLiga' => $freezer->tLiga,
                'tDesliga' => $freezer->tDesliga,
                'status' => $freezer->statusEquipamento,
                'acionador' => $freezer->acionador ?? '-',
                'status' => 'success',
            ]);
        }

        return response()->json([
            'tLiga' => '-',
            'tDesliga' => '-',
            'status' => '-',
            'acionador' => '-',
            'message' => 'Equipamento não encontrado.',
            'status' => 'error',
        ], 404);
    }
}
