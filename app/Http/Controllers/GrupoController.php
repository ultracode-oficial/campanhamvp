<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Grupo;
use App\Models\User;
use App\Models\SecaoEleitoral;
use Illuminate\Support\Facades\Storage;
use App\Imports\GrupoImport;
use App\Exports\GrupoExport;
use App\Exports\GrupoLiderExport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\HeadingRowImport;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Collection;
use PDF;

class GrupoController extends Controller
{
    public function index()
    {
        $grupo = Grupo::all();

        // Verifica telefones duplicados
        $telefones = $grupo->pluck('telefone')->toArray();
        $telefonesDuplicados = array_diff_assoc($telefones, array_unique($telefones));

        return view('pages.grupo.index',compact('grupo','telefonesDuplicados'));
    }

    public function create()
    {
        $lideres = Grupo::where('tipo','lideranca')->get(['id','nome']);

        return view('pages.grupo.create', compact('lideres'));
    }

    public function store(Request $request)
    {
        $telefone = $request->telefone;
        $telefoneFormatado = preg_replace('/[^\d]/', '', $telefone);

        $verifica_telefone = Grupo::where('telefone',$telefoneFormatado)->get('id');
        if(count($verifica_telefone) > 0){
            return back()->withInput()->with('error', 'Esse usuario ja está cadastrado ou o telefone ja esta sendo usado.');

        } else {
            $pessoa = new Grupo;
            $pessoa->nome           = $request->nome;
            $pessoa->apelido        = $request->apelido;
            $pessoa->email          = $request->email;
            $pessoa->nascimento     = $request->nascimento;
            $pessoa->cep            = $request->cep;
            $pessoa->rua            = $request->rua;
            $pessoa->municipio      = $request->municipio;
            $pessoa->bairro         = $request->bairro;
            $pessoa->numero         = $request->numero;
            $pessoa->facebook       = $request->facebook;
            $pessoa->instagram      = $request->instagram;
            $pessoa->tipo           = $request->tipo;
            $pessoa->sexo           = $request->sexo;

            if ($request->zona OR $request->secao) {
                $zona = $request->zona ? str_pad($request->zona, 4, "0", STR_PAD_LEFT) : "0000";
                $secao = $request->secao ? str_pad($request->secao, 4, "0", STR_PAD_LEFT) : "0000";
        
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
            
            if($request->tipo == 'Colaborador'){ 
                $pessoa->lider_id  = $request->lider_id;
            }

            $telefone = $request->telefone;
            $telefoneFormatado = preg_replace('/[^\d]/', '', $telefone);
            $pessoa->telefone = $telefoneFormatado;

            if(isset($request->foto))
            {
                // PRODUCTION
                $foto_perfil = $request->foto->store('foto','arquivos');

                // DESENVOLVIMENTO
                //  $foto_perfil = $request->foto->store('foto');

                $pessoa->foto = $foto_perfil;
            }

            $address = $request->cep.','.$request->rua.','.$request->municipio.','.$request->bairro.','.$request->numero;
                
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
        
                        $pessoa->lat = $latitude;
                        $pessoa->lng = $longitude;
                        // echo "Latitude: $latitude, Longitude: $longitude";
                    }
                }
            }
        
            $pessoa->save();
            return redirect('/grupo');
        }
    }

    public function edit($id)
    {
        $pessoa = Grupo::find($id);
        $lideres = Grupo::where('tipo','lideranca')->get(['id','nome']);

        return view('pages.grupo.edit', compact('pessoa','lideres'));
        
    }

    public function update(Request $request, $id)
    {
        $telefone = $request->telefone;
        $telefoneFormatado = preg_replace('/[^\d]/', '', $telefone);

        $pessoa = Grupo::find($id);

        $verifica_telefone = Grupo::where('telefone', $telefoneFormatado)
                                ->where('id', '!=', $id) 
                                ->get('id');

        if(count($verifica_telefone) > 0) {
            return back()->withInput()->with('error', 'Esse usuário já está cadastrado ou o telefone já está sendo usado.');
        } else {

            // ------------ comparar o endereço pra usar a api de converte do gugule maps
            $existe_cep = strtolower(trim($request->cep)) !== strtolower(trim($pessoa->cep));
            $existe_rua = strtolower(trim($request->rua)) !== strtolower(trim($pessoa->rua));
            $existe_municipio = strtolower(trim($request->municipio)) !== strtolower(trim($pessoa->municipio));
            $existe_bairro = strtolower(trim($request->bairro)) !== strtolower(trim($pessoa->bairro));
            $existe_numero = trim($request->numero) !== trim($pessoa->numero);
            // ---------------

            $pessoa->nome = $request->nome;
            $pessoa->apelido = $request->apelido;
            $pessoa->email = $request->email;
            $pessoa->nascimento = $request->nascimento;
            $pessoa->cep = $request->cep;
            $pessoa->rua = $request->rua;
            $pessoa->municipio = $request->municipio;
            $pessoa->bairro = $request->bairro;
            $pessoa->numero = $request->numero;
            $pessoa->facebook = $request->facebook;
            $pessoa->instagram = $request->instagram;
            $pessoa->tipo = $request->tipo;
            $pessoa->sexo = $request->sexo;
            if ($request->zona OR $request->secao) {
                $zona = $request->zona ? str_pad($request->zona, 4, "0", STR_PAD_LEFT) : "0000";
                $secao = $request->secao ? str_pad($request->secao, 4, "0", STR_PAD_LEFT) : "0000";
        
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

            $pessoa->telefone = $telefoneFormatado;

            if($request->tipo == 'Colaborador') {
                $pessoa->lider_id = $request->lider_id ?? null;
            } else {
                $pessoa->lider_id = null;
            }

            if ($request->hasFile('foto')) {
                if ($pessoa->foto) {
                    // PRODUCTION
                    Storage::disk('arquivos')->delete($pessoa->foto);

                    // DESENVOLVIMENTO
                    // unlink('uploads/'.$pessoa->foto);
                }

                // PRODUCTION
                $foto_perfil = $request->foto->store('foto', 'arquivos');

                // DESENVOLVIMENTO
                // $foto_perfil = $request->foto->store('foto');
                $pessoa->foto = $foto_perfil;
            }


           if($existe_bairro || $existe_cep || $existe_municipio || $existe_numero || $existe_rua){
                $address = $request->cep.','.$request->rua.','.$request->municipio.','.$request->bairro.','.$request->numero;
                // $address = 'socorro';
                    
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
            
                            $pessoa->lat = $latitude;
                            $pessoa->lng = $longitude;
                            // echo "Latitude: $latitude, Longitude: $longitude";
                        } 
                    } 
                }
            }

            $pessoa->save();

            return redirect('/grupo');

        }


    }

    public function destroy($id)
    {
     
        $pessoa = Grupo::find($id);

        $pessoa->delete();

        $colaboradores = Grupo::where('lider_id',$id)->get();
        
        foreach($colaboradores as $colaborador){
            
            $colabora = Grupo::find($colaborador->id);
            $colabora->lider_id = null;

            $colabora->save();

        }
        
    }

    public function importExcel(Request $request)
    {
        try {
            $uploadedFile = request()->file("excel_file");
            // Check if file type matches xlsx:
            $mimeType = $uploadedFile->getClientMimeType();
            if ($mimeType !== "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet") {
                throw ValidationException::withMessages(["Tipo de arquivo inválido."]);
            }

            // Check uploaded Excel Heading format:
            $correctHeadingFormat = ["nome","zona","secao","apelido","email","nascimento","telefone","cep","bairro","rua","numero","municipio","tipo","facebook","instagram","lider_id","sexo"];
            $headings = (new HeadingRowImport)->toArray($uploadedFile)[0][0];

            if ($headings !== $correctHeadingFormat) {
                throw ValidationException::withMessages(["Formato da tabela inválido."]);
            }

            // Read and import data:
            Excel::import(new GrupoImport, $uploadedFile);
            return [ "message" => "success" ];

        } catch (Exception $e) {
            Log::error($e->getMessage());
            return Response::json([ "message" => "error" ], 500);
        }
    }

    public function exportExcel()
    {
        return Excel::download(new GrupoExport, 'grupo-campanha-ultracode.xlsx');
    }

    public function exportColaboradoresLiderancaExcel($id)
    {
        return Excel::download(new GrupoLiderExport($id), 'grupo-campanha-ultracode.xlsx');
    }
    
    public function exportColaboradoresLiderancaPDF($id)
    {
        $lider = Grupo::where('id',$id)->get('nome');
        // dd($lider);
        $colaboradores = Grupo::where('lider_id', $id)
            ->join('secao_eleitoral', function ($join) {
                $join->on('grupo.zona', '=', 'secao_eleitoral.zona')
                    ->on('grupo.secao', '=', 'secao_eleitoral.secao');
            })
            ->join('local_eleitoral', 'secao_eleitoral.local_eleitoral_id', '=', 'local_eleitoral.id')
            ->select('grupo.*', 'local_eleitoral.nome_local')
            ->get();
        // dd($colaboradores);
        $pdf = PDF::loadView('pages.lideres.pdf', array('colaboradores' =>  $colaboradores, 'lider' => $lider))
        ->setPaper('a4', 'portrait');
        return $pdf->stream();
    }
}
