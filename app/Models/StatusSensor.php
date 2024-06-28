<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Freezer extends Model
{
    use HasFactory;

    protected $fillable = [
        'cad_cliente_id',
        'status_sensor_id',
        'nome_unidade',
        'referencia',
        'detalhe',
        'etiqueta_ident',
        'setpoint',
        'limite_neg',
        'limite_pos',
    ];

    /**
     * Get the sensor status associated with the freezer.
     */
    public function statusSensor()
    {
        return $this->belongsTo(StatusSensor::class, 'status_sensor_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($freezer) {
            $freezer->updateSensorStatus();
        });

        static::updated(function ($freezer) {
            $freezer->updateSensorStatus();
        });

        static::deleted(function ($freezer) {
            $freezer->resetSensorStatus();
        });
    }

    public function updateSensorStatus()
    {
        if ($this->status_sensor_id) {
            $sensor = $this->statusSensor;
            $sensor->status = 'A';
            $sensor->save();
        }
    }

    public function resetSensorStatus()
    {
        if ($this->status_sensor_id) {
            $sensor = $this->statusSensor;
            $sensor->status = 'C';
            $sensor->save();
        }
    }
}
