<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TelemetriaEquipamento;
use Illuminate\Support\Facades\Validator;

class TelemetriaEquipamentosController extends Controller
{
    public function insert_telemetria(Request $request)
    {
        $data = date("Y-m-d H:i:s");

        $validator = Validator::make($request->all(), [
            'ID_EQUIPAMENTO' => 'required|string|max:255',
            'VERSAO' => 'nullable|string|max:255',
            'REDE' => 'nullable|string|max:255',
            'REGISTRO' => 'required|string|max:255',
            'DADO' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Erro de validação.',
                'errors' => $validator->errors(),
            ], 400);
        }

        $idEquipamento = $request->input('ID_EQUIPAMENTO');
        $versao = $request->input('VERSAO');
        $rede = $request->input('REDE');
        $registro = $request->input('REGISTRO');
        $dado = $request->input('DADO');

        try {
            TelemetriaEquipamento::create([
                'ID_EQUIPAMENTO' => $idEquipamento,
                'VERSAO_FIRMWARE' => $versao,
                'NOME_REDE' => $rede,
                'DT_REGISTRO' => $data,
                'MOTIVO_REGISTRO' => $registro,
                'DADO_REGISTRADO' => $dado,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Dados de telemetria inseridos com sucesso.',
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Erro ao inserir os dados.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
