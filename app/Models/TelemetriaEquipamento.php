<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelemetriaEquipamento extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_equipamento',
        'versao_firmware',
        'nome_rede',
        'dt_registro',
        'motivo_registro',
        'dado_registrado',
    ];

    /**
     * Get the equipment associated with the telemetry.
     */
    public function equipmento()
    {
        return $this->belongsTo(Equipamento::class, 'id_equipamento', 'id_equipamento');
    }
}
