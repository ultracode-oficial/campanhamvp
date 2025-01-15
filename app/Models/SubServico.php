<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubServico extends Model
{
    use HasFactory;

    protected $table = 'sub_servicos';

    protected $fillable = [
        'nome',
        'servico_id'
    ];

    // fazer o relacionamento
}
