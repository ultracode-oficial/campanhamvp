<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicoGrupo extends Model
{
    use HasFactory;

    protected $table = 'servicos_grupo';

    protected $fillable = [
        'servico',
        'sub_servico',
        'obs',
        'data_solicitacao',
        'data_prazo',
        'data_finalizado',
        'status',
        'indicacao',
        'grupo_id'
    ];

    public function grupo()
    {
        return $this->belongsTo(Grupo::class,'grupo_id');
    }

}
