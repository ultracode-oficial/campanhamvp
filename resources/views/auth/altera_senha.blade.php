@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
<link rel="stylesheet" href="assets/css/jquery.dataTables.min.css"> 
@section('content')
    @include('layouts.navbars.auth.topnav')
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-6 mb-lg-0 mb-4">
                <div class="card mt-4">
                    <div class="card-header pb-0 p-3">
                        <div class="row ">
                            <div class="d-flex align-items-center">
                                <h6 class="mb-0">Alterar senha</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        <form action="{{ url('salvasenha') }}" method="POST" class="form-horizontal">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="form-group">
                                    <label class="control-label">Senha Atual</label>
                                    <input type="password" id="password_atual" name="password_atual"  class="form-control" placeholder="Senha" minlength="4" maxlength="100" required >	
                                </div>
                            </div>
    
                            <div class="row">
                                <div class="form-group">
                                    <label class="control-label">Nova Senha</label>
                                    <input type="password" id="password" name="password"  class="form-control" placeholder="Nova Senha" minlength="4" maxlength="100" required >	
                                </div>
                            </div>
    
                            <div class="row">
                                <div class="form-group">
                                    <label class="control-label">Confirmação da Senha</label>
                                    <input type="password" id="password_confirmation" name="password_confirmation"  class="form-control" placeholder="Confirmação de Senha" minlength="4" maxlength="100" required >	
                                </div>
                            </div>
    
                            <div class="footer text-center"> {{-- col-md-3 col-md-offset-9 --}}
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

    
@endsection




