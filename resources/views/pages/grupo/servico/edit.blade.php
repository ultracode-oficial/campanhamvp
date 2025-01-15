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
                                <div class="col-6 d-flex align-items-center">
                                    <h4 class="mb-0">Serviço Detalhado: {{ $servico->servico }}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card-body">
                                        <form action="{{route('servicogrupo.update')}}" method="post">
                                            {!! method_field('PUT') !!}
                                                {{ csrf_field() }}
                                                <input type="hidden" name="servico_id" value="{{$servico->id}}">

                                                <input type="hidden" name="grupo_id" value="{{$servico->grupo->id}}">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="example-text-input" class="form-control-label">
                                                            Subcategoria</label>
                                                        <input class="form-control" value="{{ $servico->sub_servico }}"
                                                            type="text" id="sub_servico" name="sub_servico" readonly>
                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="example-text-input" class="form-control-label">
                                                            Data da Solicitação</label>
                                                        <input class="form-control"
                                                            value="{{ date('d/m/Y', strtotime($servico->data_solicitacao)) }}"
                                                            type="text" id="data_solicitacao" name="data_solicitacao" readonly>
                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="example-text-input" class="form-control-label">

                                                            Data Prazo</label>
                                                        <input class="form-control" value="{{ $servico->data_prazo }}"
                                                            type="date" id="data_prazo" name="data_prazo">
                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="example-text-input" class="form-control-label">

                                                            Data Finalizado</label>
                                                        <input class="form-control" value="{{ $servico->data_finalizado }}"
                                                            type="date" id="data_finalizado" name="data_finalizado">
                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                    <div class="form-group">

                                                        <label for="exampleFormControlSelect1">Status</label>
                                                        <select class="form-control" name="status" id="status">
                                                            <option value="{{ $servico->status }}">{{ $servico->status }}
                                                            </option>
                                                            <option value="ABERTO">ABERTO</option>
                                                            <option value="NÃO REALIZADO">NÃO REALIZADO</option>
                                                            <option value="FINALIZADO">FINALIZADO</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="example-text-input" class="form-control-label">

                                                            Indicação</label>
                                                        <input class="form-control" value="{{ $servico->indicacao }}"
                                                            type="text" id="indicacao" name="indicacao">
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label for="example-text-input" class="form-control-label">

                                                            Observação</label>
                                                        <textarea rows="1" class="form-control" id="obs" name="obs" maxlength="500">{{ $servico->obs }}</textarea>

                                                    </div>
                                                </div>


                                                <div class="modal-footer">
                                                    <button type="submit" id="btn_salvar"
                                                        class="btn bg-gradient-primary">Salvar</button>
                                                </div>



                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endsection


    @push('js')
    @endpush
