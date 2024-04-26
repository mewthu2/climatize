<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PanelTemperatura extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'c_panel_temperaturas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'mac_sensor',
        'nome_unidade',
        'referencia',
        'etiqueta_ident',
        'detalhe',
        'cad_cliente_id',
        'setpoint',
        'dt_leitura',
        'max',
        'min',
        'atu',
    ];

    /**
     * Get the client that owns the panel temperature.
     */
    public function cliente()
    {
        return $this->belongsTo(\App\Models\ClienteNovo::class, 'cad_cliente_id');
    }
}
