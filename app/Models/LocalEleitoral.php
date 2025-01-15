<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LocalEleitoral extends Model
{
    use HasFactory;

    protected $table = 'local_eleitoral';

    protected $fillable = [
        'nome_local',
        'cep',
        'logradouro',
        'numero_logradouro',
        'bairro',
        'municipio',
        'uf',
        'lat',
        'lng'
    ];

    public function secoes(): HasMany
    {
        return $this->hasMany(SecaoEleitoral::class, "local_eleitoral_id", "id");
    }
}
