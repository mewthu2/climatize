<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contato extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cad_contatos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome',
        'telefone',
        'email',
        'nivel_escalonamento',
        'endereco',
        'bairro',
        'cidade',
        'estado',
        'cad_cliente_id',
        'cad_usuario_id',
    ];

    /**
     * Get the client associated with the contact.
     */
    public function cliente()
    {
        return $this->belongsTo(ClienteNovo::class, 'cad_cliente_id');
    }

    /**
     * Get the user associated with the contact.
     */
    public function usuario()
    {
        return $this->belongsTo(User::class, 'cad_usuario_id');
    }
}
