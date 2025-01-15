@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
<link rel="stylesheet" href="assets/css/jquery.dataTables.min.css">
<style>
    .telefone-duplicado {
    color: red;

}
</style>
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
                                <div class="col-6 text-end">
                                    <a href="#" class="btn bg-gradient-dark dropdown-toggle" style="margin-bottom: 0"
                                        data-bs-toggle="dropdown" id="navbarDropdownMenuLink2">
                                        Ações
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink2">
                                        <li>
                                            <a class="dropdown-item" id="import_excel">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    fill="currentColor" class="bi bi-file-earmark-arrow-up-fill"
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0M9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1M6.354 9.854a.5.5 0 0 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 8.707V12.5a.5.5 0 0 1-1 0V8.707z" />
                                                </svg>
                                                Importar Planilha
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{url('/grupo/export_excel')}}" target="_blank">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-file-earmark-arrow-down-fill" viewBox="0 0 16 16">
                                                    <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0M9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1m-1 4v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 0 1 .708-.708L7.5 11.293V7.5a.5.5 0 0 1 1 0"/>
                                                  </svg>                                               
                                                Exportar Planilha
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{asset('/docs/planilha-exemplo.xlsx')}}"> 
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-file-earmark-spreadsheet-fill" viewBox="0 0 16 16">
                                                    <path d="M6 12v-2h3v2z"/>
                                                    <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0M9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1M3 9h10v1h-3v2h3v1h-3v2H9v-2H6v2H5v-2H3v-1h2v-2H3z"/>
                                                  </svg>
                                                                                                 
                                                Planilha Modelo
                                            </a>
                                        </li>
                                    </ul>
                                    <a class="btn bg-gradient-dark mb-0" href="{{ url('grupo/create') }}"> Cadastrar nova
                                        Pessoa</a>
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
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Tipo</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Redes Sociais</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Ações</th>
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
                                                                <h6 class="mb-0 text-xs">{{ $individuo->nome }}</h6>
                                                                <p class="text-xs mb-0 {{ in_array($individuo->telefone, $telefonesDuplicados) ? 'telefone-duplicado' : '' }}">
                                                                    {{ $individuo->telefone }}
                                                                </p>
                                                                {{-- <p class="text-xs text-secondary mb-0">
                                                                    {{ $individuo->telefone }}</p> --}}
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p class="text-xs font-weight-bold mb-0">{{ $individuo->bairro }}
                                                        </p>
                                                        {{-- <p class="text-xs text-secondary mb-0">Organization</p> --}}
                                                    </td>
                                                    <td class="align-middle text-center text-sm">
                                                        {{-- <span class="text-secondary text-xs font-weight-bold">{{ $individuo->tipo }}</span> --}}
                                                        <span
                                                            class="text-xs font-weight-bold mb-0">{{ $individuo->tipo }} 
                                                            @if ($individuo->tipo == 'lideranca')
                                                                / ID: {{$individuo->id}}
                                                            @endif
                                                        </span>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <span class="text-secondary text-xs font-weight-bold">
                                                            @isset($individuo->facebook)
                                                                <a type="button"
                                                                href="https://www.facebook.com/{{ strpos($individuo->facebook, "@") === 0 ? str_replace("@", "", $individuo->facebook) : $individuo->facebook}}"
                                                                target="_blank" style="padding: 11px;"
                                                                    class="btn btn-facebook btn-icon-only rounded-circle">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                                                                        <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951"/>
                                                                      </svg>
                                                                    </a>
                                                            @endisset
                                                            @isset($individuo->instagram)
                                                                <a type="button"
                                                                    href="https://www.instagram.com/{{ strpos($individuo->instagram, "@") === 0 ? str_replace("@", "", $individuo->instagram) : $individuo->instagram}}"
                                                                    target="_blank" style="padding: 11px;"
                                                                    class="btn btn-instagram btn-icon-only rounded-circle">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                                                                        <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334"/>
                                                                      </svg>
                                                                    </a>
                                                            @endisset
                                                            @isset($individuo->telefone)
                                                                <a type="button"
                                                                    href="https://wa.me/55{{ $individuo->telefone }}"
                                                                    target="_blank" style="padding: 11px;"
                                                                    class="btn btn-slack btn-icon-only rounded-circle">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                                                                        <path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232"/>
                                                                      </svg>
                                                                </a>
                                                            @endisset
                                                        </span>
                                                    </td>
                                                    <td class="align-middle  text-center">
                                                        @if (Auth::user()->nivel == 'Super-Admin')
                                                            <a id="btn_editar_pessoa"
                                                                class="btn btn-warning btn-xs action botao_acao btn_vizualiza"
                                                                href="{{ url("/grupo/$individuo->id/edit") }}"
                                                                title="Edita Pessoa">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                                    <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z"/>
                                                                  </svg>
                                                            </a>

                                                            <a class="btn btn-info btn-xs action botao_acao"
                                                                href="{{ url("/servicogrupoindex/$individuo->id")}}"
                                                                data-placement="bottom" title="Serviços">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-folder-plus" viewBox="0 0 16 16">
                                                                    <path d="m.5 3 .04.87a2 2 0 0 0-.342 1.311l.637 7A2 2 0 0 0 2.826 14H9v-1H2.826a1 1 0 0 1-.995-.91l-.637-7A1 1 0 0 1 2.19 4h11.62a1 1 0 0 1 .996 1.09L14.54 8h1.005l.256-2.819A2 2 0 0 0 13.81 3H9.828a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 6.172 1H2.5a2 2 0 0 0-2 2m5.672-1a1 1 0 0 1 .707.293L7.586 3H2.19q-.362.002-.683.12L1.5 2.98a1 1 0 0 1 1-.98z"/>
                                                                    <path d="M13.5 9a.5.5 0 0 1 .5.5V11h1.5a.5.5 0 1 1 0 1H14v1.5a.5.5 0 1 1-1 0V12h-1.5a.5.5 0 0 1 0-1H13V9.5a.5.5 0 0 1 .5-.5"/>
                                                                  </svg>
                                                            </a>

                                                            <a class="btn btn-danger btn-xs action botao_acao btn_delete"
                                                                data-delete="{{ $individuo->id }}" data-toggle="tooltip"
                                                                data-placement="bottom" title="Deletar Pessoa">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/>
                                                                  </svg>
                                                            </a>

                                                        @elseif (Auth::user()->nivel == 'User')
                                                            <a id="btn_editar_pessoa"
                                                                class="btn btn-warning btn-xs action botao_acao btn_vizualiza"
                                                                href="{{ url("/grupo/$individuo->id/edit") }}"
                                                                title="Edita Pessoa">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                                    <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z"/>
                                                                  </svg>
                                                            </a>
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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        var myTable = $("#myTable").DataTable({
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
    <script type="text/javascript">
        $(document).ready(function() {
            $("body").on("click", "a.btn_delete", function(e) {
                // Evitar que a página seja recarregada	
                e.preventDefault();
                let id = $(this).data('delete');

                swal({
                    title: "Atenção!",
                    text: 'Você esta prestes a EXCLUIR um Colaborador',
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
                        $.post("{{ url('/grupo') }}/" + id, {
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

        const fileInput = document.createElement("input");
        fileInput.type = "file";
        fileInput.accept = "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet";
        fileInput.style.visibility = "hidden";
        fileInput.style.position = "absolute";

        const fileName = document.createElement("span");

        const wrappingDiv = document.createElement("div");
        wrappingDiv.style.display = "flex";
        wrappingDiv.style.flexDirection = "column";

        const wrappingLabel = document.createElement("label");
        wrappingLabel.title = "Selecione um arquivo...";
        wrappingLabel.classList.add("btn", "bg-gradient-dark");
        wrappingLabel.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-file-earmark-arrow-up-fill" viewBox="0 0 16 16">
            <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0M9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1M6.354 9.854a.5.5 0 0 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 8.707V12.5a.5.5 0 0 1-1 0V8.707z"/>
            </svg>
        Selecione um arquivo`;

        fileInput.addEventListener("input", (e) => {
            if (!e.target.files[0]) return;
            fileName.textContent = e.target.files[0].name;
        });
        wrappingLabel.append(fileInput);

      

        wrappingDiv.append(wrappingLabel, fileName);

        $(document).on('click', '#import_excel', async function(e) {
            fileName.textContent = "";
            const dialogRes = await swal({
                text: "Importar Tabela Excel",
                content: wrappingDiv,
                buttons: {
                    ok: {
                        text: "Enviar",
                        visible: true,
                        closeModal: false,
                        value: "ok"
                    },
                    cancel: {
                        text: "Cancelar",
                        visible: true,
                        closeModal: true,
                        value: "cancel"
                    },
                }
            })

            if (dialogRes === "cancel") return;

            if (!fileInput.files[0]) return;

            const formData = new FormData();
            formData.append("excel_file", fileInput.files[0]);
            formData.append("_token", "{{ csrf_token() }}");

            try {
                const res = await fetch("{{ url('/grupo/import_excel') }}", {
                    method: "POST",
                    body: formData,
                    headers: {
                        "Accept": "application/json"
                    }
                });

                if (!res.ok) {
                    const err = await res.json();
                    throw err;
                }

                const data = await res.json();

                swal("Sucesso!", "Registros importados com sucesso.", "success");
                setTimeout(() => {
                    window.location.replace("/grupo");
                }, 1200);

            } catch (error) {
                console.error(error.message);
                fileInput.value = null;
                swal("Erro!", error.message, "error");
            }
        });
    </script>
@endpush
