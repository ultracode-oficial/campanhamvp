<?php

namespace App\Imports;

use App\Models\Grupo;
use App\Models\SecaoEleitoral;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;


class GrupoImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        DB::beginTransaction();
        try {
            foreach($rows as $row) {                
                try {
                    $latitude = $longitude = null;

                    $pessoa = new Grupo;
                    $pessoa->nome           = $row["nome"];
                    $pessoa->apelido        = $row["apelido"];
                    $pessoa->email          = $row["email"];
                    $pessoa->cep            = $row["cep"];
                    $pessoa->rua            = $row["rua"];
                    $pessoa->municipio      = $row["municipio"];
                    $pessoa->bairro         = $row["bairro"];
                    $pessoa->numero         = $row["numero"];
                    $pessoa->facebook       = $row["facebook"];
                    $pessoa->instagram      = $row["instagram"];
                    $pessoa->tipo           = $row["tipo"];
                    $pessoa->lider_id       = $row["lider_id"];
                    $pessoa->sexo           = $row["sexo"];

                     // Get Latitude Longitude
                     if ($row["cep"] AND $row["rua"] AND $row["municipio"] AND $row["bairro"] AND $row["numero"]) {
                        $address = $row["cep"].','.$row["rua"].','.$row["municipio"].','.$row["bairro"].','.$row["numero"];
        
                        $apiKey = 'AIzaSyDKXO_82UDrqpwwfR16HC7fnpFOHTmLyYs';
        
                        $response = Http::get('https://maps.googleapis.com/maps/api/geocode/json', [
                            'address' => $address,
                            'key' => $apiKey,
                        ]);
        
                        if ($response->successful()) {
                            $data = $response->json();
        
                            if(isset($data['results']) && count($data['results']) > 0) {
                                $firstResult = $data['results'][0];
        
                                if(isset($firstResult['geometry']['location'])) {
                                    $location = $firstResult['geometry']['location'];
                                    $latitude = $location['lat'];
                                    $longitude = $location['lng'];

                                    $pessoa->lat           = $latitude;
                                    $pessoa->lng           = $longitude;
                                }
                            }
                        }
                    }

                    if ($row["zona"] OR $row["secao"]) {
                        $zona = $row["zona"] ? str_pad($row["zona"], 4, "0", STR_PAD_LEFT) : "0000";
                        $secao = $row["secao"] ? str_pad($row["secao"], 4, "0", STR_PAD_LEFT) : "0000";
                
                        $existingSecao = SecaoEleitoral::where(["zona" => $zona, "secao" => $secao])->first();
                
                        if ($existingSecao === null) {
                            $newSecao = new SecaoEleitoral;
                            $newSecao->zona = $zona;
                            $newSecao->secao = $secao;
                            $newSecao->save();
                        }

                        $pessoa->zona = $zona;
                        $pessoa->secao = $secao;

                    } else {
                        $pessoa->zona = null;
                        $pessoa->secao = null;
                    }

                    $telefone = $row["telefone"];
                    $telefoneFormatado = preg_replace('/[^\d]/', '', $telefone);
                    $pessoa->telefone = $telefoneFormatado;

                        $nascimento = $row["nascimento"];
                        

                        $nascimentoFormatado = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($nascimento));
                        $pessoa->nascimento = $nascimentoFormatado;
                    /* Grupo::create([
                        'nome' => $row["nome"],
                        'zona' => $row["zona"],
                        'secao' => $row["secao"],
                        'apelido' => $row["apelido"],
                        'email' => $row["email"],
                        'telefone' => $row["telefone"],
                        'cep' => $row["cep"],
                        'bairro' => $row["bairro"],
                        'rua' => $row["rua"],
                        'numero' => $row["numero"],
                        'municipio' => $row["municipio"],
                        'tipo' => $row["tipo"],
                        'facebook' => $row["facebook"],
                        'instagram' => $row["instagram"],
                        'lat' => $latitude,
                        'lng' => $longitude,
                    ]); */

                    $pessoa->save();
                } catch (Exception $e) {
                    Log::error($e->getMessage());
                }
            }
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
        }
        DB::commit();
    }
}