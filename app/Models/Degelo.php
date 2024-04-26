<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Degelo extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'c_degelos';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

     // Método para verificar se está entre data_hora_inicio e data_hora_fim
     public static function verificarEtiquetaEmDegelo($etiquetaIdent)
    {
        $agora = Carbon::now();

        // Verifica se há algum degelo agendado com a etiqueta_ident fornecida e se o momento atual está entre as datas de início e fim
        return self::where('etiqueta_ident', $etiquetaIdent)
                   ->where('data_hora_inicio', '<=', $agora)
                   ->where('data_hora_fim', '>=', $agora)
                   ->exists();
    }
}
