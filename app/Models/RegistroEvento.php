<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroEvento extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 't_registro_eventos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_cliente',
        'id_equipamento',
        'mac_sensor',
        'status_evento',
        'hr_ab',
        'temperatura',
        'hr_fc',
    ];

    /**
     * Get the client associated with the event record.
     */
    public function cliente()
    {
        return $this->belongsTo(ClienteNovo::class, 'id_cliente');
    }
}
