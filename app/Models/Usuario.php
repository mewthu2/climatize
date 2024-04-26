<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cad_usuarios';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome',
        'login',
        'cad_cliente_id',
        'cad_grupo_id',
    ];

    /**
     * Get the client associated with the user.
     */
    public function cliente()
    {
        return $this->belongsTo(\App\Models\ClienteNovo::class, 'cad_cliente_id');
    }

    /**
     * Get the group associated with the user.
     */
    public function grupo()
    {
        return $this->belongsTo(\App\Models\Grupo::class, 'cad_grupo_id');
    }
}
