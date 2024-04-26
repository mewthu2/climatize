<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alarme extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cad_alarmes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_cliente',
        'mac_sensor',
        'limite_tempo',
    ];

    /**
     * Get the client associated with the alarm.
     */
    public function cliente()
    {
        return $this->belongsTo(\App\Models\ClienteNovo::class, 'id_cliente');
    }
}
