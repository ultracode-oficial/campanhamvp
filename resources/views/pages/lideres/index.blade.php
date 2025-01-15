@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@push('css')
<style>
    .row {
        --bs-gutter-y: 1.5rem;
    }
    .avatar-container {
        margin: 0 auto;
        background-color: #16A34A;
        padding: 3px;
        border-radius: 999px;
    }
    .lider-avatar {
        border-radius: 999px;
        border: 4px solid #fff;
    }
    .nome {
        font-size: 16px;
        font-weight: bold;
        color: #344767;
        margin: 0;
    }
    .apelido {
        font-size: 16px;
        color: #344767;
        margin: 0;
    }
    .contagem-colaboradores {
        background-image: linear-gradient(310deg, #1171ef, #11cdef);
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        color: #11cdef;
        font-size: 14px;
        font-weight: 400;
        margin: 0;
    }
    .bairro {
        color: rgb(103, 116, 142);
        font-weight: 400;
        margin: 0;
        margin-top: 12px;
        font-size: 14px;
        text-transform: uppercase;
    }
    .links {
        margin-top: 12px;
        display: flex;
        justify-content: center;
        gap: 16px;
        font-size: 1.5rem;
    }
    .lider-card.lider-card {
        padding: 20px;
        box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
    }
    .lider-info.lider-info {
        margin-top: 12px;
        padding: 0;
    }
</style>
@endpush
@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Grupo'])
    <div class="container-fluid px-2">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-12 mb-lg-0 mb-4">
                    <div class="card mt-4">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-3 d-flex align-items-center">
                                    <h6 class="mb-0">Lideranças</h6>
                                </div>
                                <div class="col-9 text-right">
                                    <input type="text" id="searchInput" class="form-control" placeholder="Procurar Lider...">
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <div class="col-md-12">
                                <div class="row" id="liderContainer">
                                    @foreach ($lideres as $lider)
                                        @php
                                            $totalPessoas = 0;
                                            foreach ($pessoas as $pessoa) {
                                                if ($pessoa->lider_id == $lider->id) {
                                                    $totalPessoas++;
                                                }
                                            }
                                        @endphp
                                        <div class="col-md-3 col-sm-12 lider-card-item">
                                            <div class="card lider-card">
                                                <div class="card card-plain text-center">
                                                    <div class="avatar-container">
                                                        @if (isset($lider->foto))
                                                            <img width="100" height="100" class="lider-avatar" src="{{ $path_file_storage . $lider->foto }}">
                                                        @else
                                                            <img width="100" height="100" class="lider-avatar" src="{{ asset('img/placeholder-avatar.jpg') }}">
                                                        @endif
                                                    </div>
                                                    <div class="card-body lider-info">
                                                        @php
                                                            $nomes = explode(' ', $lider->nome);
                                                            $resto_nome = count($nomes) === 1 ? "" : (count($nomes) > 2 ? (strlen($nomes[1]) <= 2 ? "{$nomes[1]} {$nomes[2]}" : $nomes[1]) : $nomes[1]);
                                                            $apelido = strlen($lider->apelido) > 0 ? " \"{$lider->apelido}\" " : " ";
                                                            $nome_formatado = "{$nomes[0]}{$apelido}{$resto_nome}";
                                                        @endphp
                                                        <h5 class="nome">{{ $nome_formatado }}</h5>
                                                        <h6 class="contagem-colaboradores">Colaboradores: {{ $totalPessoas }}</h6>
                                                        <p class="bairro">{{ $lider->bairro }}</p>
                                                        <div class="links">
                                                            <a href="{{ url("/colaboradores/$lider->id") }}" title='Lista de Colaboradores'>
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                                                                    <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5"/>
                                                                </svg>
                                                            </a>
                                                            <a target="_blank" href="{{ route('gerar.token', $lider->id) }}" title='Enviar link para Liderança'>
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                                                                    <path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232"/>
                                                                </svg>
                                                            </a>
                                                            <a href="{{ url("/mapacolaboradores/$lider->id")}}" title='Mapa da Liderança'>
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
                                                                    <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A32 32 0 0 1 8 14.58a32 32 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10"/>
                                                                    <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4m0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                                                                </svg>
                                                            </a>
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
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const liderCards = document.querySelectorAll('.lider-card-item');

            searchInput.addEventListener('input', function() {
                const query = this.value.toLowerCase();

                liderCards.forEach(function(card) {
                    const nome = card.querySelector('.nome').textContent.toLowerCase();
                    if (nome.includes(query)) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });
    </script>
@endpush
