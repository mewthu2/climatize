<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cad_sensors';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_equipamento',
        'mac_sensor',
        'dt_cadstr',
        'ip_cliente',
    ];

    /**
     * Get the equipment associated with the sensor.
     */
    public function equipamento()
    {
        return $this->belongsTo(\App\Models\Equipamento::class, 'id_equipamento', 'id_equipamento');
    }
}
