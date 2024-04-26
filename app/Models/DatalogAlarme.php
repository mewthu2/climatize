<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatalogAlarme extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'datalog_alarmes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_cliente',
        'equipamento',
        'mac_sensor',
        'status_disparo',
        'etiqueta_ident',
        'dt_abertura',
        'dt_update',
        'dt_fechamento',
        'nivel_escalonamento',
    ];

    /**
     * Get the client associated with the alarm.
     *
     * 
     */
    public function cliente()
    {
        return $this->belongsTo(ClienteNovo::class, 'id_cliente');
    }
}
