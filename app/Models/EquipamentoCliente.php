<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipamentoCliente extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cad_equipamentos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_equipamento',
        'cad_cliente_id',
    ];

    /**
     * Get the client associated with the equipment.
     */
    public function cliente()
    {
        return $this->belongsTo(\App\Models\ClienteNovo::class, 'cad_cliente_id');
    }

    /**
     * Get the equipment associated with the client.
     */
    public function equipamento()
    {
        return $this->belongsTo(\App\Models\Equipamento::class, 'id_equipamento', 'id_equipamento');
    }
}
