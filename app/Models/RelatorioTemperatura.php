<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelatorioTemperatura extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'c_relatorio_temperaturas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_equipamento',
        'mac_sensor',
        'etiqueta_ident',
        'nome_unidade',
        'referencia',
        'detalhe',
        'cad_cliente_id',
        'setpoint',
        'limite_neg',
        'limite_pos',
        'dt_leitura',
        'temperatura',
    ];

    /**
     * Get the client that owns the temperature report.
     */
    public function cliente()
    {
        return $this->belongsTo(\App\Models\ClienteNovo::class, 'cad_cliente_id');
    }

    /**
     * Get the equipment that owns the temperature report.
     */
    public function equipamento()
    {
        return $this->belongsTo(\App\Models\Equipamento::class, 'id_equipamento', 'id_equipamento');
    }
}
