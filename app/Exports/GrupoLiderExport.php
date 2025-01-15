<?php

namespace App\Exports;

use App\Models\Grupo;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class GrupoLiderExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function collection()
    {
        return Grupo::select("nome", "zona", "secao", "apelido", "nascimento","sexo","email", "telefone", "cep", "bairro", "rua", "numero", "municipio", "tipo", "facebook", "instagram")
                    ->where('lider_id', $this->id)
                    ->get();
    }

    public function headings(): array
    {
        return ["nome", "zona", "secao", "apelido", "nascimento","sexo", "email", "telefone", "cep", "bairro", "rua", "numero", "municipio", "tipo", "facebook", "instagram"];
    }
}
