<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SensorCadastrado extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'c_sensores_cadastrados';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_equipamento',
        'mac_sensor',
        'status',
        'dt_alteracao',
        'ip_cliente',
        'offset',
    ];

    /**
     * Get the equipment associated with the sensor.
     */
    public function equipamento()
    {
        return $this->belongsTo(\App\Models\Equipamento::class, 'id_equipamento', 'id_equipamento');
    }
}
