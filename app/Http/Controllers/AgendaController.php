<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agenda;
use Carbon\Carbon;
use App\Models\Grupo;

class AgendaController extends Controller
{
    public function index()
    {

        $agendas = Agenda::all();
        
        $data_hj = Carbon::today('America/Sao_Paulo');

        $ano = $data_hj->format('Y');
        
        $prox_semana = $data_hj->copy()->addDays(7);

        $aniversarios = Grupo::get(['id','nome','nascimento','telefone']);

        $prox_eventos = Agenda::whereBetween('start', [$data_hj, $prox_semana])
        ->orderBy('start', 'asc')
        ->orderBy('hora','asc')
        ->get();
        

        return view('pages.agenda.index', compact('agendas','prox_eventos','ano','aniversarios'));
    }

    public function store(Request $request)
    {
        $agenda = new Agenda;

        $agenda->title = $request->title;
        $agenda->start = $request->start;
        $agenda->hora = $request->hora;
        $agenda->descricao = $request->descricao;
        // dd($request->all());
        $agenda->save();

        return back()->with('success','Agendamento Realizado Com Sucesso!');

    }

    public function destroy($id)
    {
        $agenda = Agenda::find($id);

        $agenda->delete();
    }
}
