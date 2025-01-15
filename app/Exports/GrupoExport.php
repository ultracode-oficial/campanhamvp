<?php

namespace App\Exports;

use App\Models\Grupo;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class GrupoExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Grupo::select("nome", "zona", "secao", "apelido", "nascimento","sexo","email", "telefone", "cep", "bairro", "rua", "numero", "municipio", "tipo", "facebook", "instagram")->get();
    }

    public function headings(): array
    {
        return ["nome", "zona", "secao", "apelido", "nascimento","sexo", "email", "telefone", "cep", "bairro", "rua", "numero", "municipio", "tipo", "facebook", "instagram"];
    }
}
