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
        'id_equipamento',
        'mac_sensor',
        'nome_unidade',
        'referencia',
        'detalhe',
        'setpoint',
        'etiqueta_ident',
        'limite_neg',
        'limite_pos',
        'cad_cliente_id',
        'cad_responsavel_id',
    ];

    /**
     * Get the client associated with the freezer.
     */
    public function cliente()
    {
        return $this->belongsTo(\App\Models\ClienteNovo::class, 'cad_cliente_id');
    }

    /**
     * Get the responsible associated with the freezer.
     */
    public function responsible()
    {
        return $this->belongsTo(\App\Models\User::class, 'cad_responsavel_id');
    }
}
