<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CadFreezersMaster extends Model
{
    use HasFactory;

    /**
     * O nome da tabela associada ao modelo.
     *
     * @var string
     */
    protected $table = 'cad_freezers_masters';

    /**
     * Os atributos que podem ser atribuídos em massa.
     *
     * @var array
     */
    protected $fillable = [
        'id_cliente',
        'id_equipamento',
        'nome_unidade',
        'referencia',
        'detalhe',
        'mac_sensor',
        'tLiga',
        'tDesliga',
        'statusEquipamento',
        'rele',
    ];

    /**
     * Relacionamento com o cliente.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cliente()
    {
        return $this->belongsTo(ClienteOld::class, 'id_cliente', 'id');
    }
}
