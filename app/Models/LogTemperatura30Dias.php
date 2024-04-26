<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogTemperatura30Dias extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'c_log_temperatura_30dias';

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
    ];
}
