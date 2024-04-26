<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_aparelho',
        'id_alarme',
        'id_responsavel',
        'telefone',
        'status_msg',
        'enviada',
        'tipo_mensagem',
        'texto',
        'conteudo_binario',
        'raw',
        'status',
        'ativo',
    ];

    /**
     * Get the device associated with the message.
     */
    public function equipamento()
    {
        return $this->belongsTo(\App\Models\EquipamentoCliente::class, 'id_aparelho');
    }

    /**
     * Get the alarm associated with the message.
     */
    public function alarme()
    {
        return $this->belongsTo(\App\Models\Alarme::class, 'id_alarme');
    }

    /**
     * Get the responsible associated with the message.
     */
    public function responsavel()
    {
        return $this->belongsTo(\App\Models\User::class, 'id_responsavel');
    }
}
