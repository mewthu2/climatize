<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StatusSensor;
use App\Models\DatalogSensorMaster;
use Carbon\Carbon;
use DB;

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

    public function insert_temp_master(Request $request)
    {
        $idEquipamento = $request->input('ID_EQUIPAMENTO');
        $mac = $request->input('MAC');
        $temperatura = $request->input('TEMPERATURA');
        $temperaturaAlvo = $request->input('TALVO');
        $corrente = $request->input('CORRENTE');
        $statusEquipamento = $request->input('STATUSEQUIPAMENTO');
        $data = Carbon::now();

        $horaLimite = Carbon::now()->subHour();
        $tempoDecorrido = null;

        try {
            $ultimoRegistro = DatalogSensorMaster::where('mac_sensor', $mac)
                ->max('dt_leitura');
            
            if ($ultimoRegistro) {
                $tempoDecorrido = Carbon::parse($ultimoRegistro)->diffInMinutes($data);
            }

            if (!$ultimoRegistro || $tempoDecorrido >= 5) {
                $statusSensor = StatusSensor::where('id_equipamento', $idEquipamento)
                    ->where('mac_sensor', $mac)
                    ->value('status');

                if ($statusSensor === 'A') {
                    DatalogSensorMaster::create([
                        'id_equipamento' => $idEquipamento,
                        'mac_sensor' => $mac,
                        'temperatura' => $temperatura,
                        'temperaturaAlvo' => $temperaturaAlvo,
                        'statusEquipamento' => $statusEquipamento,
                        'corrente' => $corrente,
                        'dt_leitura' => $data,
                    ]);

                    StatusSensor::where('mac_sensor', $mac)
                        ->update(['updated_at' => $data]);
                }

                $sensoresAlerta = StatusSensor::where('updated_at', '<', $horaLimite)
                    ->get();

                foreach ($sensoresAlerta as $sensor) {
                    $this->sendAlertaMessage($sensor->id_equipamento, $sensor->mac_sensor);
                }

                return response()->json(['message' => 'Registro de temperatura inserido com sucesso.'], 201);
            }

            return response()->json(['message' => 'Registro recente. Nenhuma ação necessária.'], 200);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao inserir temperatura.', 'details' => $e->getMessage()], 500);
        }
    }

    private function sendAlertaMessage($idEquipamento, $macSensor)
    {
        $url = "http://vps44863.publiccloud.com.br/mensageria_whatsapp.php";
        $params = [
            'ID_EQUIP' => $idEquipamento,
            'MAC' => $macSensor,
            'TIPO_MSG' => 1,
        ];

        $queryString = http_build_query($params);
        $finalUrl = $url . '?' . $queryString;

        echo "Alerta enviado para URL: $finalUrl\n";
    }

    public function insert_temp(Request $request)
    {
        $temperatura = $request->input('temperatura');
        $sensor = $request->input('sensor');
        $data = Carbon::now()->format('Y/m/d');
        $hora = Carbon::now()->format('H:i:s');

        try {
            DB::table('t_historico')->insert([
                'id_receita' => 1,
                'v_temperatura' => $temperatura,
                'id_etapa' => 1,
                'v_data' => $data,
                'v_hora' => $hora,
                'v_sensor' => $sensor
            ]);

            return response()->json(['message' => 'Temperatura inserida com sucesso.'], 201);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao inserir temperatura.', 'details' => $e->getMessage()], 500);
        }
    }

}
