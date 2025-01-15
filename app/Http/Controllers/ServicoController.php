<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grupo;
use App\Models\Servico;
use App\Models\SubServico;
use App\Models\ServicoGrupo;

class ServicoController extends Controller
{

    public function servicoGrupoIndex($id)
    {
        $pessoa = Grupo::with('servicos')->find($id);

        $servicos = Servico::all();

        return view('pages.grupo.servico.index',compact('pessoa','servicos'));
    }

    public function getSubservicos(Request $request)
    {
        $subServico = SubServico::where('servico_id',$request->servico_id)->get();

        return $subServico;
    }

    public function servicoGrupoDelete(Request $request)
    {

        $servicogrupo = ServicoGrupo::find($request->id);

        $servicogrupo->delete();

    }

    public function servicoGrupoEdit($id)
    {
        $servico = ServicoGrupo::with('grupo')->find($id);

        return view('pages.grupo.servico.edit', compact('servico'));
    }

    public function servicoGrupoUpdate(Request $request)
    {
        
        // dd($request->all());
        $servico = ServicoGrupo::find($request->servico_id);
        
        
        $servico->data_prazo       = $request->data_prazo;
        $servico->data_finalizado  = $request->data_finalizado;
        $servico->status           = $request->status;
        $servico->indicacao        = $request->indicacao;
        $servico->obs              = $request->obs;

        $servico->save();
        

        return redirect("/servicogrupoindex/$request->grupo_id");
    }

    public function servicoGrupoStore(Request $request)
    {
        // dd($request->all());
        
        // preciso testar se o servico é igual a algum id existente
        $checa_existe_servico = Servico::where('id',$request->servico)->first();

        // se não for cria primeiro um servico, depois cria um selectSubcategoria
        // depois cria o ServicoGrupo
        if($checa_existe_servico == null){
       
            // cria servico
            $servico = new Servico;
            $servico->nome = $request->servico;
            $servico->save();

            // cria subservico
            $subservico = new SubServico;
            $subservico->nome = $request->selectSubcategoria;
            $subservico->servico_id = $servico->id;
            $subservico->save();

            // cria servicogrupo

            $servicogrupo = new ServicoGrupo;
            $servicogrupo->servico            = $request->servico;
            $servicogrupo->sub_servico        = $request->selectSubcategoria;
            $servicogrupo->data_solicitacao   = $request->data_solicitacao;
            $servicogrupo->data_prazo         = $request->data_prazo;
            $servicogrupo->data_finalizado    = $request->data_finalizado;
            $servicogrupo->status             = $request->status;
            $servicogrupo->obs                = $request->observacao;
            $servicogrupo->indicacao          = $request->indicacao;
            $servicogrupo->grupo_id           = $request->grupo_id;
            $servicogrupo->save();

            return redirect()->back()->with('sucesso', 'Serviço cadastrado com sucesso'); 

        }else{

            // testa se sub_servico existe
            $checa_existe_subservico = SubServico::where('servico_id',$request->servico)->where('nome',$request->selectSubcategoria)->first();

            if($checa_existe_subservico == null){
                $subservico = new SubServico;
                $subservico->nome = $request->selectSubcategoria;
                // aqui o $request->servico vem com o id
                $subservico->servico_id = $request->servico;
                $subservico->save();
            }

            $servicogrupo = new ServicoGrupo;
            $servicogrupo->servico            = $checa_existe_servico->nome;
            $servicogrupo->sub_servico        = $request->selectSubcategoria;
            $servicogrupo->data_solicitacao   = $request->data_solicitacao;
            $servicogrupo->data_prazo         = $request->data_prazo;
            $servicogrupo->data_finalizado    = $request->data_finalizado;
            $servicogrupo->status             = $request->status;
            $servicogrupo->obs                = $request->observacao;
            $servicogrupo->indicacao          = $request->indicacao;
            $servicogrupo->grupo_id           = $request->grupo_id;
            $servicogrupo->save();
      
            return redirect()->back()->with('sucesso', 'Serviço cadastrado com sucesso'); 
        }

        
        
        
        

    }

}
