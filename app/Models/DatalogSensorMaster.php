<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatalogSensorMaster extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'datalog_sensor_masters';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_cliente',
        'id_equipamento',
        'mac_sensor',
        'temperatura',
        'temperaturaAlvo',
        'statusEquipamento',
        'corrente',
        'dt_leitura',
    ];

    /**
     * Get the client associated with the data log.
     */
    public function cliente()
    {
        return $this->belongsTo(\App\Models\ClienteNovo::class, 'id_cliente');
    }
}
