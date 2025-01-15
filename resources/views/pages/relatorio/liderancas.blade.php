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
                                    <h4 style="padding-bottom:5px;" class="mb-0">Relatório de Lideranças</h6>
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
                                            <label for="lider" class="control-label">
                                                Nome do Líder</label>
                                            <select id="lider" name="lider" required>
                                                <option value="">Nome do Líder</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div  class="col-md-5"></div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="etariaLider" class="control-label">
                                                Faixa Etária do Líder</label>
                                            <select id="etariaLider" name="etariaLider" required>
                                                <option value="">Faixa Etária do Líder</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="bairroLider" class="control-label">
                                                Bairro do Líder</label>
                                            <select id="bairroLider" name="bairroLider" required>
                                                <option value="">Bairro do Líder</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                  </div>
                                  <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="zonaColaboradoresLider" class="control-label">
                                                Zona dos colaboradores do Líder</label>
                                            <select id="zonaColaboradoresLider" name="zonaColaboradoresLider" required>
                                                <option value="">Zona dos colaboradores do Líder</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="secaoColaboradoresLider" class="control-label">
                                            Seção dos colaboradores do Líder</label>
                                            <select id="secaoColaboradoresLider" name="secaoColaboradoresLider" required>
                                                <option value="">Seção dos colaboradores do Líder</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="localVotacaoColaboradores" class="control-label">
                                                Local de Votação dos Colaboradores do Líder</label>
                                            <select id="localVotacaoColaboradores" name="localVotacaoColaboradores" required>
                                                <option value="">Local de Votação dos Colaboradores do Líder</option>
                                            </select>
                                        </div>
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
    var my_select = new TomSelect('#lider', {
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
    var my_select = new TomSelect('#etariaLider', {
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
    var my_select = new TomSelect('#bairroLider', {
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
    var my_select = new TomSelect('#zonaColaboradoresLider', {
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
    var my_select = new TomSelect('#secaoColaboradoresLider', {
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
    var my_select = new TomSelect('#localVotacaoColaboradores', {
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