<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClienteNovo extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cad_clientes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome',
        'cpf',
        'cnpj',
        'inscricao_estadual',
        'tipo',
        'endereco',
        'numero',
        'complemento',
        'bairro',
        'cidade',
        'estado',
        'cep',
        'telefone',
        'celular',
        'email',
        'observacao',
        'descricao',
        'matriz_id',
    ];
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Get the parent cliente for the subsidiary.
     */
    public function parent()
    {
        return $this->belongsTo(\App\Models\Cliente::class, 'matriz_id');
    }

    /**
     * Get the subsidiaries for the cliente.
     */
    public function subsidiaries()
    {
        return $this->hasMany(\App\Models\Cliente::class, 'matriz_id');
    }
}
