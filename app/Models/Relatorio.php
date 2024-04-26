<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relatorio extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome',
        'data_inicio',
        'data_fim',
        'id_equipamento',
        'etiqueta_ident',
    ];

    /**
     * Get the equipment associated with the report.
     */
    public function equipamento()
    {
        return $this->belongsTo(Equipamento::class, 'id_equipamento', 'id_equipamento');
    }
}
