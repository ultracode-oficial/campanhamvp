@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
<link rel="stylesheet" href="{{ asset('tomselect/tom-select.bootstrap4.css') }}">
@section('content')
    @include('layouts.navbars.auth.topnav')
    <div class="container-fluid px-2">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-12 mb-lg-0 mb-4">
                    <div class="card mt-4">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-12 d-flex align-items-center">
                                    <h4 style="padding-bottom:5px;" class="mb-0">Relatório de Colaboradores</h4>
                                </div>
                                <div class="col-12 d-flex align-items-center">
                                    <h6 class="mb-0">Filtros</h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-3">
                          <form action="{{ url('relatorio/resultado') }}" method="get" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row">

                                {{-- <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="idade_minima" class="control-label">Idade Mínima</label>
                                        <input type="number" class="form-control" id="idade_minima" name="idade_minima" placeholder="Digite a idade mínima">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="idade_maxima" class="control-label">Idade Máxima</label>
                                        <input type="number" class="form-control" id="idade_maxima" name="idade_maxima" placeholder="Digite a idade máxima">
                                    </div>
                                </div> --}}
                                
                                {{-- <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="folha" class="control-label">Folha</label>
                                        <select class="form-control" name="folha" id="folha">
                                            <option value="">Selecione um valor</option>
                                            <option value="null">Não informado</option>
                                            <option value="Sim">Sim</option>
                                            <option value="Não">Não</option>
                                        </select>
                                    </div>
                                </div> --}}

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="local_vota" class="control-label">Local de Votação</label>
                                        <select class="form-control" name="local_vota" id="local_vota">
                                            <option value="">Selecione um valor</option>
                                            <option value="vazio">Local não encontrado</option>
                                        </select>
                                    </div>
                                </div>

                               

                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="bairroColaborador" class="control-label">Bairro do Colaborador</label>
                                        <select id="bairroColaborador" name="bairros[]" >
                                            <option value="">Selecione o Bairro do Colaborador</option>
                                            @foreach($bairros as $bairro)
                                                <option value="{{ $bairro }}">{{ $bairro }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="nomeLiderancaColaborador" class="control-label">Nome da Liderança do Colaborador</label>
                                        <select id="nomeLiderancaColaborador" name="lideranca_ids[]" >
                                            <option value="">Nome da Liderança do Colaborador</option>
                                            @foreach($grupos as $colaborador)
                                                @if($colaborador->tipo == 'lideranca')
                                                    <option value="{{ $colaborador->id }}">{{ $colaborador->nome }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="card-footer text-center">
                                <button type="submit" id="btn_consultar" class="btn btn-primary">Consultar</button>
                            </div>
                          </form>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
<script src="{{ asset('tomselect/tom-select.complete.min.js') }}"></script>
<script>
    $(document).ready(function () {
        // TomSelect para Bairros
        new TomSelect('#bairroColaborador', {
            maxItems: null,
            plugins: {
                remove_button: {
                    title: 'Remover o item',
                }
            },
            sortField: {
                field: 'text',
                direction: 'asc'
            },
        });

        // TomSelect para Liderança
        new TomSelect('#nomeLiderancaColaborador', {
            maxItems: null,
            plugins: {
                remove_button: {
                    title: 'Remover o item',
                }
            },
            sortField: {
                field: 'text',
                direction: 'asc'
            },
        });
    });
</script>
@endpush