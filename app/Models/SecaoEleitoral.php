<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Reedware\LaravelCompositeRelations\HasCompositeRelations;

class SecaoEleitoral extends Model
{
    use HasFactory;
    use HasCompositeRelations;

    protected $table = 'secao_eleitoral';

    protected $fillable = [
        'zona',
        'secao',
        'local_eleitoral_id',
        'eleitores_aptos'
    ];

    public function local(): BelongsTo
    {
        return $this->belongsTo(LocalEleitoral::class, "local_eleitoral_id", "id");
    }

    public function grupos()
    {
        return $this->compositeHasMany(Grupo::class, ["zona", "secao"], ["zona", "secao"]);
    }
}
