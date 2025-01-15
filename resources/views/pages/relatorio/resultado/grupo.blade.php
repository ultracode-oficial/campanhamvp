@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
<link rel="stylesheet" href="{{ asset('assets/css/jquery.dataTables.min.css') }}">
@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Grupo'])
    <div class="container-fluid px-2">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-12 mb-lg-0 mb-4">
                    <div class="card mt-4">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-6 d-flex align-items-center">
                                    <h6 class="mb-0">Grupo</h6>
                                </div>
                               
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <div class="card" style="padding: 16px;">
                                <div class="table-responsive">
                                    <table id="myTable" class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Nome</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Bairro</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Tipo</th>                                              
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Liderança</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($grupo as $individuo)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex px-2 py-1">
                                                            <div>
                                                                @if (isset($individuo->foto))
                                                                    {{-- <img src="{{ asset('uploads/' . $individuo->foto) }}" --}}
                                                                    <img src="{{ $path_file_storage . $individuo->foto }}"
                                                                        class="avatar avatar-sm me-3"> 
                                                                @else
                                                                    <img src="{{ asset('img/placeholder-avatar.jpg') }}"
                                                                        class="avatar avatar-sm me-3">
                                                                @endif
                                                            </div>
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <h6 class="mb-0 text-xs">{{ $individuo->nome }} @if(isset($individuo->apelido)) "{{$individuo->apelido}}" @endif</h6>
                                                                <p class="text-xs text-secondary mb-0">
                                                                    </p>
                                                                <p class="text-xs mb-0 ">
                                                                    {{ $individuo->telefone }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p class="text-xs font-weight-bold mb-0">{{ $individuo->bairro }}
                                                        </p>
                                                        {{-- <p class="text-xs text-secondary mb-0">Organization</p> --}}
                                                    </td>
                                                    <td class="align-middle text-center text-sm">
                                                        <span
                                                            class="text-xs font-weight-bold mb-0">{{ $individuo->tipo }} 
                                                            @if ($individuo->tipo == 'lideranca')
                                                                / ID: {{$individuo->id}}
                                                            @endif
                                                        </span>
                                                    </td>
                                                  
                                                    <td class="align-middle  text-center">
                                                    @if($individuo->lider)
                                                          {{ $individuo->lider->nome }}
                                                      @else
                                                          Sem liderança
                                                      @endif                                                   
                                                   </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
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
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>

    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>

    <script>
        var myTable = $("#myTable").DataTable({
            dom: 'Bfrtip', 
            buttons: [
            {
                extend: 'excel',
                title: 'Relatório de Grupos'
            },
            {
                extend: 'pdfHtml5',
                title: 'Relatório de Grupos',
                orientation: 'landscape', 
                pageSize: 'A4', 
                customize: function(doc) {            
                    doc.styles.tableHeader.alignment = 'left'; 
                    doc.styles.tableHeader.fontSize = 10; 
                    doc.defaultStyle.fontSize = 8; 

                    var objLayout = {};
                    objLayout['hLineWidth'] = function(i) { return 0.5; };
                    objLayout['vLineWidth'] = function(i) { return 0.5; };
                    objLayout['hLineColor'] = function(i) { return '#aaa'; };
                    objLayout['vLineColor'] = function(i) { return '#aaa'; };
                    objLayout['paddingLeft'] = function(i) { return 8; };
                    objLayout['paddingRight'] = function(i) { return 8; };
                    doc.content[1].layout = objLayout;
                }
            }
        ],
            language: {
                'url': '{{ asset('assets/js/portugues.json') }}',
                "decimal": ",",
                "thousands": ".",
            },
            stateSave: true,
            stateDuration: -1,
            responsive: true,
        })
    </script>
    
@endpush