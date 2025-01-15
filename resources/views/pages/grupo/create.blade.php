@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
<link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet">
@section('content')
    @include('layouts.navbars.auth.topnav')

    @if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show d-flex justify-content-between align-items-sm-center" role="alert">
        <p class="text-white mb-0">{{ session('error') }}</p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <div class="container-fluid px-2">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-12 mb-lg-0 mb-4">
                    <div class="card mt-4">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-6 d-flex align-items-center">
                                    <h5 class="mb-0 text-uppercase">Cadastrar nova pessoa</h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <form action="{{ url('/grupo') }}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="d-flex justify-content-center mb-4">
                                            <img id="selectedAvatar" src="{{ asset('img/placeholder-avatar.jpg') }}"
                                                class="rounded-circle"
                                                style="width: 200px; height: 200px; object-fit: cover;"
                                                alt="example placeholder" />
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <div data-mdb-ripple-init class="btn btn-primary btn-rounded">
                                                <label class="form-label text-white m-1" for="customFile2">Escolher Foto</label>
                                                <input type="file" class="form-control d-none" name="foto" id="customFile2"
                                                    onchange="displaySelectedImage(event, 'selectedAvatar')" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-6 col-md-9">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="example-text-input" class="form-control-label">
                                                        <b style="color: red">*</b>
                                                        Nome</label>
                                                    <input class="form-control" value="{{ old('nome') }}" type="text"
                                                        id="nome" name="nome" required>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="example-text-input"
                                                        class="form-control-label">Apelido</label>
                                                    <input class="form-control" value="{{ old('apelido') }}" type="apelido"
                                                        name="apelido">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    {{-- <label for="example-text-input"
                                                        class="form-control-label">Sexo</label> --}}
                                                    {{-- <input class="form-control" value="{{ old('sexo') }}" type="sexo"
                                                        name="sexo"> --}}
                                                        <label for="example-text-input" class="form-control-label">Sexo</label>
                                                        <select name="sexo" id="sexo">
                                                            <option value="">Selecione uma opção</option>
                                                            <option value="Masculino">Masculino</option>
                                                            <option value="Feminino">Feminino</option>
                                                        </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="example-text-input" class="form-control-label">
                                                        Email</label>
                                                    <input class="form-control" value="{{ old('email') }}" type="email"
                                                        name="email">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="example-text-input" class="form-control-label">
                                                        <b style="color: red">*</b>
                                                        Celular</label>
                                                    <input class="form-control" value="{{ old('telefone') }}" type="text"
                                                        name="telefone" id="telefone" required>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="example-text-input" class="form-control-label">
                                                        Data de Nascimento</label>
                                                    <input class="form-control" value="{{ old('nascimento') }}" type="date"
                                                        name="nascimento" id="nascimento">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <h5 class="text-uppercase">Endereço</h5>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">CEP</label>
                                            <input class="form-control" value="{{ old('cep') }}" type="text"
                                                name="cep" id="cep" onblur="pesquisacep(this.value);">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Rua</label>
                                            <input class="form-control" value="{{ old('rua') }}" type="text"
                                                name="rua" id="rua" >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Municipio</label>
                                            <input class="form-control" value="{{ old('municipio') }}" type="text"
                                                name="municipio" id="municipio" >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Bairro</label>
                                            <input class="form-control" value="{{ old('bairro') }}" type="text"
                                                name="bairro" id="bairro" oninput="this.value = this.value.toUpperCase()" >
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Numero</label>
                                            <input class="form-control" value="{{ old('numero') }}" type="text"
                                                name="numero" name="numero">
                                        </div>
                                    </div>
                                </div>

                                <h5 class="text-uppercase">Outras Informações</h5>

                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label"><b style="color: red">*</b> Tipo</label>
                                            <select class="form-control" name="tipo" id="tipo" required>
                                                <option value="">Selecione uma opção</option>
                                                <option value="Lideranca">Liderança</option>
                                                <option value="Colaborador">Colaborador</option>
                                                <option value="Indeciso">Indeciso</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-5" id="showdivlider" style="display: none">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Liderança</label>
                                            <select name="lider_id" id="lider_id">
                                                <option value="">Selecione uma opção</option>
                                                @foreach ($lideres as $lider)
                                                    <option value="{{ $lider->id }}">{{ $lider->nome }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Zona</label>
                                            <input id="zona" class="form-control" value="{{ old('zona') }}" type="text"
                                                name="zona" name="zona">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Seção</label>
                                            <input id="secao" class="form-control" value="{{ old('secao') }}" type="text"
                                                name="secao" name="secao">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Facebook</label>
                                            <input class="form-control" value="{{ old('facebook') }}" type="text"
                                                name="facebook" name="facebook">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Instagram</label>
                                            <input class="form-control" value="{{ old('instagram') }}" type="text"
                                                name="instagram" name="instagram">
                                        </div>
                                    </div>

                                </div>

                                <div class="card-footer text-center">
                                    <button type="submit" id="btn_salvar" class="btn btn-primary">Enviar
                                        Inscrição</button>
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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
    <script src="{{ asset('assets/js/vanillaMasker.min.js') }}"></script>
    <script>
        VMasker($("#cep")).maskPattern("99999-999");
        VMasker($("#telefone")).maskPattern("(99)99999-9999");
        VMasker($("#zona")).maskPattern("9999");
        VMasker($("#secao")).maskPattern("9999");

        $("#tipo").on('change', function() {
            if (this.value == 'Colaborador') {
                document.getElementById('showdivlider').style.display = 'block';
                // document.getElementById('lider_id').setAttribute('required', 'required');
            } else {
                document.getElementById('showdivlider').style.display = 'none';
                // document.getElementById('lider_id').removeAttribute('required');
            }
        });

        new TomSelect("#lider_id", {
            create: false,
            sortField: {
                field: "text",
                direction: "asc"
            }
        });

        new TomSelect("#sexo", {
            create: false,
            sortField: {
                field: "text",
                direction: "asc"
            }
        });

        $(function() {
            $('body').submit(function(event) {
                if ($(this).hasClass('btn_salvar')) {
                    event.preventDefault();
                } else {
                    $(this).find(':submit').html('<i class="fa fa-spinner fa-spin"></i>');
                    $(this).addClass('btn_salvar');
                }
            });
            $("#btn_cancelar").click(function() {
                event.preventDefault();
                window.location.href = "{{ URL::route('grupo.index') }}";
            });
        });
    </script>
    <script>
        function limpa_formulário_cep() {
            document.getElementById('rua').value = ("");
            document.getElementById('bairro').value = ("");
            document.getElementById('municipio').value = ("");
        }

        function meu_callback(conteudo) {
            if (!("erro" in conteudo)) {
                document.getElementById('rua').value = (conteudo.logradouro);
                document.getElementById('bairro').value = (conteudo.bairro);
                document.getElementById('municipio').value = (conteudo.localidade);
            } //end if.
            else {
                //CEP não Encontrado.
                limpa_formulário_cep();
                alert("CEP não encontrado.");
            }
        }

        function pesquisacep(valor) {

            //Nova variável "cep" somente com dígitos.
            var cep = valor.replace(/\D/g, '');

            //Verifica se campo cep possui valor informado.
            if (cep != "") {

                //Expressão regular para validar o CEP.
                var validacep = /^[0-9]{8}$/;

                //Valida o formato do CEP.
                if (validacep.test(cep)) {

                    //Preenche os campos com "..." enquanto consulta webservice.
                    document.getElementById('rua').value = "...";
                    document.getElementById('bairro').value = "...";
                    document.getElementById('municipio').value = "...";

                    //Cria um elemento javascript.
                    var script = document.createElement('script');

                    //Sincroniza com o callback.
                    script.src = 'https://viacep.com.br/ws/' + cep + '/json/?callback=meu_callback';

                    //Insere script no documento e carrega o conteúdo.
                    document.body.appendChild(script);

                } //end if.
                else {
                    //cep é inválido.
                    limpa_formulário_cep();
                    alert("Formato de CEP inválido.");
                }
            } //end if.
            else {
                //cep sem valor
                limpa_formulário_cep();
            }
        };
    </script>

    <script>
        function displaySelectedImage(event, elementId) {
            const selectedImage = document.getElementById(elementId);
            const fileInput = event.target;

            if (fileInput.files && fileInput.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    selectedImage.src = e.target.result;
                };

                reader.readAsDataURL(fileInput.files[0]);
            }
        }
    </script>
@endpush
