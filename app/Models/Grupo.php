<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;

    protected $table = 'grupo';

    protected $fillable = [
        'nome',
        'apelido',
        'email',
        'telefone',
        'cep',
        'bairro',
        'rua',
        'numero',
        'municipio',
        'tipo',
        'lider_id',
        'facebook',
        'instagram',
        'foto',
        'zona',
        'secao',
        'lat',
        'lng',
        'nascimento',
        'sexo'
    ];

    public function liderados()
    {
        return $this->hasMany(Grupo::class, 'lider_id');
    }

    public function servicos()
    {
        return $this->hasMany(ServicoGrupo::class, 'grupo_id');
    }
}
