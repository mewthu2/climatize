<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusSensor extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_equipamento',
        'mac_sensor',
        'status',
        'ip_cliente',
        'offset',
        'cad_cliente_id',
    ];

    /**
     * Get the client associated with the sensor status.
     */
    public function cliente()
    {
        return $this->belongsTo(ClienteNovo::class, 'cad_cliente_id');
    }
}
