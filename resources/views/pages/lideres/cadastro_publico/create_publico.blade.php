<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/uc-logo256.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('img/uc-logo256.png') }}">
    <title>
        Minha Campanha
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    {{-- https://bootstrapr.io/bs3/web-fonts-fontawesome.html --}}

    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- CSS Files -->

    <link id="pagestyle" href="{{ asset('assets/css/argon-dashboard.css') }}" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-gradient-dark z-index-3 py-3">
        <div class="col-md-12">
            <h1 class="text-center" style="color: white;">CADASTRO DE NOVA LIDERANÇA</h1>
        </div>
        </div>
    </nav>
    <div id="alert" class="pt-2">
        @if (session('sucesso'))
            <div class="alert alert-success alert-dismissible fade show d-flex justify-content-between align-items-sm-center" role="alert">
                <p class="text-white mb-0">{{ session('sucesso') }}</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show d-flex justify-content-between align-items-sm-center" role="alert">
            <p class="text-white mb-0">{{ session('error') }}</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-12 mb-lg-0 mb-4">
                    <div class="card mt-4">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-6 d-flex align-items-center">
                                    {{-- <h5 class="mb-0 text-uppercase">Cadastrar novo Colaborador</h5> --}}
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <form action="{{ url('/storalideranca') }}" method="post" enctype="multipart/form-data">
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
                                                <label class="form-label text-white m-1" for="customFile2">Escolher
                                                    Foto</label>
                                                <input type="file" class="form-control d-none" name="foto"
                                                    id="customFile2"
                                                    onchange="displaySelectedImage(event, 'selectedAvatar')" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-6 col-md-9">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="example-text-input" class="form-control-label">*
                                                        Nome</label>
                                                    <input class="form-control" value="{{ old('nome') }}"
                                                        type="text" id="nome" name="nome" required>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="example-text-input"
                                                        class="form-control-label">Apelido</label>
                                                    <input class="form-control" value="{{ old('apelido') }}"
                                                        type="apelido" name="apelido">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    {{-- <label for="example-text-input"
                                                        class="form-control-label">Sexo</label> --}}
                                                    {{-- <input class="form-control" value="{{ old('sexo') }}" type="sexo"
                                                        name="sexo"> --}}
                                                        <label for="example-text-input" class="form-control-label">Sexo</label>
                                                        <select class="form-control" name="sexo" id="sexo">
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
                                                    <input class="form-control" value="{{ old('email') }}"
                                                        type="email" name="email">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="example-text-input" class="form-control-label">*
                                                        Celular</label>
                                                    <input class="form-control" value="{{ old('telefone') }}"
                                                        type="text" name="telefone" id="telefone" required>
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
                                            <label for="example-text-input" class="form-control-label"> Rua</label>
                                            <input class="form-control" value="{{ old('rua') }}" type="text"
                                                name="rua" id="rua">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">
                                                Municipio</label>
                                            <input class="form-control" value="{{ old('municipio') }}"
                                                type="text" name="municipio" id="municipio">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">
                                                Bairro</label>
                                            <input class="form-control" value="{{ old('bairro') }}" type="text"
                                                name="bairro" id="bairro"
                                                oninput="this.value = this.value.toUpperCase()">
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
                                            <label for="example-text-input" class="form-control-label">Zona</label>
                                            <input class="form-control" value="{{ old('zona') }}" type="text"
                                                name="zona" name="zona">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Seção</label>
                                            <input class="form-control" value="{{ old('secao') }}" type="text"
                                                name="secao" name="secao">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="example-text-input"
                                                class="form-control-label">Facebook</label>
                                            <input class="form-control" value="{{ old('facebook') }}" type="text"
                                                name="facebook" name="facebook">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="example-text-input"
                                                class="form-control-label">Instagram</label>
                                            <input class="form-control" value="{{ old('instagram') }}"
                                                type="text" name="instagram" name="instagram"
                                                placeholder="@exemplo">
                                        </div>
                                    </div>

                                </div>

                                <div class="card-footer text-center">
                                    <button type="submit" id="btn_salvar" class="btn btn-primary">Enviar
                                        Registro</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{asset('assets/js/jquery-3.7.1.min.js')}}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
    <script src="{{ asset('assets/js/vanillaMasker.min.js') }}"></script>
    <script>
        VMasker($("#cep")).maskPattern("99999-999");
        VMasker($("#telefone")).maskPattern("(99)99999-9999");

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

        $(function() {
            $('body').submit(function(event) {
                if ($(this).hasClass('btn_salvar')) {
                    event.preventDefault();
                } else {
                    $(this).find(':submit').html('<i class="fa fa-spinner fa-spin"></i>');
                    $(this).addClass('btn_salvar');
                }
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



    <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/argon-dashboard.js') }}"></script>

</body>

</html>
