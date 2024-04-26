<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogTemperatura extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'c_log_temperaturas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'mac_sensor',
        'temperatura',
        'dt_leitura',
        'nome_unidade',
        'referencia',
        'etiqueta_ident',
        'detalhe',
        'setpoint',
        'max',
        'min',
        'cad_cliente_id',
    ];

    /**
     * Get the client that owns the temperature log.
     */
    public function cliente()
    {
        return $this->belongsTo(\App\Models\ClienteNovo::class, 'cad_cliente_id');
    }
}
