<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfigFreezer extends Model
{
    use HasFactory;

    protected $fillable = [
        'mac_sensor',
        'temp_refrigerar',
        'temp_aquecimento',
        'set_aquecimento',
        'set_ventilacao',
        'offset_min_max',
        'offset_termometro',
    ];
     /**
     * Get the client that owns the freezer configuration.
     */
    public function cliente()
    {
        return $this->belongsTo(ClienteNovo::class, 'id_cliente');
    }
}
