<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatalogSensorSlave extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'datalog_sensor_slaves';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_equipamento',
        'mac_sensor',
        'temperatura',
        'dt_leitura',
    ];

    /**
     * Get the master sensor associated with the data log.
     */
    public function masterSensor()
    {
        return $this->belongsTo(\App\Models\DatalogSensorMaster::class, 'mac_sensor', 'mac_sensor');
    }
}
