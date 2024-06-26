<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Freezer extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cad_freezers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome_unidade',
        'referencia',
        'detalhe',
        'setpoint',
        'etiqueta_ident',
        'limite_neg',
        'limite_pos',
        'cad_cliente_id',
        'status_sensor_id'
    ];

    /**
     * Get the client associated with the freezer.
     */
    public function cliente()
    {
        return $this->belongsTo(\App\Models\ClienteNovo::class, 'cad_cliente_id');
    }

    /**
     * Get the status sensor associated with the freezer.
     */
    public function statusSensor()
    {
        return $this->belongsTo(\App\Models\StatusSensor::class, 'status_sensor_id');
    }
}
