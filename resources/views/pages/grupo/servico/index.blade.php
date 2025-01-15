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
                                    <h4 class="mb-0">Historico de Serviços</h4>
                                </div>
                                <div class="col-6 text-end">
                                    <a class="btn bg-gradient-dark mb-0" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal"> Cadastrar novo
                                        Serviço</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-3">

                            <div class="x_panel">
                                <div class="row">
                                    <div class="col-md-6">
                                        <table class="table table-bordered table-hover table-striped">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th colspan="2">Informações Pessoais</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><b>Nome</b></td>
                                                    <td>{{ $pessoa->nome }}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Apelido</b></td>
                                                    <td>{{ $pessoa->apelido }}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Endereço</b></td>
                                                    <td>{{ $pessoa->rua }}, nº {{ $pessoa->numero }} -
                                                        {{ $pessoa->bairro }} - {{ $pessoa->municipio }}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Data de Nascimento</b></td>
                                                    <td>{{ date('d/m/Y', strtotime($pessoa->nascimento)) }}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Tipo</b></td>
                                                    <td>{{ $pessoa->tipo }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-bordered table-hover table-striped">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th colspan="2">Informações Adicionais</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><b>Celular</b></td>
                                                    <td>{{ $pessoa->telefone }}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Facebook</b></td>
                                                    <td>{{ $pessoa->facebook }}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Instagram</b></td>
                                                    <td>{{ $pessoa->instagram }}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Zona</b></td>
                                                    <td>{{ $pessoa->zona }}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Seção</b></td>
                                                    <td>{{ $pessoa->secao }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            @foreach ($pessoa->servicos as $servico)
                                <div class="card card-frame">
                                    <div class="card-header pb-0 p-3">
                                        <div class="row">
                                            <div class="col-6 d-flex align-items-center">
                                                <h4 class="mb-0"> {{ $servico->servico }}</h4>
                                            </div>
                                            <div class="col-6 text-end">
                                                <a class="btn btn-warning btn-xs action botao_acao" data-placement="bottom"
                                                href="{{ url("/servicogrupoedit/$servico->id/edit") }}"
                                                    title="Serviços">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
                                                        <path
                                                            d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492M5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0" />
                                                        <path
                                                            d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115z" />
                                                    </svg>
                                                </a>

                                                <a class="btn btn-danger btn-xs action botao_acao btn_delete"
                                                    data-delete="{{ $servico->id }}" data-toggle="tooltip" data-placement="bottom"
                                                    title="Deletar Pessoa">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                        fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                        <path
                                                            d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0" />
                                                    </svg>
                                                </a>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="example-text-input" class="form-control-label">

                                                        Subcategoria</label>
                                                    <input class="form-control" value="{{ $servico->sub_servico }}"
                                                        type="text" id="nome" name="nome" readonly>
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="example-text-input" class="form-control-label">

                                                        Data da Solicitação</label>
                                                    <input class="form-control"
                                                        value="{{ date('d/m/Y', strtotime($servico->data_solicitacao)) }}"
                                                        type="text" id="nome" name="nome" readonly>
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="example-text-input" class="form-control-label">

                                                        Data Prazo</label>
                                                    <input class="form-control"
                                                        @if (isset($servico->data_prazo)) value="{{ date('d/m/Y', strtotime($servico->data_prazo)) }}" @endif
                                                        type="text" id="nome" name="nome" readonly>
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="example-text-input" class="form-control-label">

                                                        Data Finalizado</label>
                                                    <input class="form-control"
                                                        @if (isset($servico->data_finalizado)) value="{{ date('d/m/Y', strtotime($servico->data_finalizado)) }}" @endif
                                                        type="text" id="nome" name="nome" readonly>
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="example-text-input" class="form-control-label">

                                                        Status</label>
                                                    <input class="form-control" value="{{ $servico->status }}"
                                                        type="text" id="nome" name="nome" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="example-text-input" class="form-control-label">

                                                        Indicação</label>
                                                    <input class="form-control" value="{{ $servico->indicacao }}"
                                                        type="text" id="nome" name="nome" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label for="example-text-input" class="form-control-label">

                                                        Observação</label>
                                                    <textarea rows="1" class="form-control" id="observacao" name="observacao" maxlength="500" readonly>{{ $servico->obs }}</textarea>

                                                </div>
                                            </div>






                                        </div>
                                    </div>
                                </div>
                            @endforeach



                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detalhes do Serviço</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('servicogrupo.store') }}" method="post">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <div class="row">
                                <input type="hidden" name="grupo_id" id="grupo_id" value="{{ $pessoa->id }}">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="servico" class="control-label"><b style="color:red">*</b>
                                            Serviço</label>
                                        <select onchange="getSubServicos()" id="servico" name="servico" required>
                                            <option value="">Selecione o Serviço</option>
                                            @foreach ($servicos as $servico)
                                                <option value="{{ $servico->id }}">{{ $servico->nome }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="subcategoria" class="control-label"><b style="color:red">*</b>
                                            Subcategoria</label>
                                        <select id="selectSubcategoria" name="selectSubcategoria" required>
                                            <option value="">Selecione a Subcategoria</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="data_solicitacao" class="form-control-label"><b
                                                style="color:red">*</b> Data da
                                            Solicitação</label>
                                        <input class="form-control" type="date" id="data_solicitacao"
                                            name="data_solicitacao" value="{{ old('data_solicitacao') }}" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="data_prazo" class="form-control-label">Data Prazo</label>
                                        <input class="form-control" type="date" id="data_prazo" name="data_prazo"
                                            value="{{ old('data_prazo') }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="data_finalizado" class="form-control-label">Data Finalizado</label>
                                        <input class="form-control" type="date" id="data_finalizado"
                                            name="data_finalizado" value="{{ old('data_finalizado') }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Status</label>
                                        <select class="form-control" name="status" id="status">
                                            <option value="ABERTO">ABERTO</option>
                                            <option value="NÃO REALIZADO">NÃO REALIZADO</option>
                                            <option value="FINALIZADO">FINALIZADO</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="observacao" class="form-control-label">Observação</label>
                                        <textarea class="form-control" id="observacao" name="observacao" maxlength="500">{{ old('observacao') }}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="indicacao" class="form-control-label">Indicado por</label>
                                        <input class="form-control" type="text" id="indicacao" name="indicacao"
                                            value="{{ old('indicacao') }}">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="btn_salvar" class="btn bg-gradient-primary">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection


    @push('js')
        <script src="{{ asset('tomselect/tom-select.complete.min.js') }}"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script>
            var my_select = new TomSelect('#servico', {
                create: true,
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
        </script>
        <script>
            var selectsubservicos = new TomSelect('#selectSubcategoria', {
                maxItems: 1,
                valueField: 'id',
                labelField: 'title',
                searchField: 'title',
                options: [],
                plugins: {
                    remove_button: {
                        title: 'Remover o item',
                    }
                },
                create: true
            });

            const servicoSelect = document.getElementById('servico');
            const subCategoriaSelect = document.getElementById('subcategoria');

            const getSubServicos = async () => {

                if (servicoSelect.value) {

                    const response = await axios.get('/api/subServicos', {
                        params: {
                            servico_id: servicoSelect.value,
                        }
                    });

                    const subservicos = response.data;

                    // limpa o select
                    selectsubservicos.clear();
                    selectsubservicos.clearOptions();

                    // popula o select
                    for (let subservico of subservicos) {
                        selectsubservicos.addOption({
                            id: subservico.nome,
                            title: subservico.nome
                        });
                    }

                }
            }
        </script>

        <script>
             $(document).ready(function() {
            $("body").on("click", "a.btn_delete", function(e) {
                // Evitar que a página seja recarregada	
                e.preventDefault();
                let id = $(this).data('delete');

                swal({
                    title: "Atenção!",
                    text: 'Você esta prestes a EXCLUIR um Serviço',
                    icon: "warning",
                    buttons: {
                        cancel: {
                            text: "Cancelar",
                            value: "cancelar",
                            visible: true,
                            closeModal: true,
                        },
                        ok: {
                            text: "Sim, EXCLUIR!",
                            value: 'excluir',
                            visible: true,
                            closeModal: true,
                            color: "dark"
                        }
                    }
                }).then(function(resultado) {
                    if (resultado === 'excluir') {
                        $.post("{{ url('/servicogrupodelete') }}/" + id, {
                            id: id,
                            _method: "DELETE",
                            _token: "{{ csrf_token() }}",
                        }).done(function() {
                            location.reload();
                        });
                    }
                });
            });
        });
        </script>
    @endpush
