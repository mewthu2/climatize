<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StatusSensor;
use App\Models\DatalogSensorSlave;
use App\Models\Sensor;
use Carbon\Carbon;

class StatusSensorController extends Controller
{
    public function t_sensor_insere(Request $request)
    {
        $idEquipamento = $request->input('ID_EQUIPAMENTO');
        $mac = $request->input('MAC');
        $ipCliente = $request->ip();
        $data = Carbon::now();

        try {
            $status = StatusSensor::where('mac_sensor', $mac)->value('status');

            if (!$status) {
                StatusSensor::create([
                    'id_equipamento' => $idEquipamento,
                    'mac_sensor' => $mac,
                    'status' => 'C',
                    'ip_cliente' => $ipCliente,
                    'created_at' => $data,
                    'updated_at' => $data,
                ]);

                DatalogSensorSlave::create([
                    'id_equipamento' => $idEquipamento,
                    'mac_sensor' => $mac,
                    'temperatura' => null,
                    'dt_leitura' => $data,
                ]);

                return response()->json(['message' => 'Sensor cadastrado com status C.'], 201);
            }

            if (in_array($status, ['A', 'I'])) {
                Sensor::where('mac_sensor', $mac)->delete();
            }

            if ($status === 'C') {
                Sensor::create([
                    'id_equipamento' => $idEquipamento,
                    'mac_sensor' => $mac,
                    'dt_cadastr' => $data,
                    'ip_cliente' => $ipCliente,
                    'updated_at' => $data,
                ]);
            }

            return response()->json(['message' => 'Processamento concluído com sucesso.', 'status' => $status], 200);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao processar a solicitação.', 'details' => $e->getMessage()], 500);
        }
    }
}
