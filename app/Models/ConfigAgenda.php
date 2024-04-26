<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfigAgenda extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'config_agendas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_cliente',
        'etiqueta_ident',
        'hora_inicio',
        'hora_fim',
        'dia_semana',
    ];

    /**
     * Get the client that owns the agenda configuration.
     */
    public function cliente()
    {
        return $this->belongsTo(ClienteNovo::class, 'id_cliente');
    }
}