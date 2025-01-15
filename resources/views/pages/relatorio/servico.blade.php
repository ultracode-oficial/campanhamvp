@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
<link rel="stylesheet" href="{{ asset('tomselect/tom-select.bootstrap4.css') }}">
<link rel="stylesheet" href="assets/css/jquery.dataTables.min.css"> 
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
                                    <h4 style="padding-bottom:5px;" class="mb-0">Relatório de Serviços</h6>
                                </div>
                                <div class="col-12 d-flex align-items-center">
                                    <h6 class="mb-0">Filtros</h6>
                                </div>

                            </div>
                        </div>
                            <div class="card-body p-3">
                                <form action="{{ url('') }}" method="post" enctype="multipart/form-data">
                                 {{ csrf_field() }}

                                    <div class="row">
                                        <div class="col-md-12 row" style="margin-bottom: 3rem;">

                                        

                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label for="servico" class="control-label">
                                                        Categoria</label>
                                                    <select id="servico" name="servico" required>
                                                        <option value="">Selecione a Categoria</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label for="sub_servico" class="control-label">
                                                        SubCategoria</label>
                                                    <select id="sub_servico" name="sub_servico" required>
                                                        <option value="">Selecione a SubCategoria</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label for="exampleFormControlSelect1">Status</label>
                                                    <select class="form-control" name="status" id="status">
                                                        <option value="">Selecione o status</option>
                                                        <option value="ABERTO">ABERTO</option>
                                                        <option value="NÃO REALIZADO">NÃO REALIZADO</option>
                                                        <option value="FINALIZADO">FINALIZADO</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12 row" style="margin-bottom: 3rem;">
                                            <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label for="servico" class="control-label">
                                                            Nome do Solicitante</label>
                                                        <select id="solicitante" name="solicitante" required>
                                                            <option value="">Nome do Solicitante</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                <div class="form-group">
                                                    <label for="servico" class="control-label">
                                                        Tipo do Solicitante</label>
                                                    <select id="tipoSolicitante" name="tipoSolicitante" required>
                                                        <option value=""> Tipo do Solicitante</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label for="servico" class="control-label">
                                                        Faixa Etária do Solicitante</label>
                                                    <select id="etariaSolicitante" name="etariaSolicitante" required>
                                                        <option value="">Faixa Etária do Solicitante</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label for="servico" class="control-label">
                                                        Bairro do Solicitante</label>
                                                    <select id="bairroSolicitante" name="bairroSolicitante" required>
                                                        <option value="">Bairro do Solicitante</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12 row" style="margin-bottom: 3rem;">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="data_solicitacao" class="form-control-label">Data da Solicitação</label>
                                                <input class="form-control datepicker" placeholder="Selecione a data de solicitação" type="text" id="data_solicitacao" name="data_solicitacao" onfocus="focused(this)" onfocusout="defocused(this)">
                                            </div>
                                        </div>

                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="data_prazo" class="form-control-label">Data Prazo</label>
                                                <input class="form-control datepicker" placeholder="Selecione a data prazo" type="text" id="data_prazo" name="data_prazo" onfocus="focused(this)" onfocusout="defocused(this)">
                                            </div>
                                        </div>

                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="data_finalizado" class="form-control-label">Data Finalizado</label>
                                                <input class="form-control datepicker" placeholder="Selecione a data de finalização" type="text" id="data_finalizado" name="data_finalizado" onfocus="focused(this)" onfocusout="defocused(this)">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="card-footer text-center">
                                    <button type="submit" id="btn_salvar" class="btn btn-primary">
                                        Consultar</button>
                                </div>
                                </form>
                             </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
@endsection

@push('js')
<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.js"></script>
<script src="https://npmcdn.com/flatpickr/dist/l10n/pt.js"></script>
<script src="{{ asset('tomselect/tom-select.complete.min.js') }}"></script>
<script>
    var myTable = $("#myTable").DataTable({
        language: {
            'url' : '{{ asset('assets/js/portugues.json') }}',
			"decimal": ",",
			"thousands": ".",
        },
        stateSave: true,
        stateDuration: -1,
        responsive: true,
    })
</script>
<script type="text/javascript">
    if (document.querySelector('.datepicker')) {
      flatpickr('.datepicker', {
        mode: "range",
        "locale": "pt"
      }); 
    }
  </script>
<script>
    var my_select = new TomSelect('#servico', {
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
    var my_select = new TomSelect('#sub_servico', {
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
    var my_select = new TomSelect('#solicitante', {
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
    var my_select = new TomSelect('#tipoSolicitante', {
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
    var my_select = new TomSelect('#etariaSolicitante', {
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
    var my_select = new TomSelect('#bairroSolicitante', {
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

@endpush