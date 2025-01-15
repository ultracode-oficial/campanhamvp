<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use Illuminate\Http\Request;
use App\Models\LocalEleitoral;
use App\Models\SecaoEleitoral;
use Carbon\Carbon;

class RelatorioController extends Controller
{
    public function index()
    {
        return view('pages.relatorio.index');
    }

    public function grupo()
    {
        $grupos = Grupo::all();
        $normalize = function ($string) {
            $string = mb_strtoupper($string, 'UTF-8');
            $string = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $string);
            $string = preg_replace('/[^A-Z0-9\s]/', '', $string); 
            return $string;
        };

        $bairros = $grupos->pluck('bairro')
                         ->map($normalize) 
                         ->unique()
                         ->values(); 

        return view('pages.relatorio.grupo', compact('grupos', 'bairros')); 
    }
    public function getZonas()
    {
        $zonas = SecaoEleitoral::distinct()->pluck('zona');
        return response()->json($zonas);
    }

    public function getSecoes($zona)
    {
        $secoes = SecaoEleitoral::where('zona', $zona)->get();
        
        $formattedSecoes = $secoes->map(function($secao) {
            return [
                'id' => $secao->secao, 
                'title' => $secao->secao 
            ];
        });
        
        return response()->json($formattedSecoes);
    }

    public function getSecoesFromZonas(Request $request)
    {
        $zonas = explode(",", $request->query("zonas"));

        $secoes = SecaoEleitoral::whereIn('zona', $zonas)->get();
        
        $formattedSecoes = $secoes->map(function($secao) {
            return [
                'id' => $secao->secao, 
                'title' => $secao->secao 
            ];
        });
        
        return response()->json($formattedSecoes);
    }
    
    

    public function getLocaisFromZonasSecoes(Request $request)
    {
        $locais = LocalEleitoral::select("id", "nome_local");

        $queryZonas = $request->query("zonas");
        $querySecoes = $request->query("secoes");

        $zonas = $queryZonas != null ? explode(",", $queryZonas) : [];
        $secoes = $querySecoes != null ? explode(",", $querySecoes) : [];

        if(count($zonas) > 0) {
            //$locais = $locais->whereIn("zona", $zonas);
            $locais = $locais->whereHas("secoes", function ($query) use ($zonas) {
                return $query->whereIn("zona", $zonas);
            });
        };
        
        if(count($secoes) > 0) {
            //$locais = $locais->whereIn("secao", $secoes);
            $locais = $locais->whereHas("secoes", function ($query) use ($secoes) {
                return $query->whereIn("secao", $secoes);
            });
        };

        $locais = $locais->get();
        return response()->json($locais);
    }
    public function relatorioGrupo(Request $request)
    {
        // $query = Grupo::with("lider", "secao", "secao.local");
        
        // dd($request->all());

        // Data atual
        $query = Grupo::query();

        // if ($request->filled('idade_minima')) {
        //     $idadeMinima = $request->input('idade_minima');
        //     $query->whereRaw('TIMESTAMPDIFF(YEAR, nascimento, CURDATE()) >= ?', [$idadeMinima]);
        // }

        // if ($request->filled('idade_maxima')) {
        //     $idadeMaxima = $request->input('idade_maxima');
        //     $query->whereRaw('TIMESTAMPDIFF(YEAR, nascimento, CURDATE()) <= ?', [$idadeMaxima]);
        // }
        if($request->filled('local_vota')) {
            $local_vota = $request->input('local_vota');

            if ($local_vota === 'vazio') {
                $query->join('secao_eleitoral', function ($join) {
                    $join->on('grupo.zona', '=', 'secao_eleitoral.zona')
                         ->on('grupo.secao', '=', 'secao_eleitoral.secao')
                         ->whereNull('secao_eleitoral.local_eleitoral_id');
                });
            }
        }

        if ($request->filled('bairros')) {
            $bairros = $request->input('bairros');
            $query->whereIn('bairro', $bairros);
        }

        if ($request->filled('lideranca_ids')) {
            $liderancaIds = $request->input('lideranca_ids');
            $query->whereIn('lider_id', $liderancaIds);
        }

        if ($request->folha) {
            $folha = $request->input('folha');
            if ($folha === 'null') {
                $query->whereNull('folha');
            } else {
                $query->where('folha', $folha);
            }
        }

        $grupo = $query->get();

        // dd($grupo);
    
        return view('pages.relatorio.resultado.grupo', compact('grupo'));
    }
    

  

    public function liderancas()
    {
        return view('pages.relatorio.liderancas'); 
    }

    public function servicos()
    {
        return view('pages.relatorio.servico'); 
    }
}