<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grupo;
use App\Models\SecaoEleitoral;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use PDF;

class LideresController extends Controller
{
    public function index()
    {

        $lideres = Grupo::where('tipo','lideranca')->orderBy('nome')->get();

        $pessoas = Grupo::where('tipo','colaborador')->get(['id','tipo','lider_id']);


        return view('pages.lideres.index',compact('lideres','pessoas'));
    }

    public function colaboradores($id)
    {

        $lider = Grupo::where('id',$id)->first(['id','nome']);
        $colaboradores = Grupo::where('lider_id',$id)->get();

        return view('pages.lideres.colaboradores', compact('colaboradores','lider'));
    }

    public function mapacolaboradores($id)
    {
        $lider = Grupo::where('id',$id)->first('nome');
        $pessoas = Grupo::where('tipo','colaborador')->where('lider_id',$id)->get(['lat','lng','nome','tipo','foto','apelido']);

        return view('pages.lideres.mapacolaboradores', compact('lider','pessoas'));
    }

    public function gerarToken($id)
    {
        $lider = Grupo::findOrFail($id);

        if($lider->token == null){
            $lider->token = Str::uuid();
        }
        $lider->token_expires_at = Carbon::now()->addDays(7);
        $lider->save();

        $link = route('publico.link', ['token' => $lider->token]);
        $message = "Acesse seu link: $link";
        $whatsappLink = "https://api.whatsapp.com/send?phone=55{$lider->telefone}&text=".urlencode($message);
        
        return redirect($whatsappLink);
    }

    public function linkpublico($token)
    {
        $lider = Grupo::where('token', $token)->first();

        // if (!$lider || $lider->token_expires_at < Carbon::now()) {
        //     // abort(404);
        //     return view('pages.publico.expira');
        // }

        return view('pages.publico.link', ['lider' => $lider]);
    }

    public function cadastro_publico(Request $request)
    {
        $telefone = $request->telefone;
        $telefoneFormatado = preg_replace('/[^\d]/', '', $telefone);

        $verifica_telefone = Grupo::where('telefone',$telefoneFormatado)->get('id');

        if(count($verifica_telefone) > 0){

            return back()->withInput()->with('error', 'Esse usuario ja está cadastrado ou o telefone ja esta sendo usado.');
        }else{
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
            $pessoa->tipo           = 'colaborador';
            $pessoa->sexo           = $request->sexo;
            // $pessoa->zona           = $request->zona;
            // $pessoa->secao          = $request->secao;
            $pessoa->lider_id       = $request->lider_id;

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

            if(isset($request->foto))
            {
        
                // PRODUCTION
                $foto_perfil = $request->foto->store('foto','arquivos');
            

                // DESENVOLVIMENTO
                //  $foto_perfil = $request->foto->store('foto');

                $pessoa->foto = $foto_perfil;
            }
        
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
                    } 
                } 
            } 
      
            $pessoa->save();

            return redirect()->back()->with('sucesso', 'Colaborador Cadastrado com Sucesso');
        }   
    }

    public function baixarqrcode()
    {
        $pdf = PDF::loadView('pages.lideres.qrcode')
        ->setPaper('a4', 'portrait');

        return $pdf->stream();
    }

    public function linkpublicocreatelider()
    {
        return view('pages.lideres.cadastro_publico.create_publico');
    }

    public function storelideranca(Request $request)
    {
        $telefone = $request->telefone;
        $telefoneFormatado = preg_replace('/[^\d]/', '', $telefone);

        $verifica_telefone = Grupo::where('telefone',$telefoneFormatado)->get('id');

        if(count($verifica_telefone) > 0){

            return back()->withInput()->with('error', 'Esse usuario ja está cadastrado ou o telefone ja esta sendo usado.');
        }else{
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
            $pessoa->tipo           = 'lideranca';
            $pessoa->cadastro_externo = 'SIM';
            $pessoa->sexo           = $request->sexo;
            $pessoa->lider_id       = $request->lider_id;

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

            if(isset($request->foto))
            {
        
                // PRODUCTION
                $foto_perfil = $request->foto->store('foto','arquivos');
            

                // DESENVOLVIMENTO
                //  $foto_perfil = $request->foto->store('foto');

                $pessoa->foto = $foto_perfil;
            }
        
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
                    } 
                } 
            } 
      
            $pessoa->save();

            return redirect('/public-link/lideranca/sucesso');
        }
    }

    public function sucesso()
    {
        return view('pages.lideres.cadastro_publico.sucesso');
    }

}
