<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grupo;
use App\Models\LocalEleitoral;
use App\Models\SecaoEleitoral;
use DB;

class DashboardController extends Controller
{
    public function index()
    {
        $pessoas = Grupo::where('lat','!=',null)->get(['lat','lng','nome','tipo','foto','apelido']);

        $qtd_lider = Grupo::where('tipo','Lideranca')->count();

        $qtd_colabora = Grupo::where('tipo','colaborador')->count();

        $qtd_indeciso = Grupo::where('tipo','indeciso')->count();

        $idades = Grupo::select(DB::raw('FLOOR(DATEDIFF(CURDATE(), nascimento) / 365) as idade'), DB::raw('count(*) as total'))
                  ->groupBy('idade')
                  ->orderBy('idade')
                  ->get();

        // dd($idades);

        $total_por_bairro = DB::table('grupo')
        ->select(DB::raw("bairro, count(*) as qtd"))
            ->groupBy('bairro')
                ->get();

        $total_liders_bairro = DB::table('grupo')
        ->select(DB::raw("bairro, count(*) as qtd"))
            ->where(DB::raw('tipo'), '=', 'lideranca') 
                ->groupBy('bairro')
                    ->get();

        $total_colabora_bairro =DB::table('grupo')
        ->select(DB::raw("bairro, count(*) as qtd"))
            ->where(DB::raw('tipo'), '=', 'colaborador') 
                ->groupBy('bairro')
                    ->get();

        $total_indeciso_bairro = DB::table('grupo')
        ->select(DB::raw("bairro, count(*) as qtd"))
            ->where(DB::raw('tipo'), '=', 'indeciso') 
                ->groupBy('bairro')
                    ->get();

        $total_por_zona = DB::table('grupo')
        ->select(DB::raw("zona, count(*) as qtd"))
            ->where(DB::raw('tipo'), '=', 'colaborador') 
                ->groupBy('zona')
                    ->get();

        $total_lideres_colaboradores = Grupo::where('tipo', 'colaborador')
            ->select('lider_id', DB::raw('count(*) as qtd_colaboradores'))
                ->groupBy('lider_id')
                    ->orderByDesc('qtd_colaboradores')
                        ->get();

        $lideres = DB::table('grupo as l')
            ->leftJoin('grupo as g', function($join) {
                $join->on('l.id', '=', 'g.lider_id')
                     ->where('g.tipo', '=', 'colaborador');
            })
                ->select('l.nome as lider_nome', 'l.bairro', 'l.id as lider_id', DB::raw('count(g.id) as qtd_colaboradores'))
                    ->where('l.tipo', 'lideranca')
                        ->groupBy('l.id', 'l.nome', 'l.bairro')
                            ->orderByDesc(DB::raw('count(g.id)'))
                                ->get();

        $max_colaboradores = $lideres->max('qtd_colaboradores') || 1;

        // $locais_eleitorais = LocalEleitoral::with("secoes", "secoes.grupos")->get();

        $secoes_eleitorais = SecaoEleitoral::with("grupos", "local")->get();

        // $max_pessoas_local_eleitoral = $locais_eleitorais->reduce(function ($acc, $local) {
        //     $qty = $local->secoes->reduce (function($inAcc, $secao) {
        //         return $inAcc + count($secao->grupos);
        //     }, 0);

        //     return $acc < $qty ? $qty : $acc;
        // });


        $locais_eleitorais = LocalEleitoral::with(['secoes.grupos'])->get();
        
        $locais_com_eleitores = $locais_eleitorais->map(function($local) {
            $local->secoes->each(function($secao) {
                $secao->eleitores = $secao->grupos->map(function($grupo) {
                    $lider = null;
                    if ($grupo->tipo == 'colaborador' && $grupo->lider_id) {
                        $lider = Grupo::find($grupo->lider_id);
                    }
                    return [
                        'nome' => $grupo->nome,
                        'secao' => $grupo->secao,
                        'lider' => $lider ? $lider->nome : ''
                    ];
                });
            });
            return $local;
        });
        
        $locais_eleitorais_json = json_encode($locais_com_eleitores);
        $max_pessoas_local_eleitoral = $locais_com_eleitores->reduce(function ($acc, $local) {
            $qty = $local->secoes->reduce(function($inAcc, $secao) {
                return $inAcc + $secao->grupos->count();
            }, 0);
        
            return $acc < $qty ? $qty : $acc;
        });


        $total_liders_sexo = DB::table('grupo')
        ->select(DB::raw("sexo, count(*) as qtd"))
            ->where(DB::raw('tipo'), '=', 'lideranca') 
                ->groupBy('sexo')
                    ->get();

        
        $total_colabora_sexo = DB::table('grupo')
        ->select(DB::raw("sexo, count(*) as qtd"))
            ->where(DB::raw('tipo'), '=', 'colaborador') 
                ->groupBy('sexo')
                    ->get();

        return view('pages.dashboard.index', compact('locais_eleitorais_json','lideres', 'max_colaboradores','total_por_bairro','total_liders_bairro','total_colabora_bairro','total_indeciso_bairro', 'total_por_zona', 'qtd_lider','qtd_colabora','qtd_indeciso','pessoas','locais_eleitorais','secoes_eleitorais','max_pessoas_local_eleitoral','idades','total_liders_sexo','total_colabora_sexo'));
    }
}
