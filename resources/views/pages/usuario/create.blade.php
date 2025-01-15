@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
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
                                    <h6 class="mb-0">Novo Usuario</h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <div class="row">
                                <form action="{{url('/user')}}"  method="POST"> 
                                    {{ csrf_field() }}
    
                                    <div class="card-body pt-4 p-3">
                                        Senha padrão: <b>campanha123</b>
                                        <div class="form-group row">
                                            <div class="form-group col-md-4 col-sm-4 col-xs-12">
                                                <label class="control-label" >Nome</label>
                                                <input type="text" id="name" name="name"  class="form-control" placeholder="Nome" minlength="4" maxlength="100" required >	
                                            </div>

                                            <div class="form-group col-md-4 col-sm-4 col-xs-12">
                                                <label class="control-label" >Email</label>
                                                <input type="email" id="email" name="email"  class="form-control" placeholder="Email" minlength="4" maxlength="100" required >	
                                            </div>

                                            <div class="form-group col-md-4 col-sm-4 col-xs-12">
                                                <label class="control-label" >Permissão</label>
                                                <select class="form-control" name="nivel" id="nivel" required>
                                                    <option value="">Selecione uma Permissão</option>
                                                    {{-- <option value="User">User</option>
                                                    <option value="Admin">Admin</option> --}}
                                                    <option value="Super-Admin">Super-Admin</option>
                                                    <option value="User">User</option>
                                                    
                                                </select>
                                            </div>
                                        </div>

                                    </div>

                                
    
                            
                                
                                <div class="clearfix"></div>
                                    <div class="ln_solid"> </div>
                                        <div class="footer text-right"> 
                                            <button hidden type="submit"></button>
                                            <button id="btn_cancelar" class="botoes-acao btn btn-round btn-warning" >
                                                <span class="icone-botoes-acao mdi mdi-backburger"></span>   
                                                <span class="texto-botoes-acao"> CANCELAR </span>
                                                <div class="ripple-container"></div>
                                            </button>
                                    
                                            <button type="submit" id="btn_salvar" class="botoes-acao btn btn-round btn-success ">
                                                <span class="icone-botoes-acao mdi mdi-send"></span>
                                                <span class="texto-botoes-acao"> SALVAR </span>
                                                <div class="ripple-container"></div>
                                            </button>
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

@endpush
