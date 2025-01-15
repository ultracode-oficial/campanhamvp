@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
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
                                <div class="col-6 d-flex align-items-center">
                                    <h6 class="mb-0">Usuarios</h6>
                                </div>
                                <div class="col-6 text-end">
                                    <a class="btn bg-gradient-dark mb-0" href="{{ url('user/create')}}"> Novo Usuario</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <div class="row">
                                
                                <table id="myTable" class="display">
                                    <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Email</th>
                                            <th>Nivel</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @foreach ($users as $user)
                                          <tr>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->nivel}}</td>
                                            <td></td>
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

    
@endsection

@push('js')
<script src="assets/js/jquery.dataTables.min.js"></script>
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
@endpush
