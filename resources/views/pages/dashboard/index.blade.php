@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@push('css')
    <link rel="stylesheet" href="assets/css/jquery.dataTables.min.css">
    <style>
        .custom-card-shadow {
            box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
        }

        #map {
            width: 100%;
            height: 100%;
            border-radius: 16px;
        }

        .marker-pessoa {
            border-radius: 999px;
            border: 2px solid white;
        }

        .leaflet-popup-content.leaflet-popup-content {
            margin: 0;
            padding: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 450px;
        }

        .leaflet-popup-content.leaflet-popup-content p {
            margin: 0;
        }

        /* .popup {
                display: flex;
                flex-direction: column;
                align-items: center;
                gap: 4px;
            } */

        .popup img {
            border-radius: 999px;
        }

        .popup-nome {
            text-align: center;
            margin: 0;
            font-weight: bold;
            color: #555;
            font-weight: 600;
            font-size: 18px;
        }

        .popup-tipo {
            text-align: center;
            font-size: 16px;
            margin: 0;
            color: #fff;
            font-weight: 600;
            border-radius: 4px;
            background-color: #333;
            padding: 2px 8px;
            width: 100%;
        }

        .marker-pessoa.lideranca {
            box-shadow: 0 0 0 2px #16A34A;
        }

        .marker-pessoa.colaborador {
            box-shadow: 0 0 0 2px #14B8A6;
        }

        .marker-pessoa.indeciso {
            box-shadow: 0 0 0 2px #666;
        }

        .popup-tipo.lideranca {
            background-color: #16A34A;
        }

        .popup-tipo.colaborador {
            background-color: #14B8A6;
        }

        .popup-tipo.indeciso {
            background-color: #333;
        }


        .ranking {
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
        }

        .rank-item {
            display: flex;
            align-items: center;
            box-shadow: rgba(0, 0, 0, 0.16) 0px 2px 3px;
            border-radius: 16px;
            padding: 0.9rem;
        }

        .rank-position {
            font-size: 2.5rem;
            font-weight: bold;
            color: #344767;
            margin-right: 1rem;
        }

        .rank-photo {
            margin-right: 1rem;
            border: 4px solid #16A34A;
            border-radius: 999px;
        }

        .rank-photo img {
            width: 92px;
            height: 92px;
            border-radius: 999px;
            border: 4px solid white;
            object-fit: cover;
        }

        .rank-content {
            flex-grow: 1;
        }

        .rank-name {
            font-size: 1.25rem;
            font-weight: bold;
            color: #344767;
        }

        .rank-location {
            color: #67748E;
            font-weight: normal;
            text-transform: uppercase;
            font-size: 0.9rem;
        }

        .rank-bar {
            display: flex;
            align-items: center;
            margin-top: 0.5rem;
            background-color: #f0f0f0;
            border-radius: 4px;
            overflow: hidden;
            position: relative;
        }

        .rank-progress {
            background-color: #16A34A;
            height: 1.6rem;
        }

        .rank-count {
            margin-left: 0.5rem;
            position: absolute;
            right: 10px;
            color: white;
            font-weight: bold;
        }

        .rank-progress-accent {
            color: #555;
        }

        .popup {
            width: 400px !important;
            height: 320px !important;
            overflow-y: auto;
        }

        .popup-tipo {
            margin: 0;
            padding: 5px;
        }

        .popup-tabela {
            width: 100%;
            border-collapse: collapse;
        }

        .popup-tabela th,
        .popup-tabela td {
            border: 1px solid #ccc;
            padding: 5px;
            text-align: left;
        }

        .popup-tabela th {
            background-color: #f4f4f4;
        }

        .popup-tabela td div {
            margin-bottom: 2px;
        }
    </style>
@endpush
@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Home'])

    <div class="container-fluid px-2">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-12 mb-lg-0 mb-4">
                    <div class="card mt-4">
                        <div class="card-body p-3">
                            <div class="col-md-12">
                                <!-- Abas -->
                                <ul class="nav nav-tabs">

                                    @if (Auth::user()->nivel == 'Super-Admin')
                                        <li class="nav-item">
                                            <a class="nav-link active" data-bs-toggle="tab" href="#locais-de-votacao">Locais de
                                                Votação</a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#secoes-eleitorais">Seções
                                                Eleitorais</a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#liderancas">Lideranças</a>
                                        </li>
    
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#grupo">Grupo</a>
                                        </li>
                                    @else

                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#liderancas">Lideranças</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#grupo">Grupo</a>
                                    </li>
                                    @endif
                                </ul>
                                <!-- Conteúdo das Abas -->
                                <div class="tab-content">
                                    <!-- zonas eleitorais -->
                                    @if (Auth::user()->nivel == 'Super-Admin')
                                        <div class="tab-pane active" id="locais-de-votacao">
                                    @else
                                        <div class="tab-pane" id="locais-de-votacao">
                                    @endif
                                        <div class="card mt-2 shadow-none">
                                            <div class="row">
                                                <div class="container-fluid">
                                                    <div id="map" style="min-height: calc(100vh - 204px);"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- seções eleitorais -->
                                    <div class="tab-pane p-0 fade" id="secoes-eleitorais">
                                    
                                        <div style="padding-top:1%">
                                            Informações retiradas do site oficial do TRE, <a target="_blank" href="https://www.tre-rj.jus.br/eleicoes/estatisticas-do-eleitorado-tre-rj/estatisticas-do-eleitorado-tre-rj">Clique Aqui para consultar</a>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card shadow-none mt-3">
                                                    <div class="card-body p-0">
                                                        <div class="card" style="padding: 16px;">
                                                            <div class="table-responsive">
                                                                <table id="myTable" class="table align-items-center mb-0">
                                                                    <thead>
                                                                        <tr>
                                                                            <th
                                                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                                                Zona</th>
                                                                            <th
                                                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                                                Seção</th>
                                                                            <th
                                                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                                                Total de Pessoas</th>

                                                                            <th
                                                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                                                Eleitores Aptos (Julho 2024)</th>
                                                                            <th
                                                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                                                Local</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($secoes_eleitorais as $secao)
                                                                            <tr>
                                                                                <td>
                                                                                    <p
                                                                                        class="text-xs font-weight-bold mb-0">
                                                                                        {{ $secao->zona }}
                                                                                    </p>
                                                                                </td>
                                                                                <td>
                                                                                    <p
                                                                                        class="text-xs font-weight-bold mb-0">
                                                                                        {{ $secao->secao }}
                                                                                    </p>
                                                                                </td>
                                                                                <td
                                                                                    class="align-middle text-sm">
                                                                                    <span
                                                                                        class="text-xs font-weight-bold mb-0">{{ count($secao->grupos) }}</span>
                                                                                </td>
                                                                                <td>
                                                                                    <p
                                                                                        class="text-xs font-weight-bold mb-0">
                                                                                        {{ $secao->eleitores_aptos }}
                                                                                    </p>
                                                                                </td>
                                                                                <td class="align-middle text-center">
                                                                                    @if (isset($secao->local->nome_local))
                                                                                        <span
                                                                                            class="text-secondary text-xs font-weight-bold">{{ $secao->local->nome_local }}</span>
                                                                                    @else
                                                                                        <span
                                                                                            class="text-secondary text-xs font-weight-bold"><b
                                                                                                hidden>ZZ</b> LOCAL NÃO
                                                                                            ENCONTRADO</span>
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
                                    <!-- liderancas -->
                                    @if (Auth::user()->nivel == 'User')
                                        <div class="tab-pane active" id="liderancas">
                                    @else
                                        <div class="tab-pane p-0 fade" id="liderancas">
                                    @endif
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card shadow-none mt-3">
                                                    <div class="card-body p-0">
                                                        <!-- New ranking structure -->
                                                        <div class="ranking">
                                                            @foreach ($lideres as $index => $lider)
                                                                <div class="rank-item">
                                                                    <div class="rank-position">#{{ $index + 1 }}</div>
                                                                    <div class="rank-photo">
                                                                        <img src="{{ asset('img/placeholder-avatar.jpg') }}"
                                                                            alt="Leader Photo">
                                                                    </div>
                                                                    <div class="rank-content">
                                                                        <div class="rank-name">{{ $lider->lider_nome }}
                                                                        </div>
                                                                        <div class="rank-location">{{ $lider->bairro }}
                                                                        </div>
                                                                        <div class="rank-bar">
                                                                            <div class="rank-progress"
                                                                                style="width: {{ ($lider->qtd_colaboradores / $max_colaboradores) * 100 }}%;">
                                                                            </div>
                                                                            <span
                                                                                class="rank-count {{ ($lider->qtd_colaboradores / $max_colaboradores) * 100 <= 80 ? 'rank-progress-accent' : 'text-white' }}">Colaboradores:
                                                                                {{ $lider->qtd_colaboradores }}</span>
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
                                    <!-- grupo -->
                                    <div class="tab-pane fade p-0" id="grupo">
                                        <div class="mt-3">
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="card custom-card-shadow p-3">
                                                        <center>Total de Pessoas por Bairro</center>
                                                        <canvas id="myChart"></canvas>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="card custom-card-shadow p-3">
                                                        <center>Total de Lideranças por Bairro</center>
                                                        <canvas id="myChart1"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="card custom-card-shadow p-3">
                                                        <center>Total de Colaboradores por Bairro</center>
                                                        <canvas id="myChart2"></canvas>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="card custom-card-shadow p-3">
                                                        <center>Total de Indecisos por Bairro</center>
                                                        <canvas id="myChart3"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="card custom-card-shadow p-3">
                                                        <center>Lideranças por Sexo</center>
                                                        <canvas id="myChart5"></canvas>
                                                    </div>
                                                </div>
                                            
                                                <div class="col-md-6">
                                                    <div class="card custom-card-shadow p-3">
                                                        <center>Colaboradores por Sexo</center>
                                                        <canvas id="myChart6"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="card custom-card-shadow p-3">
                                                        <center>Idade dos Colaboradores</center>
                                                        <canvas id="myChart4"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                <!-- Fim do Conteúdo das Abas -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
    <script defer>
        const polygons = [{
                coords: [{
                        lng: -43.4447074,
                        lat: -22.7744091
                    },
                    {
                        lng: -43.4444465,
                        lat: -22.7747211
                    },
                    {
                        lng: -43.4436144,
                        lat: -22.7747612
                    },
                    {
                        lng: -43.4432576,
                        lat: -22.7751487
                    },
                    {
                        lng: -43.4429304,
                        lat: -22.7769866
                    },
                    {
                        lng: -43.4426788,
                        lat: -22.7775244
                    },
                    {
                        lng: -43.4425295,
                        lat: -22.7778341
                    },
                    {
                        lng: -43.4423102,
                        lat: -22.7780416
                    },
                    {
                        lng: -43.4422724,
                        lat: -22.7781857
                    },
                    {
                        lng: -43.4421232,
                        lat: -22.7783052
                    },
                    {
                        lng: -43.4419282,
                        lat: -22.7784168
                    },
                    {
                        lng: -43.4416934,
                        lat: -22.7787751
                    },
                    {
                        lng: -43.4415968,
                        lat: -22.7789523
                    },
                    {
                        lng: -43.4411741,
                        lat: -22.7796768
                    },
                    {
                        lng: -43.4409345,
                        lat: -22.7799823
                    },
                    {
                        lng: -43.4404827,
                        lat: -22.7803637
                    },
                    {
                        lng: -43.440161,
                        lat: -22.7806033
                    },
                    {
                        lng: -43.439818,
                        lat: -22.7807532
                    },
                    {
                        lng: -43.4394916,
                        lat: -22.7808939
                    },
                    {
                        lng: -43.4392577,
                        lat: -22.7809744
                    },
                    {
                        lng: -43.4392383,
                        lat: -22.7812316
                    },
                    {
                        lng: -43.4391539,
                        lat: -22.7815412
                    },
                    {
                        lng: -43.4390679,
                        lat: -22.7817051
                    },
                    {
                        lng: -43.4388419,
                        lat: -22.7822408
                    },
                    {
                        lng: -43.4387533,
                        lat: -22.7825519
                    },
                    {
                        lng: -43.4385676,
                        lat: -22.7831051
                    },
                    {
                        lng: -43.4377184,
                        lat: -22.7836915
                    },
                    {
                        lng: -43.4377288,
                        lat: -22.7837837
                    },
                    {
                        lng: -43.437744,
                        lat: -22.7839196
                    },
                    {
                        lng: -43.4379563,
                        lat: -22.7840946
                    },
                    {
                        lng: -43.4382472,
                        lat: -22.7841821
                    },
                    {
                        lng: -43.4376726,
                        lat: -22.7847276
                    },
                    {
                        lng: -43.4373387,
                        lat: -22.7850415
                    },
                    {
                        lng: -43.437258,
                        lat: -22.7851176
                    },
                    {
                        lng: -43.4369212,
                        lat: -22.7851403
                    },
                    {
                        lng: -43.436505,
                        lat: -22.7852464
                    },
                    {
                        lng: -43.4360863,
                        lat: -22.7853705
                    },
                    {
                        lng: -43.4359628,
                        lat: -22.7853696
                    },
                    {
                        lng: -43.4358766,
                        lat: -22.7854078
                    },
                    {
                        lng: -43.4357795,
                        lat: -22.7853713
                    },
                    {
                        lng: -43.435517,
                        lat: -22.7856192
                    },
                    {
                        lng: -43.4354296,
                        lat: -22.7857132
                    },
                    {
                        lng: -43.4348358,
                        lat: -22.7857593
                    },
                    {
                        lng: -43.4337807,
                        lat: -22.7858384
                    },
                    {
                        lng: -43.4330812,
                        lat: -22.7841006
                    },
                    {
                        lng: -43.4332936,
                        lat: -22.7835793
                    },
                    {
                        lng: -43.4334508,
                        lat: -22.7832369
                    },
                    {
                        lng: -43.4335926,
                        lat: -22.7828076
                    },
                    {
                        lng: -43.4337604,
                        lat: -22.7826854
                    },
                    {
                        lng: -43.4336141,
                        lat: -22.7825222
                    },
                    {
                        lng: -43.4334098,
                        lat: -22.7820678
                    },
                    {
                        lng: -43.433305,
                        lat: -22.7817212
                    },
                    {
                        lng: -43.4333445,
                        lat: -22.7816389
                    },
                    {
                        lng: -43.4333952,
                        lat: -22.7815852
                    },
                    {
                        lng: -43.4332226,
                        lat: -22.7814433
                    },
                    {
                        lng: -43.433213,
                        lat: -22.7813643
                    },
                    {
                        lng: -43.4332301,
                        lat: -22.7810402
                    },
                    {
                        lng: -43.4333259,
                        lat: -22.7805398
                    },
                    {
                        lng: -43.4334908,
                        lat: -22.780249
                    },
                    {
                        lng: -43.433854,
                        lat: -22.7801196
                    },
                    {
                        lng: -43.4344508,
                        lat: -22.7800331
                    },
                    {
                        lng: -43.4350169,
                        lat: -22.7799792
                    },
                    {
                        lng: -43.4350911,
                        lat: -22.7800163
                    },
                    {
                        lng: -43.4351632,
                        lat: -22.780298
                    },
                    {
                        lng: -43.4360425,
                        lat: -22.7807271
                    },
                    {
                        lng: -43.4361675,
                        lat: -22.7812814
                    },
                    {
                        lng: -43.4364086,
                        lat: -22.7817861
                    },
                    {
                        lng: -43.4365691,
                        lat: -22.7819991
                    },
                    {
                        lng: -43.4365584,
                        lat: -22.7819043
                    },
                    {
                        lng: -43.4366602,
                        lat: -22.7819115
                    },
                    {
                        lng: -43.4369285,
                        lat: -22.7817427
                    },
                    {
                        lng: -43.437062,
                        lat: -22.7815319
                    },
                    {
                        lng: -43.4370672,
                        lat: -22.7813493
                    },
                    {
                        lng: -43.4370399,
                        lat: -22.7811292
                    },
                    {
                        lng: -43.4379679,
                        lat: -22.7808805
                    },
                    {
                        lng: -43.4379907,
                        lat: -22.7804501
                    },
                    {
                        lng: -43.4380886,
                        lat: -22.7803372
                    },
                    {
                        lng: -43.4381968,
                        lat: -22.7803497
                    },
                    {
                        lng: -43.4385295,
                        lat: -22.780373
                    },
                    {
                        lng: -43.4389622,
                        lat: -22.780285
                    },
                    {
                        lng: -43.4396286,
                        lat: -22.7798653
                    },
                    {
                        lng: -43.439734,
                        lat: -22.779604
                    },
                    {
                        lng: -43.4396748,
                        lat: -22.7795067
                    },
                    {
                        lng: -43.4396971,
                        lat: -22.7793588
                    },
                    {
                        lng: -43.4398033,
                        lat: -22.7791604
                    },
                    {
                        lng: -43.4409943,
                        lat: -22.777886
                    },
                    {
                        lng: -43.4412447,
                        lat: -22.777806
                    },
                    {
                        lng: -43.4413844,
                        lat: -22.7776485
                    },
                    {
                        lng: -43.4414714,
                        lat: -22.7773015
                    },
                    {
                        lng: -43.4414732,
                        lat: -22.776853
                    },
                    {
                        lng: -43.4400723,
                        lat: -22.7779365
                    },
                    {
                        lng: -43.4396249,
                        lat: -22.7774199
                    },
                    {
                        lng: -43.4406352,
                        lat: -22.7764181
                    },
                    {
                        lng: -43.4411348,
                        lat: -22.7757542
                    },
                    {
                        lng: -43.4417565,
                        lat: -22.7748251
                    },
                    {
                        lng: -43.4420045,
                        lat: -22.7744708
                    },
                    {
                        lng: -43.4425147,
                        lat: -22.7741405
                    },
                    {
                        lng: -43.4429708,
                        lat: -22.7740298
                    },
                    {
                        lng: -43.4431307,
                        lat: -22.7740059
                    },
                    {
                        lng: -43.4434852,
                        lat: -22.7739093
                    },
                    {
                        lng: -43.4443062,
                        lat: -22.7740829
                    },
                    {
                        lng: -43.4446212,
                        lat: -22.7743423
                    },
                    {
                        lng: -43.4446518,
                        lat: -22.7743676
                    },
                    {
                        lng: -43.4446587,
                        lat: -22.7743732
                    },
                    {
                        lng: -43.4447074,
                        lat: -22.7744091
                    },
                ],
                strokeColor: "#32a852",
                fillColor: "#32a852"
            },
            {
                coords: [{
                        lng: -43.4061025,
                        lat: -22.7778181
                    },
                    {
                        lng: -43.4042946,
                        lat: -22.7793916
                    },
                    {
                        lng: -43.4036014,
                        lat: -22.7799909
                    },
                    {
                        lng: -43.4033208,
                        lat: -22.7802369
                    },
                    {
                        lng: -43.4029006,
                        lat: -22.780847
                    },
                    {
                        lng: -43.4027947,
                        lat: -22.7810227
                    },
                    {
                        lng: -43.4026257,
                        lat: -22.7815424
                    },
                    {
                        lng: -43.4024153,
                        lat: -22.7823886
                    },
                    {
                        lng: -43.4023567,
                        lat: -22.7826189
                    },
                    {
                        lng: -43.4022775,
                        lat: -22.7825987
                    },
                    {
                        lng: -43.4022547,
                        lat: -22.7825929
                    },
                    {
                        lng: -43.4020892,
                        lat: -22.7824458
                    },
                    {
                        lng: -43.4015459,
                        lat: -22.7818688
                    },
                    {
                        lng: -43.4013883,
                        lat: -22.7817118
                    },
                    {
                        lng: -43.4009736,
                        lat: -22.7812985
                    },
                    {
                        lng: -43.4006678,
                        lat: -22.7809938
                    },
                    {
                        lng: -43.4005998,
                        lat: -22.780926
                    },
                    {
                        lng: -43.4000649,
                        lat: -22.780393
                    },
                    {
                        lng: -43.3997648,
                        lat: -22.780094
                    },
                    {
                        lng: -43.3992569,
                        lat: -22.7795879
                    },
                    {
                        lng: -43.3990317,
                        lat: -22.7793635
                    },
                    {
                        lng: -43.398799,
                        lat: -22.7791316
                    },
                    {
                        lng: -43.3987887,
                        lat: -22.7791223
                    },
                    {
                        lng: -43.3984354,
                        lat: -22.778802
                    },
                    {
                        lng: -43.3983998,
                        lat: -22.7787698
                    },
                    {
                        lng: -43.3983122,
                        lat: -22.7786903
                    },
                    {
                        lng: -43.397415,
                        lat: -22.7778488
                    },
                    {
                        lng: -43.397308,
                        lat: -22.7777491
                    },
                    {
                        lng: -43.397281,
                        lat: -22.7777239
                    },
                    {
                        lng: -43.3971869,
                        lat: -22.7776362
                    },
                    {
                        lng: -43.3971423,
                        lat: -22.7775945
                    },
                    {
                        lng: -43.400399,
                        lat: -22.7753182
                    },
                    {
                        lng: -43.4021791,
                        lat: -22.774074
                    },
                    {
                        lng: -43.4061025,
                        lat: -22.7778181
                    },
                ],
                strokeColor: "#a63f33",
                fillColor: "#a63f33"
            },
            {
                coords: [

                    {
                        lng: -43.4191179,
                        lat: -22.78177
                    },
                    {
                        lng: -43.4187807,
                        lat: -22.7821222
                    },
                    {
                        lng: -43.4187379,
                        lat: -22.7821668
                    },
                    {
                        lng: -43.418437,
                        lat: -22.7824979
                    },
                    {
                        lng: -43.4182386,
                        lat: -22.7827275
                    },
                    {
                        lng: -43.4181249,
                        lat: -22.7828488
                    },
                    {
                        lng: -43.4180232,
                        lat: -22.7829677
                    },
                    {
                        lng: -43.4178995,
                        lat: -22.7831128
                    },
                    {
                        lng: -43.4172209,
                        lat: -22.7837992
                    },
                    {
                        lng: -43.4170148,
                        lat: -22.7840717
                    },
                    {
                        lng: -43.4160085,
                        lat: -22.7851474
                    },
                    {
                        lng: -43.4154991,
                        lat: -22.7856623
                    },
                    {
                        lng: -43.4151724,
                        lat: -22.7860284
                    },
                    {
                        lng: -43.4133011,
                        lat: -22.7845642
                    },
                    {
                        lng: -43.4126834,
                        lat: -22.7839665
                    },
                    {
                        lng: -43.4112866,
                        lat: -22.7826764
                    },
                    {
                        lng: -43.4112414,
                        lat: -22.782634
                    },
                    {
                        lng: -43.4108835,
                        lat: -22.7822986
                    },
                    {
                        lng: -43.4061025,
                        lat: -22.7778181
                    },
                    {
                        lng: -43.4080292,
                        lat: -22.7762903
                    },
                    {
                        lng: -43.4081358,
                        lat: -22.776382
                    },
                    {
                        lng: -43.4083894,
                        lat: -22.7763993
                    },
                    {
                        lng: -43.4085898,
                        lat: -22.7765882
                    },
                    {
                        lng: -43.4089731,
                        lat: -22.7765708
                    },
                    {
                        lng: -43.4099619,
                        lat: -22.7760151
                    },
                    {
                        lng: -43.4103015,
                        lat: -22.7759765
                    },
                    {
                        lng: -43.4112165,
                        lat: -22.7755884
                    },
                    {
                        lng: -43.4118461,
                        lat: -22.7752599
                    },
                    {
                        lng: -43.4118554,
                        lat: -22.7753238
                    },
                    {
                        lng: -43.4120403,
                        lat: -22.7754167
                    },
                    {
                        lng: -43.4125665,
                        lat: -22.775233
                    },
                    {
                        lng: -43.4127237,
                        lat: -22.7753376
                    },
                    {
                        lng: -43.4127691,
                        lat: -22.7751862
                    },
                    {
                        lng: -43.4129529,
                        lat: -22.7750771
                    },
                    {
                        lng: -43.4129328,
                        lat: -22.7748921
                    },
                    {
                        lng: -43.4135785,
                        lat: -22.7746692
                    },
                    {
                        lng: -43.4131643,
                        lat: -22.7737023
                    },
                    {
                        lng: -43.413044,
                        lat: -22.7736384
                    },
                    {
                        lng: -43.4129645,
                        lat: -22.7732747
                    },
                    {
                        lng: -43.4127857,
                        lat: -22.7730645
                    },
                    {
                        lng: -43.4126232,
                        lat: -22.7729831
                    },
                    {
                        lng: -43.4125582,
                        lat: -22.7727475
                    },
                    {
                        lng: -43.4123955,
                        lat: -22.7723874
                    },
                    {
                        lng: -43.4123445,
                        lat: -22.7721131
                    },
                    {
                        lng: -43.4120845,
                        lat: -22.772075
                    },
                    {
                        lng: -43.4127332,
                        lat: -22.7709874
                    },
                    {
                        lng: -43.4132501,
                        lat: -22.7719874
                    },
                    {
                        lng: -43.4140473,
                        lat: -22.7716257
                    },
                    {
                        lng: -43.4173696,
                        lat: -22.7777676
                    },
                    {
                        lng: -43.4208482,
                        lat: -22.7779838
                    },
                    {
                        lng: -43.4223947,
                        lat: -22.7781132
                    },
                    {
                        lng: -43.4204743,
                        lat: -22.7802256
                    },
                    {
                        lng: -43.4194058,
                        lat: -22.7814641
                    },
                    {
                        lng: -43.4191179,
                        lat: -22.78177
                    },
                ],
                strokeColor: "#8a692d",
                fillColor: "#8a692d"
            },
            {
                coords: [

                    {
                        lng: -43.4413428,
                        lat: -22.7724589
                    },
                    {
                        lng: -43.4411236,
                        lat: -22.7724979
                    },
                    {
                        lng: -43.4409116,
                        lat: -22.7728925
                    },
                    {
                        lng: -43.4409178,
                        lat: -22.7729136
                    },
                    {
                        lng: -43.4409287,
                        lat: -22.7729442
                    },
                    {
                        lng: -43.4409395,
                        lat: -22.7729747
                    },
                    {
                        lng: -43.4409398,
                        lat: -22.7729961
                    },
                    {
                        lng: -43.4408256,
                        lat: -22.7730317
                    },
                    {
                        lng: -43.4407909,
                        lat: -22.7731808
                    },
                    {
                        lng: -43.440498,
                        lat: -22.7731203
                    },
                    {
                        lng: -43.4400812,
                        lat: -22.7730617
                    },
                    {
                        lng: -43.4397349,
                        lat: -22.7730456
                    },
                    {
                        lng: -43.4394072,
                        lat: -22.7729351
                    },
                    {
                        lng: -43.4390412,
                        lat: -22.7727497
                    },
                    {
                        lng: -43.4390259,
                        lat: -22.7727702
                    },
                    {
                        lng: -43.4389932,
                        lat: -22.7728139
                    },
                    {
                        lng: -43.438952,
                        lat: -22.7728777
                    },
                    {
                        lng: -43.4382696,
                        lat: -22.7737934
                    },
                    {
                        lng: -43.4382472,
                        lat: -22.7738369
                    },
                    {
                        lng: -43.4381136,
                        lat: -22.7737652
                    },
                    {
                        lng: -43.4379914,
                        lat: -22.773707
                    },
                    {
                        lng: -43.4378707,
                        lat: -22.7736593
                    },
                    {
                        lng: -43.4372388,
                        lat: -22.773647
                    },
                    {
                        lng: -43.4351471,
                        lat: -22.7728567
                    },
                    {
                        lng: -43.4350982,
                        lat: -22.7728616
                    },
                    {
                        lng: -43.4349559,
                        lat: -22.7728757
                    },
                    {
                        lng: -43.4360004,
                        lat: -22.7705699
                    },
                    {
                        lng: -43.4358871,
                        lat: -22.7704186
                    },
                    {
                        lng: -43.4364696,
                        lat: -22.7691767
                    },
                    {
                        lng: -43.4381351,
                        lat: -22.7702984
                    },
                    {
                        lng: -43.4384454,
                        lat: -22.7705075
                    },
                    {
                        lng: -43.4393737,
                        lat: -22.7711327
                    },
                    {
                        lng: -43.4412281,
                        lat: -22.7723817
                    },
                    {
                        lng: -43.4412649,
                        lat: -22.7724064
                    },
                    {
                        lng: -43.4413428,
                        lat: -22.7724589
                    },
                ],
                strokeColor: "#b3b825",
                fillColor: "#b3b825"
            },
            {
                coords: [

                    {
                        lng: -43.4337807,
                        lat: -22.7858384
                    },
                    {
                        lng: -43.4349506,
                        lat: -22.7887552
                    },
                    {
                        lng: -43.4356557,
                        lat: -22.7904977
                    },
                    {
                        lng: -43.4357616,
                        lat: -22.7911169
                    },
                    {
                        lng: -43.4361336,
                        lat: -22.7926529
                    },
                    {
                        lng: -43.4364394,
                        lat: -22.793815
                    },
                    {
                        lng: -43.4364041,
                        lat: -22.7939957
                    },
                    {
                        lng: -43.4279068,
                        lat: -22.7907916
                    },
                    {
                        lng: -43.4254581,
                        lat: -22.7898481
                    },
                    {
                        lng: -43.4254818,
                        lat: -22.7897938
                    },
                    {
                        lng: -43.4261433,
                        lat: -22.7883489
                    },
                    {
                        lng: -43.42626,
                        lat: -22.7880993
                    },
                    {
                        lng: -43.4264655,
                        lat: -22.7876548
                    },
                    {
                        lng: -43.4264682,
                        lat: -22.787649
                    },
                    {
                        lng: -43.4267328,
                        lat: -22.7870412
                    },
                    {
                        lng: -43.4268873,
                        lat: -22.7866894
                    },
                    {
                        lng: -43.4275564,
                        lat: -22.7851656
                    },
                    {
                        lng: -43.4275657,
                        lat: -22.7851445
                    },
                    {
                        lng: -43.4275287,
                        lat: -22.7850598
                    },
                    {
                        lng: -43.4273791,
                        lat: -22.7850024
                    },
                    {
                        lng: -43.4273728,
                        lat: -22.7850053
                    },
                    {
                        lng: -43.4273,
                        lat: -22.7850376
                    },
                    {
                        lng: -43.4272836,
                        lat: -22.7849659
                    },
                    {
                        lng: -43.4258526,
                        lat: -22.7844175
                    },
                    {
                        lng: -43.4258513,
                        lat: -22.784417
                    },
                    {
                        lng: -43.4257403,
                        lat: -22.7844454
                    },
                    {
                        lng: -43.4256839,
                        lat: -22.7843525
                    },
                    {
                        lng: -43.4252497,
                        lat: -22.7841865
                    },
                    {
                        lng: -43.4258538,
                        lat: -22.7828424
                    },
                    {
                        lng: -43.4258442,
                        lat: -22.7827995
                    },
                    {
                        lng: -43.4258301,
                        lat: -22.7827362
                    },
                    {
                        lng: -43.4259137,
                        lat: -22.7827139
                    },
                    {
                        lng: -43.4260835,
                        lat: -22.7823372
                    },
                    {
                        lng: -43.4260443,
                        lat: -22.7822512
                    },
                    {
                        lng: -43.4260701,
                        lat: -22.7822408
                    },
                    {
                        lng: -43.4261397,
                        lat: -22.7822126
                    },
                    {
                        lng: -43.4262997,
                        lat: -22.7818577
                    },
                    {
                        lng: -43.426363,
                        lat: -22.7817175
                    },
                    {
                        lng: -43.4265191,
                        lat: -22.7813712
                    },
                    {
                        lng: -43.4265203,
                        lat: -22.78134
                    },
                    {
                        lng: -43.4265299,
                        lat: -22.7811918
                    },
                    {
                        lng: -43.426579,
                        lat: -22.781089
                    },
                    {
                        lng: -43.426908,
                        lat: -22.7804068
                    },
                    {
                        lng: -43.4269905,
                        lat: -22.780229
                    },
                    {
                        lng: -43.4270584,
                        lat: -22.7800766
                    },
                    {
                        lng: -43.4270872,
                        lat: -22.780242
                    },
                    {
                        lng: -43.4272551,
                        lat: -22.7803141
                    },
                    {
                        lng: -43.427407,
                        lat: -22.7802698
                    },
                    {
                        lng: -43.4274604,
                        lat: -22.7803999
                    },
                    {
                        lng: -43.4284601,
                        lat: -22.7808136
                    },
                    {
                        lng: -43.4285007,
                        lat: -22.7807901
                    },
                    {
                        lng: -43.4285317,
                        lat: -22.7807722
                    },
                    {
                        lng: -43.4285356,
                        lat: -22.7808293
                    },
                    {
                        lng: -43.4285368,
                        lat: -22.7808475
                    },
                    {
                        lng: -43.4289545,
                        lat: -22.7810211
                    },
                    {
                        lng: -43.429121,
                        lat: -22.7809476
                    },
                    {
                        lng: -43.4293495,
                        lat: -22.7810313
                    },
                    {
                        lng: -43.4294084,
                        lat: -22.7810529
                    },
                    {
                        lng: -43.4297873,
                        lat: -22.7802408
                    },
                    {
                        lng: -43.4300721,
                        lat: -22.7795954
                    },
                    {
                        lng: -43.4305783,
                        lat: -22.7785412
                    },
                    {
                        lng: -43.4310664,
                        lat: -22.7775072
                    },
                    {
                        lng: -43.4314097,
                        lat: -22.7767307
                    },
                    {
                        lng: -43.4314183,
                        lat: -22.7767111
                    },
                    {
                        lng: -43.4314445,
                        lat: -22.7766509
                    },
                    {
                        lng: -43.4315712,
                        lat: -22.7768259
                    },
                    {
                        lng: -43.4316399,
                        lat: -22.7768705
                    },
                    {
                        lng: -43.4316432,
                        lat: -22.7768726
                    },
                    {
                        lng: -43.4317087,
                        lat: -22.7769151
                    },
                    {
                        lng: -43.432098,
                        lat: -22.7770793
                    },
                    {
                        lng: -43.4322057,
                        lat: -22.7770578
                    },
                    {
                        lng: -43.4322785,
                        lat: -22.7770282
                    },
                    {
                        lng: -43.4322894,
                        lat: -22.7771282
                    },
                    {
                        lng: -43.4323158,
                        lat: -22.7771631
                    },
                    {
                        lng: -43.4328054,
                        lat: -22.7773338
                    },
                    {
                        lng: -43.432895,
                        lat: -22.7773121
                    },
                    {
                        lng: -43.4329294,
                        lat: -22.7773219
                    },
                    {
                        lng: -43.4329525,
                        lat: -22.7773808
                    },
                    {
                        lng: -43.4332578,
                        lat: -22.7774435
                    },
                    {
                        lng: -43.4333188,
                        lat: -22.7774029
                    },
                    {
                        lng: -43.4333477,
                        lat: -22.7774796
                    },
                    {
                        lng: -43.4333616,
                        lat: -22.7775211
                    },
                    {
                        lng: -43.4339929,
                        lat: -22.7775278
                    },
                    {
                        lng: -43.4340697,
                        lat: -22.7774654
                    },
                    {
                        lng: -43.4340891,
                        lat: -22.7776605
                    },
                    {
                        lng: -43.4341494,
                        lat: -22.7778251
                    },
                    {
                        lng: -43.4345083,
                        lat: -22.7782036
                    },
                    {
                        lng: -43.4335087,
                        lat: -22.7790389
                    },
                    {
                        lng: -43.4331633,
                        lat: -22.7785771
                    },
                    {
                        lng: -43.432917,
                        lat: -22.7794426
                    },
                    {
                        lng: -43.4330733,
                        lat: -22.7795398
                    },
                    {
                        lng: -43.433308,
                        lat: -22.7797645
                    },
                    {
                        lng: -43.4332463,
                        lat: -22.77985
                    },
                    {
                        lng: -43.4332769,
                        lat: -22.7799978
                    },
                    {
                        lng: -43.4333369,
                        lat: -22.7801464
                    },
                    {
                        lng: -43.4334908,
                        lat: -22.780249
                    },
                    {
                        lng: -43.4333259,
                        lat: -22.7805398
                    },
                    {
                        lng: -43.4332301,
                        lat: -22.7810402
                    },
                    {
                        lng: -43.433213,
                        lat: -22.7813643
                    },
                    {
                        lng: -43.4332226,
                        lat: -22.7814433
                    },
                    {
                        lng: -43.4333952,
                        lat: -22.7815852
                    },
                    {
                        lng: -43.4333445,
                        lat: -22.7816389
                    },
                    {
                        lng: -43.433305,
                        lat: -22.7817212
                    },
                    {
                        lng: -43.4334098,
                        lat: -22.7820678
                    },
                    {
                        lng: -43.4336141,
                        lat: -22.7825222
                    },
                    {
                        lng: -43.4337604,
                        lat: -22.7826854
                    },
                    {
                        lng: -43.4335926,
                        lat: -22.7828076
                    },
                    {
                        lng: -43.4334508,
                        lat: -22.7832369
                    },
                    {
                        lng: -43.4332936,
                        lat: -22.7835793
                    },
                    {
                        lng: -43.4330812,
                        lat: -22.7841006
                    },
                    {
                        lng: -43.4337807,
                        lat: -22.7858384
                    },
                ],
                strokeColor: "#76b825",
                fillColor: "#76b825"
            },
            {
                coords: [

                    {
                        lng: -43.4411261,
                        lat: -22.8035909
                    },
                    {
                        lng: -43.4407504,
                        lat: -22.8041071
                    },
                    {
                        lng: -43.4369362,
                        lat: -22.8025357
                    },
                    {
                        lng: -43.436238,
                        lat: -22.8035805
                    },
                    {
                        lng: -43.4342659,
                        lat: -22.8027788
                    },
                    {
                        lng: -43.433849,
                        lat: -22.8032973
                    },
                    {
                        lng: -43.4331695,
                        lat: -22.8030727
                    },
                    {
                        lng: -43.4321441,
                        lat: -22.8047126
                    },
                    {
                        lng: -43.4315972,
                        lat: -22.8045211
                    },
                    {
                        lng: -43.4310527,
                        lat: -22.805383
                    },
                    {
                        lng: -43.4304164,
                        lat: -22.8050127
                    },
                    {
                        lng: -43.4303034,
                        lat: -22.8049486
                    },
                    {
                        lng: -43.430274,
                        lat: -22.8049315
                    },
                    {
                        lng: -43.4300038,
                        lat: -22.8047606
                    },
                    {
                        lng: -43.4298229,
                        lat: -22.8046896
                    },
                    {
                        lng: -43.4295839,
                        lat: -22.8045087
                    },
                    {
                        lng: -43.4293517,
                        lat: -22.8043001
                    },
                    {
                        lng: -43.429164,
                        lat: -22.8041275
                    },
                    {
                        lng: -43.4291446,
                        lat: -22.8039983
                    },
                    {
                        lng: -43.4291252,
                        lat: -22.8038045
                    },
                    {
                        lng: -43.428993,
                        lat: -22.803338
                    },
                    {
                        lng: -43.4289875,
                        lat: -22.8033187
                    },
                    {
                        lng: -43.4289443,
                        lat: -22.8030713
                    },
                    {
                        lng: -43.4288862,
                        lat: -22.8027547
                    },
                    {
                        lng: -43.4287505,
                        lat: -22.8023865
                    },
                    {
                        lng: -43.42866,
                        lat: -22.8020376
                    },
                    {
                        lng: -43.4284598,
                        lat: -22.8017728
                    },
                    {
                        lng: -43.4283177,
                        lat: -22.8015144
                    },
                    {
                        lng: -43.4281186,
                        lat: -22.8013801
                    },
                    {
                        lng: -43.4279254,
                        lat: -22.8013065
                    },
                    {
                        lng: -43.4278487,
                        lat: -22.8012773
                    },
                    {
                        lng: -43.427607,
                        lat: -22.8013012
                    },
                    {
                        lng: -43.4273938,
                        lat: -22.8014562
                    },
                    {
                        lng: -43.4270579,
                        lat: -22.8014239
                    },
                    {
                        lng: -43.4267858,
                        lat: -22.8012464
                    },
                    {
                        lng: -43.4267607,
                        lat: -22.8012301
                    },
                    {
                        lng: -43.4267424,
                        lat: -22.8012244
                    },
                    {
                        lng: -43.426386,
                        lat: -22.8011138
                    },
                    {
                        lng: -43.4260178,
                        lat: -22.8010234
                    },
                    {
                        lng: -43.4259476,
                        lat: -22.8009863
                    },
                    {
                        lng: -43.4261635,
                        lat: -22.8008432
                    },
                    {
                        lng: -43.4265318,
                        lat: -22.8007133
                    },
                    {
                        lng: -43.4268818,
                        lat: -22.8005444
                    },
                    {
                        lng: -43.4269862,
                        lat: -22.8003531
                    },
                    {
                        lng: -43.4269867,
                        lat: -22.8001002
                    },
                    {
                        lng: -43.4270785,
                        lat: -22.7998361
                    },
                    {
                        lng: -43.4272312,
                        lat: -22.7996844
                    },
                    {
                        lng: -43.4274997,
                        lat: -22.7994517
                    },
                    {
                        lng: -43.4276617,
                        lat: -22.7992779
                    },
                    {
                        lng: -43.4280661,
                        lat: -22.7990693
                    },
                    {
                        lng: -43.4285072,
                        lat: -22.7989678
                    },
                    {
                        lng: -43.4287577,
                        lat: -22.798996
                    },
                    {
                        lng: -43.4290203,
                        lat: -22.7991198
                    },
                    {
                        lng: -43.4291729,
                        lat: -22.7991987
                    },
                    {
                        lng: -43.4293867,
                        lat: -22.7991367
                    },
                    {
                        lng: -43.4296187,
                        lat: -22.798996
                    },
                    {
                        lng: -43.4298019,
                        lat: -22.7988947
                    },
                    {
                        lng: -43.4301744,
                        lat: -22.7988553
                    },
                    {
                        lng: -43.4303759,
                        lat: -22.7987484
                    },
                    {
                        lng: -43.4308517,
                        lat: -22.7983492
                    },
                    {
                        lng: -43.4312354,
                        lat: -22.7979056
                    },
                    {
                        lng: -43.4313855,
                        lat: -22.7977442
                    },
                    {
                        lng: -43.4316237,
                        lat: -22.7974859
                    },
                    {
                        lng: -43.4318369,
                        lat: -22.7972616
                    },
                    {
                        lng: -43.4322566,
                        lat: -22.7969869
                    },
                    {
                        lng: -43.4325548,
                        lat: -22.7968297
                    },
                    {
                        lng: -43.4330213,
                        lat: -22.7967354
                    },
                    {
                        lng: -43.4333012,
                        lat: -22.7966174
                    },
                    {
                        lng: -43.433423,
                        lat: -22.7964431
                    },
                    {
                        lng: -43.4336497,
                        lat: -22.7963197
                    },
                    {
                        lng: -43.4337838,
                        lat: -22.7963759
                    },
                    {
                        lng: -43.4339671,
                        lat: -22.7963649
                    },
                    {
                        lng: -43.4341555,
                        lat: -22.7965388
                    },
                    {
                        lng: -43.43432,
                        lat: -22.7966736
                    },
                    {
                        lng: -43.4345396,
                        lat: -22.7966849
                    },
                    {
                        lng: -43.4350209,
                        lat: -22.7967019
                    },
                    {
                        lng: -43.4352521,
                        lat: -22.7968534
                    },
                    {
                        lng: -43.4355559,
                        lat: -22.7969206
                    },
                    {
                        lng: -43.4359019,
                        lat: -22.7969878
                    },
                    {
                        lng: -43.4358786,
                        lat: -22.7971037
                    },
                    {
                        lng: -43.4360102,
                        lat: -22.7971906
                    },
                    {
                        lng: -43.4361478,
                        lat: -22.7974271
                    },
                    {
                        lng: -43.4362352,
                        lat: -22.797521
                    },
                    {
                        lng: -43.4363428,
                        lat: -22.797524
                    },
                    {
                        lng: -43.4364218,
                        lat: -22.7975927
                    },
                    {
                        lng: -43.4364547,
                        lat: -22.7977099
                    },
                    {
                        lng: -43.4365599,
                        lat: -22.7978042
                    },
                    {
                        lng: -43.4367131,
                        lat: -22.7977837
                    },
                    {
                        lng: -43.4369086,
                        lat: -22.797864
                    },
                    {
                        lng: -43.4371777,
                        lat: -22.79788
                    },
                    {
                        lng: -43.4372329,
                        lat: -22.79784
                    },
                    {
                        lng: -43.4372884,
                        lat: -22.7977917
                    },
                    {
                        lng: -43.4373991,
                        lat: -22.7977034
                    },
                    {
                        lng: -43.4376175,
                        lat: -22.7976429
                    },
                    {
                        lng: -43.4379511,
                        lat: -22.7976687
                    },
                    {
                        lng: -43.4380676,
                        lat: -22.7977216
                    },
                    {
                        lng: -43.4383543,
                        lat: -22.7978368
                    },
                    {
                        lng: -43.4385841,
                        lat: -22.7977184
                    },
                    {
                        lng: -43.4388574,
                        lat: -22.7973935
                    },
                    {
                        lng: -43.4393324,
                        lat: -22.7972816
                    },
                    {
                        lng: -43.4396056,
                        lat: -22.7972145
                    },
                    {
                        lng: -43.4398929,
                        lat: -22.7972139
                    },
                    {
                        lng: -43.4402602,
                        lat: -22.7974287
                    },
                    {
                        lng: -43.4404435,
                        lat: -22.7975233
                    },
                    {
                        lng: -43.4407346,
                        lat: -22.7977429
                    },
                    {
                        lng: -43.4409047,
                        lat: -22.7978687
                    },
                    {
                        lng: -43.4411582,
                        lat: -22.7977995
                    },
                    {
                        lng: -43.4412839,
                        lat: -22.7976798
                    },
                    {
                        lng: -43.4415525,
                        lat: -22.7976523
                    },
                    {
                        lng: -43.4418497,
                        lat: -22.7977219
                    },
                    {
                        lng: -43.4420163,
                        lat: -22.7976288
                    },
                    {
                        lng: -43.4426293,
                        lat: -22.7975133
                    },
                    {
                        lng: -43.443031,
                        lat: -22.7975766
                    },
                    {
                        lng: -43.4400013,
                        lat: -22.8017589
                    },
                    {
                        lng: -43.4411261,
                        lat: -22.8035909
                    },
                ],
                strokeColor: "#25b842",
                fillColor: "#25b842"
            },
            {
                coords: [

                    {
                        lng: -43.4340697,
                        lat: -22.7774654
                    },
                    {
                        lng: -43.4341173,
                        lat: -22.7774258
                    },
                    {
                        lng: -43.4342926,
                        lat: -22.7764406
                    },
                    {
                        lng: -43.4345508,
                        lat: -22.775801
                    },
                    {
                        lng: -43.434492,
                        lat: -22.7756982
                    },
                    {
                        lng: -43.4344595,
                        lat: -22.7756281
                    },
                    {
                        lng: -43.4352084,
                        lat: -22.7739964
                    },
                    {
                        lng: -43.4353397,
                        lat: -22.7739745
                    },
                    {
                        lng: -43.4352733,
                        lat: -22.7739142
                    },
                    {
                        lng: -43.4349031,
                        lat: -22.7732799
                    },
                    {
                        lng: -43.4348443,
                        lat: -22.7731782
                    },
                    {
                        lng: -43.4348824,
                        lat: -22.7730726
                    },
                    {
                        lng: -43.4349559,
                        lat: -22.7728757
                    },
                    {
                        lng: -43.4350982,
                        lat: -22.7728616
                    },
                    {
                        lng: -43.4351471,
                        lat: -22.7728567
                    },
                    {
                        lng: -43.4372388,
                        lat: -22.773647
                    },
                    {
                        lng: -43.4378707,
                        lat: -22.7736593
                    },
                    {
                        lng: -43.4379914,
                        lat: -22.773707
                    },
                    {
                        lng: -43.4381136,
                        lat: -22.7737652
                    },
                    {
                        lng: -43.4382472,
                        lat: -22.7738369
                    },
                    {
                        lng: -43.4382696,
                        lat: -22.7737934
                    },
                    {
                        lng: -43.438952,
                        lat: -22.7728777
                    },
                    {
                        lng: -43.4389932,
                        lat: -22.7728139
                    },
                    {
                        lng: -43.4390259,
                        lat: -22.7727702
                    },
                    {
                        lng: -43.4390412,
                        lat: -22.7727497
                    },
                    {
                        lng: -43.4394072,
                        lat: -22.7729351
                    },
                    {
                        lng: -43.4397349,
                        lat: -22.7730456
                    },
                    {
                        lng: -43.4400812,
                        lat: -22.7730617
                    },
                    {
                        lng: -43.440498,
                        lat: -22.7731203
                    },
                    {
                        lng: -43.4407909,
                        lat: -22.7731808
                    },
                    {
                        lng: -43.4408256,
                        lat: -22.7730317
                    },
                    {
                        lng: -43.4409398,
                        lat: -22.7729961
                    },
                    {
                        lng: -43.4409395,
                        lat: -22.7729747
                    },
                    {
                        lng: -43.4409287,
                        lat: -22.7729442
                    },
                    {
                        lng: -43.4409178,
                        lat: -22.7729136
                    },
                    {
                        lng: -43.4409116,
                        lat: -22.7728925
                    },
                    {
                        lng: -43.4411236,
                        lat: -22.7724979
                    },
                    {
                        lng: -43.4413428,
                        lat: -22.7724589
                    },
                    {
                        lng: -43.4413444,
                        lat: -22.7725199
                    },
                    {
                        lng: -43.4417074,
                        lat: -22.7727677
                    },
                    {
                        lng: -43.4420122,
                        lat: -22.7728597
                    },
                    {
                        lng: -43.4421496,
                        lat: -22.7728682
                    },
                    {
                        lng: -43.4423121,
                        lat: -22.7736469
                    },
                    {
                        lng: -43.4428265,
                        lat: -22.7737699
                    },
                    {
                        lng: -43.4434852,
                        lat: -22.7739093
                    },
                    {
                        lng: -43.4431307,
                        lat: -22.7740059
                    },
                    {
                        lng: -43.4429708,
                        lat: -22.7740298
                    },
                    {
                        lng: -43.4425147,
                        lat: -22.7741405
                    },
                    {
                        lng: -43.4420045,
                        lat: -22.7744708
                    },
                    {
                        lng: -43.4417565,
                        lat: -22.7748251
                    },
                    {
                        lng: -43.4411348,
                        lat: -22.7757542
                    },
                    {
                        lng: -43.4406352,
                        lat: -22.7764181
                    },
                    {
                        lng: -43.4396249,
                        lat: -22.7774199
                    },
                    {
                        lng: -43.4400723,
                        lat: -22.7779365
                    },
                    {
                        lng: -43.4414732,
                        lat: -22.776853
                    },
                    {
                        lng: -43.4414714,
                        lat: -22.7773015
                    },
                    {
                        lng: -43.4413844,
                        lat: -22.7776485
                    },
                    {
                        lng: -43.4412447,
                        lat: -22.777806
                    },
                    {
                        lng: -43.4409943,
                        lat: -22.777886
                    },
                    {
                        lng: -43.4398033,
                        lat: -22.7791604
                    },
                    {
                        lng: -43.4396971,
                        lat: -22.7793588
                    },
                    {
                        lng: -43.4396748,
                        lat: -22.7795067
                    },
                    {
                        lng: -43.439734,
                        lat: -22.779604
                    },
                    {
                        lng: -43.4396286,
                        lat: -22.7798653
                    },
                    {
                        lng: -43.4389622,
                        lat: -22.780285
                    },
                    {
                        lng: -43.4385295,
                        lat: -22.780373
                    },
                    {
                        lng: -43.4381968,
                        lat: -22.7803497
                    },
                    {
                        lng: -43.4380886,
                        lat: -22.7803372
                    },
                    {
                        lng: -43.4379907,
                        lat: -22.7804501
                    },
                    {
                        lng: -43.4379679,
                        lat: -22.7808805
                    },
                    {
                        lng: -43.4370399,
                        lat: -22.7811292
                    },
                    {
                        lng: -43.4370672,
                        lat: -22.7813493
                    },
                    {
                        lng: -43.437062,
                        lat: -22.7815319
                    },
                    {
                        lng: -43.4369285,
                        lat: -22.7817427
                    },
                    {
                        lng: -43.4366602,
                        lat: -22.7819115
                    },
                    {
                        lng: -43.4365584,
                        lat: -22.7819043
                    },
                    {
                        lng: -43.4365691,
                        lat: -22.7819991
                    },
                    {
                        lng: -43.4364086,
                        lat: -22.7817861
                    },
                    {
                        lng: -43.4361675,
                        lat: -22.7812814
                    },
                    {
                        lng: -43.4360425,
                        lat: -22.7807271
                    },
                    {
                        lng: -43.4351632,
                        lat: -22.780298
                    },
                    {
                        lng: -43.4350911,
                        lat: -22.7800163
                    },
                    {
                        lng: -43.4350169,
                        lat: -22.7799792
                    },
                    {
                        lng: -43.4344508,
                        lat: -22.7800331
                    },
                    {
                        lng: -43.433854,
                        lat: -22.7801196
                    },
                    {
                        lng: -43.4334908,
                        lat: -22.780249
                    },
                    {
                        lng: -43.4333369,
                        lat: -22.7801464
                    },
                    {
                        lng: -43.4332769,
                        lat: -22.7799978
                    },
                    {
                        lng: -43.4332463,
                        lat: -22.77985
                    },
                    {
                        lng: -43.433308,
                        lat: -22.7797645
                    },
                    {
                        lng: -43.4330733,
                        lat: -22.7795398
                    },
                    {
                        lng: -43.432917,
                        lat: -22.7794426
                    },
                    {
                        lng: -43.4331633,
                        lat: -22.7785771
                    },
                    {
                        lng: -43.4335087,
                        lat: -22.7790389
                    },
                    {
                        lng: -43.4345083,
                        lat: -22.7782036
                    },
                    {
                        lng: -43.4341494,
                        lat: -22.7778251
                    },
                    {
                        lng: -43.4340891,
                        lat: -22.7776605
                    },
                    {
                        lng: -43.4340697,
                        lat: -22.7774654
                    },
                ],
                strokeColor: "#25b891",
                fillColor: "#25b891"
            },
            {
                coords: [

                    {
                        lng: -43.4132002,
                        lat: -22.7882387
                    },
                    {
                        lng: -43.4141133,
                        lat: -22.7879349
                    },
                    {
                        lng: -43.4150081,
                        lat: -22.7879089
                    },
                    {
                        lng: -43.4159337,
                        lat: -22.7878684
                    },
                    {
                        lng: -43.4166387,
                        lat: -22.7879523
                    },
                    {
                        lng: -43.4172403,
                        lat: -22.7880315
                    },
                    {
                        lng: -43.4180787,
                        lat: -22.7884362
                    },
                    {
                        lng: -43.4185134,
                        lat: -22.7887171
                    },
                    {
                        lng: -43.4190007,
                        lat: -22.7890595
                    },
                    {
                        lng: -43.4201601,
                        lat: -22.7898442
                    },
                    {
                        lng: -43.4211724,
                        lat: -22.7905434
                    },
                    {
                        lng: -43.4216667,
                        lat: -22.7908989
                    },
                    {
                        lng: -43.4217735,
                        lat: -22.7909755
                    },
                    {
                        lng: -43.4221165,
                        lat: -22.7911555
                    },
                    {
                        lng: -43.4229257,
                        lat: -22.7916163
                    },
                    {
                        lng: -43.424296,
                        lat: -22.7924517
                    },
                    {
                        lng: -43.4239827,
                        lat: -22.793186
                    },
                    {
                        lng: -43.4237552,
                        lat: -22.7937064
                    },
                    {
                        lng: -43.4235842,
                        lat: -22.7941065
                    },
                    {
                        lng: -43.4230059,
                        lat: -22.7954589
                    },
                    {
                        lng: -43.4229022,
                        lat: -22.795682
                    },
                    {
                        lng: -43.4225934,
                        lat: -22.7964081
                    },
                    {
                        lng: -43.4224607,
                        lat: -22.7967081
                    },
                    {
                        lng: -43.4221698,
                        lat: -22.7973516
                    },
                    {
                        lng: -43.4215197,
                        lat: -22.7987628
                    },
                    {
                        lng: -43.4211548,
                        lat: -22.7986195
                    },
                    {
                        lng: -43.4200732,
                        lat: -22.7978939
                    },
                    {
                        lng: -43.4196777,
                        lat: -22.7976077
                    },
                    {
                        lng: -43.4189049,
                        lat: -22.7970484
                    },
                    {
                        lng: -43.4186028,
                        lat: -22.7968264
                    },
                    {
                        lng: -43.4176112,
                        lat: -22.7960826
                    },
                    {
                        lng: -43.4174395,
                        lat: -22.7959614
                    },
                    {
                        lng: -43.4165105,
                        lat: -22.7953018
                    },
                    {
                        lng: -43.4164624,
                        lat: -22.7952673
                    },
                    {
                        lng: -43.4162743,
                        lat: -22.7951321
                    },
                    {
                        lng: -43.4157863,
                        lat: -22.7947814
                    },
                    {
                        lng: -43.4154484,
                        lat: -22.794549
                    },
                    {
                        lng: -43.4146163,
                        lat: -22.7940445
                    },
                    {
                        lng: -43.414492,
                        lat: -22.7939691
                    },
                    {
                        lng: -43.4143193,
                        lat: -22.7938644
                    },
                    {
                        lng: -43.4141855,
                        lat: -22.7937833
                    },
                    {
                        lng: -43.4127609,
                        lat: -22.7929195
                    },
                    {
                        lng: -43.4110901,
                        lat: -22.7919066
                    },
                    {
                        lng: -43.410708,
                        lat: -22.7916749
                    },
                    {
                        lng: -43.4103457,
                        lat: -22.7914733
                    },
                    {
                        lng: -43.4102923,
                        lat: -22.7914197
                    },
                    {
                        lng: -43.4114413,
                        lat: -22.7901183
                    },
                    {
                        lng: -43.4132002,
                        lat: -22.7882387
                    },
                ],
                strokeColor: "#25b8b8",
                fillColor: "#25b8b8"
            },
            {
                coords: [

                    {
                        lng: -43.4258183,
                        lat: -22.7744916
                    },
                    {
                        lng: -43.4314445,
                        lat: -22.7766509
                    },
                    {
                        lng: -43.4314183,
                        lat: -22.7767111
                    },
                    {
                        lng: -43.4314097,
                        lat: -22.7767307
                    },
                    {
                        lng: -43.4310664,
                        lat: -22.7775072
                    },
                    {
                        lng: -43.4305783,
                        lat: -22.7785412
                    },
                    {
                        lng: -43.4300721,
                        lat: -22.7795954
                    },
                    {
                        lng: -43.4297873,
                        lat: -22.7802408
                    },
                    {
                        lng: -43.4294084,
                        lat: -22.7810529
                    },
                    {
                        lng: -43.4293495,
                        lat: -22.7810313
                    },
                    {
                        lng: -43.429121,
                        lat: -22.7809476
                    },
                    {
                        lng: -43.4289545,
                        lat: -22.7810211
                    },
                    {
                        lng: -43.4285368,
                        lat: -22.7808475
                    },
                    {
                        lng: -43.4285356,
                        lat: -22.7808293
                    },
                    {
                        lng: -43.4285317,
                        lat: -22.7807722
                    },
                    {
                        lng: -43.4285007,
                        lat: -22.7807901
                    },
                    {
                        lng: -43.4284601,
                        lat: -22.7808136
                    },
                    {
                        lng: -43.4274604,
                        lat: -22.7803999
                    },
                    {
                        lng: -43.427407,
                        lat: -22.7802698
                    },
                    {
                        lng: -43.4272551,
                        lat: -22.7803141
                    },
                    {
                        lng: -43.4270872,
                        lat: -22.780242
                    },
                    {
                        lng: -43.4270584,
                        lat: -22.7800766
                    },
                    {
                        lng: -43.4223947,
                        lat: -22.7781132
                    },
                    {
                        lng: -43.4233187,
                        lat: -22.7771477
                    },
                    {
                        lng: -43.4242969,
                        lat: -22.7760925
                    },
                    {
                        lng: -43.4247123,
                        lat: -22.7756444
                    },
                    {
                        lng: -43.4258183,
                        lat: -22.7744916
                    },
                ],
                strokeColor: "#2565b8",
                fillColor: "#2565b8"
            },
            {
                coords: [

                    {
                        lng: -43.4411261,
                        lat: -22.8035909
                    },
                    {
                        lng: -43.4400013,
                        lat: -22.8017589
                    },
                    {
                        lng: -43.443031,
                        lat: -22.7975766
                    },
                    {
                        lng: -43.4432866,
                        lat: -22.797524
                    },
                    {
                        lng: -43.4438128,
                        lat: -22.7973577
                    },
                    {
                        lng: -43.4444066,
                        lat: -22.7970925
                    },
                    {
                        lng: -43.4449783,
                        lat: -22.7967717
                    },
                    {
                        lng: -43.4452474,
                        lat: -22.7963833
                    },
                    {
                        lng: -43.4452822,
                        lat: -22.796178
                    },
                    {
                        lng: -43.4454013,
                        lat: -22.7959741
                    },
                    {
                        lng: -43.445473,
                        lat: -22.7962367
                    },
                    {
                        lng: -43.445428,
                        lat: -22.7964606
                    },
                    {
                        lng: -43.4452527,
                        lat: -22.7970022
                    },
                    {
                        lng: -43.4451126,
                        lat: -22.7974176
                    },
                    {
                        lng: -43.4447619,
                        lat: -22.7979182
                    },
                    {
                        lng: -43.4444958,
                        lat: -22.7984922
                    },
                    {
                        lng: -43.4444434,
                        lat: -22.7988202
                    },
                    {
                        lng: -43.4445076,
                        lat: -22.7993198
                    },
                    {
                        lng: -43.4446987,
                        lat: -22.7998661
                    },
                    {
                        lng: -43.4449532,
                        lat: -22.8001303
                    },
                    {
                        lng: -43.4453618,
                        lat: -22.8005891
                    },
                    {
                        lng: -43.4454941,
                        lat: -22.8008475
                    },
                    {
                        lng: -43.445558,
                        lat: -22.8013596
                    },
                    {
                        lng: -43.4454133,
                        lat: -22.8020012
                    },
                    {
                        lng: -43.4451927,
                        lat: -22.8024713
                    },
                    {
                        lng: -43.4457729,
                        lat: -22.8036317
                    },
                    {
                        lng: -43.4459291,
                        lat: -22.803927
                    },
                    {
                        lng: -43.4467222,
                        lat: -22.804716
                    },
                    {
                        lng: -43.4470263,
                        lat: -22.8050497
                    },
                    {
                        lng: -43.4453759,
                        lat: -22.8065502
                    },
                    {
                        lng: -43.4436052,
                        lat: -22.8077014
                    },
                    {
                        lng: -43.4423141,
                        lat: -22.8055626
                    },
                    {
                        lng: -43.4411261,
                        lat: -22.8035909
                    },
                ],
                strokeColor: "#252ab8",
                fillColor: "#252ab8"
            },
            {
                coords: [

                    {
                        lng: -43.4389627,
                        lat: -22.8113518
                    },
                    {
                        lng: -43.4389393,
                        lat: -22.8113248
                    },
                    {
                        lng: -43.438914,
                        lat: -22.8112956
                    },
                    {
                        lng: -43.4384862,
                        lat: -22.8107566
                    },
                    {
                        lng: -43.4384762,
                        lat: -22.8107441
                    },
                    {
                        lng: -43.4380766,
                        lat: -22.8102822
                    },
                    {
                        lng: -43.4379562,
                        lat: -22.810143
                    },
                    {
                        lng: -43.4377286,
                        lat: -22.8098799
                    },
                    {
                        lng: -43.4372936,
                        lat: -22.809408
                    },
                    {
                        lng: -43.4371404,
                        lat: -22.8091885
                    },
                    {
                        lng: -43.4370158,
                        lat: -22.8090101
                    },
                    {
                        lng: -43.4369401,
                        lat: -22.8089199
                    },
                    {
                        lng: -43.436809,
                        lat: -22.8087634
                    },
                    {
                        lng: -43.4367393,
                        lat: -22.8086802
                    },
                    {
                        lng: -43.4364493,
                        lat: -22.8084215
                    },
                    {
                        lng: -43.4363344,
                        lat: -22.8083211
                    },
                    {
                        lng: -43.4362488,
                        lat: -22.8082463
                    },
                    {
                        lng: -43.4360456,
                        lat: -22.8080975
                    },
                    {
                        lng: -43.435896,
                        lat: -22.807964
                    },
                    {
                        lng: -43.4356413,
                        lat: -22.8078545
                    },
                    {
                        lng: -43.4356324,
                        lat: -22.8078507
                    },
                    {
                        lng: -43.4355837,
                        lat: -22.8078411
                    },
                    {
                        lng: -43.4355282,
                        lat: -22.8078302
                    },
                    {
                        lng: -43.4354174,
                        lat: -22.8078416
                    },
                    {
                        lng: -43.4351632,
                        lat: -22.8077057
                    },
                    {
                        lng: -43.4350506,
                        lat: -22.8076654
                    },
                    {
                        lng: -43.4349824,
                        lat: -22.8076085
                    },
                    {
                        lng: -43.4348318,
                        lat: -22.8075744
                    },
                    {
                        lng: -43.434755,
                        lat: -22.8074777
                    },
                    {
                        lng: -43.434593,
                        lat: -22.8074351
                    },
                    {
                        lng: -43.4342112,
                        lat: -22.80715
                    },
                    {
                        lng: -43.4341397,
                        lat: -22.8071161
                    },
                    {
                        lng: -43.4337988,
                        lat: -22.8069544
                    },
                    {
                        lng: -43.4337677,
                        lat: -22.8069397
                    },
                    {
                        lng: -43.4335653,
                        lat: -22.806844
                    },
                    {
                        lng: -43.4334561,
                        lat: -22.8067923
                    },
                    {
                        lng: -43.4331262,
                        lat: -22.806574
                    },
                    {
                        lng: -43.4327613,
                        lat: -22.8063712
                    },
                    {
                        lng: -43.4325374,
                        lat: -22.8062419
                    },
                    {
                        lng: -43.4323983,
                        lat: -22.8061615
                    },
                    {
                        lng: -43.4320436,
                        lat: -22.8059574
                    },
                    {
                        lng: -43.4310527,
                        lat: -22.805383
                    },
                    {
                        lng: -43.4315972,
                        lat: -22.8045211
                    },
                    {
                        lng: -43.4321441,
                        lat: -22.8047126
                    },
                    {
                        lng: -43.4331695,
                        lat: -22.8030727
                    },
                    {
                        lng: -43.433849,
                        lat: -22.8032973
                    },
                    {
                        lng: -43.4342659,
                        lat: -22.8027788
                    },
                    {
                        lng: -43.436238,
                        lat: -22.8035805
                    },
                    {
                        lng: -43.4369362,
                        lat: -22.8025357
                    },
                    {
                        lng: -43.4407504,
                        lat: -22.8041071
                    },
                    {
                        lng: -43.4411261,
                        lat: -22.8035909
                    },
                    {
                        lng: -43.4423141,
                        lat: -22.8055626
                    },
                    {
                        lng: -43.4436052,
                        lat: -22.8077014
                    },
                    {
                        lng: -43.4389627,
                        lat: -22.8113518
                    },
                ],
                strokeColor: "#6e25b8",
                fillColor: "#6e25b8"
            },
            {
                coords: [

                    {
                        lng: -43.4119068,
                        lat: -22.7677633
                    },
                    {
                        lng: -43.4132321,
                        lat: -22.7701003
                    },
                    {
                        lng: -43.4127332,
                        lat: -22.7709874
                    },
                    {
                        lng: -43.4120845,
                        lat: -22.772075
                    },
                    {
                        lng: -43.4123445,
                        lat: -22.7721131
                    },
                    {
                        lng: -43.4123955,
                        lat: -22.7723874
                    },
                    {
                        lng: -43.4125582,
                        lat: -22.7727475
                    },
                    {
                        lng: -43.4126232,
                        lat: -22.7729831
                    },
                    {
                        lng: -43.4127857,
                        lat: -22.7730645
                    },
                    {
                        lng: -43.4129645,
                        lat: -22.7732747
                    },
                    {
                        lng: -43.413044,
                        lat: -22.7736384
                    },
                    {
                        lng: -43.4131643,
                        lat: -22.7737023
                    },
                    {
                        lng: -43.4135785,
                        lat: -22.7746692
                    },
                    {
                        lng: -43.4129328,
                        lat: -22.7748921
                    },
                    {
                        lng: -43.4129529,
                        lat: -22.7750771
                    },
                    {
                        lng: -43.4127691,
                        lat: -22.7751862
                    },
                    {
                        lng: -43.4127237,
                        lat: -22.7753376
                    },
                    {
                        lng: -43.4125665,
                        lat: -22.775233
                    },
                    {
                        lng: -43.4120403,
                        lat: -22.7754167
                    },
                    {
                        lng: -43.4118554,
                        lat: -22.7753238
                    },
                    {
                        lng: -43.4118461,
                        lat: -22.7752599
                    },
                    {
                        lng: -43.4112165,
                        lat: -22.7755884
                    },
                    {
                        lng: -43.4103015,
                        lat: -22.7759765
                    },
                    {
                        lng: -43.4099619,
                        lat: -22.7760151
                    },
                    {
                        lng: -43.4089731,
                        lat: -22.7765708
                    },
                    {
                        lng: -43.4085898,
                        lat: -22.7765882
                    },
                    {
                        lng: -43.4083894,
                        lat: -22.7763993
                    },
                    {
                        lng: -43.4081358,
                        lat: -22.776382
                    },
                    {
                        lng: -43.4080292,
                        lat: -22.7762903
                    },
                    {
                        lng: -43.4061025,
                        lat: -22.7778181
                    },
                    {
                        lng: -43.4021791,
                        lat: -22.774074
                    },
                    {
                        lng: -43.4022088,
                        lat: -22.7740532
                    },
                    {
                        lng: -43.402218,
                        lat: -22.7740468
                    },
                    {
                        lng: -43.4027578,
                        lat: -22.7736704
                    },
                    {
                        lng: -43.404039,
                        lat: -22.7727771
                    },
                    {
                        lng: -43.4045548,
                        lat: -22.7724175
                    },
                    {
                        lng: -43.4052135,
                        lat: -22.7719582
                    },
                    {
                        lng: -43.405667,
                        lat: -22.7716385
                    },
                    {
                        lng: -43.4059747,
                        lat: -22.7714216
                    },
                    {
                        lng: -43.4061569,
                        lat: -22.7712932
                    },
                    {
                        lng: -43.4066376,
                        lat: -22.7709544
                    },
                    {
                        lng: -43.4072577,
                        lat: -22.7705173
                    },
                    {
                        lng: -43.4077402,
                        lat: -22.7701771
                    },
                    {
                        lng: -43.4090613,
                        lat: -22.7692458
                    },
                    {
                        lng: -43.4092645,
                        lat: -22.7691026
                    },
                    {
                        lng: -43.4099762,
                        lat: -22.7686075
                    },
                    {
                        lng: -43.410488,
                        lat: -22.7682515
                    },
                    {
                        lng: -43.4105348,
                        lat: -22.7682189
                    },
                    {
                        lng: -43.4105432,
                        lat: -22.768213
                    },
                    {
                        lng: -43.4107447,
                        lat: -22.7680692
                    },
                    {
                        lng: -43.4108878,
                        lat: -22.7681436
                    },
                    {
                        lng: -43.4111013,
                        lat: -22.7681199
                    },
                    {
                        lng: -43.4111805,
                        lat: -22.7680656
                    },
                    {
                        lng: -43.4113607,
                        lat: -22.7679372
                    },
                    {
                        lng: -43.4114226,
                        lat: -22.7679175
                    },
                    {
                        lng: -43.4117795,
                        lat: -22.7678038
                    },
                    {
                        lng: -43.4117824,
                        lat: -22.7678029
                    },
                    {
                        lng: -43.4119068,
                        lat: -22.7677633
                    },
                ],
                strokeColor: "#b825b6",
                fillColor: "#b825b6"
            },
            {
                coords: [

                    {
                        lng: -43.4189737,
                        lat: -22.7684221
                    },
                    {
                        lng: -43.4190664,
                        lat: -22.7685205
                    },
                    {
                        lng: -43.4205308,
                        lat: -22.7699839
                    },
                    {
                        lng: -43.4221363,
                        lat: -22.7717329
                    },
                    {
                        lng: -43.4220209,
                        lat: -22.7718712
                    },
                    {
                        lng: -43.4219226,
                        lat: -22.7721531
                    },
                    {
                        lng: -43.4210172,
                        lat: -22.7758784
                    },
                    {
                        lng: -43.4209961,
                        lat: -22.7760459
                    },
                    {
                        lng: -43.4210179,
                        lat: -22.7761831
                    },
                    {
                        lng: -43.4212538,
                        lat: -22.7763529
                    },
                    {
                        lng: -43.4208482,
                        lat: -22.7779838
                    },
                    {
                        lng: -43.4173696,
                        lat: -22.7777676
                    },
                    {
                        lng: -43.4140473,
                        lat: -22.7716257
                    },
                    {
                        lng: -43.4132501,
                        lat: -22.7719874
                    },
                    {
                        lng: -43.4127332,
                        lat: -22.7709874
                    },
                    {
                        lng: -43.4132321,
                        lat: -22.7701003
                    },
                    {
                        lng: -43.4119068,
                        lat: -22.7677633
                    },
                    {
                        lng: -43.4123502,
                        lat: -22.7676688
                    },
                    {
                        lng: -43.4127567,
                        lat: -22.7676541
                    },
                    {
                        lng: -43.4130754,
                        lat: -22.7676403
                    },
                    {
                        lng: -43.4132139,
                        lat: -22.7676572
                    },
                    {
                        lng: -43.4138097,
                        lat: -22.7677758
                    },
                    {
                        lng: -43.4138872,
                        lat: -22.7678014
                    },
                    {
                        lng: -43.4142086,
                        lat: -22.7680263
                    },
                    {
                        lng: -43.414426,
                        lat: -22.7681395
                    },
                    {
                        lng: -43.4144533,
                        lat: -22.7681488
                    },
                    {
                        lng: -43.4146405,
                        lat: -22.7682128
                    },
                    {
                        lng: -43.4146504,
                        lat: -22.7682162
                    },
                    {
                        lng: -43.4149053,
                        lat: -22.7683517
                    },
                    {
                        lng: -43.4150298,
                        lat: -22.7683919
                    },
                    {
                        lng: -43.4151824,
                        lat: -22.7684411
                    },
                    {
                        lng: -43.415537,
                        lat: -22.768477
                    },
                    {
                        lng: -43.4160189,
                        lat: -22.7684688
                    },
                    {
                        lng: -43.4160271,
                        lat: -22.7684687
                    },
                    {
                        lng: -43.41666,
                        lat: -22.7684439
                    },
                    {
                        lng: -43.4166959,
                        lat: -22.7684427
                    },
                    {
                        lng: -43.4167358,
                        lat: -22.7684408
                    },
                    {
                        lng: -43.4170869,
                        lat: -22.7684238
                    },
                    {
                        lng: -43.4171157,
                        lat: -22.7684241
                    },
                    {
                        lng: -43.4174777,
                        lat: -22.7684281
                    },
                    {
                        lng: -43.4178709,
                        lat: -22.7684295
                    },
                    {
                        lng: -43.4182643,
                        lat: -22.7684351
                    },
                    {
                        lng: -43.4182729,
                        lat: -22.7684354
                    },
                    {
                        lng: -43.4186551,
                        lat: -22.7684498
                    },
                    {
                        lng: -43.4189737,
                        lat: -22.7684221
                    },
                ],
                strokeColor: "#b8256a",
                fillColor: "#b8256a"
            },
            {
                coords: [

                    {
                        lng: -43.4353537,
                        lat: -22.7680789
                    },
                    {
                        lng: -43.4350707,
                        lat: -22.7685786
                    },
                    {
                        lng: -43.4350557,
                        lat: -22.768605
                    },
                    {
                        lng: -43.4364668,
                        lat: -22.7691756
                    },
                    {
                        lng: -43.4364696,
                        lat: -22.7691767
                    },
                    {
                        lng: -43.4358871,
                        lat: -22.7704186
                    },
                    {
                        lng: -43.4360004,
                        lat: -22.7705699
                    },
                    {
                        lng: -43.4349559,
                        lat: -22.7728757
                    },
                    {
                        lng: -43.4348824,
                        lat: -22.7730726
                    },
                    {
                        lng: -43.4348443,
                        lat: -22.7731782
                    },
                    {
                        lng: -43.4349031,
                        lat: -22.7732799
                    },
                    {
                        lng: -43.4352733,
                        lat: -22.7739142
                    },
                    {
                        lng: -43.4353397,
                        lat: -22.7739745
                    },
                    {
                        lng: -43.4352084,
                        lat: -22.7739964
                    },
                    {
                        lng: -43.4344595,
                        lat: -22.7756281
                    },
                    {
                        lng: -43.434492,
                        lat: -22.7756982
                    },
                    {
                        lng: -43.4345508,
                        lat: -22.775801
                    },
                    {
                        lng: -43.4342926,
                        lat: -22.7764406
                    },
                    {
                        lng: -43.4341173,
                        lat: -22.7774258
                    },
                    {
                        lng: -43.4340697,
                        lat: -22.7774654
                    },
                    {
                        lng: -43.4339929,
                        lat: -22.7775278
                    },
                    {
                        lng: -43.4333616,
                        lat: -22.7775211
                    },
                    {
                        lng: -43.4333477,
                        lat: -22.7774796
                    },
                    {
                        lng: -43.4333188,
                        lat: -22.7774029
                    },
                    {
                        lng: -43.4332578,
                        lat: -22.7774435
                    },
                    {
                        lng: -43.4329525,
                        lat: -22.7773808
                    },
                    {
                        lng: -43.4329294,
                        lat: -22.7773219
                    },
                    {
                        lng: -43.432895,
                        lat: -22.7773121
                    },
                    {
                        lng: -43.4328054,
                        lat: -22.7773338
                    },
                    {
                        lng: -43.4323158,
                        lat: -22.7771631
                    },
                    {
                        lng: -43.4322894,
                        lat: -22.7771282
                    },
                    {
                        lng: -43.4322785,
                        lat: -22.7770282
                    },
                    {
                        lng: -43.4322057,
                        lat: -22.7770578
                    },
                    {
                        lng: -43.432098,
                        lat: -22.7770793
                    },
                    {
                        lng: -43.4317087,
                        lat: -22.7769151
                    },
                    {
                        lng: -43.4316432,
                        lat: -22.7768726
                    },
                    {
                        lng: -43.4316399,
                        lat: -22.7768705
                    },
                    {
                        lng: -43.4315712,
                        lat: -22.7768259
                    },
                    {
                        lng: -43.4314445,
                        lat: -22.7766509
                    },
                    {
                        lng: -43.4258183,
                        lat: -22.7744916
                    },
                    {
                        lng: -43.4267074,
                        lat: -22.7734325
                    },
                    {
                        lng: -43.4279425,
                        lat: -22.7721062
                    },
                    {
                        lng: -43.4290374,
                        lat: -22.7708324
                    },
                    {
                        lng: -43.4301102,
                        lat: -22.7696215
                    },
                    {
                        lng: -43.4311157,
                        lat: -22.7685117
                    },
                    {
                        lng: -43.4329443,
                        lat: -22.7665239
                    },
                    {
                        lng: -43.4349893,
                        lat: -22.7678788
                    },
                    {
                        lng: -43.4353537,
                        lat: -22.7680789
                    },
                ],
                strokeColor: "#e6e273",
                fillColor: "#e6e273"
            },
            {
                coords: [

                    {
                        lng: -43.4270584,
                        lat: -22.7800766
                    },
                    {
                        lng: -43.4269905,
                        lat: -22.780229
                    },
                    {
                        lng: -43.426908,
                        lat: -22.7804068
                    },
                    {
                        lng: -43.426579,
                        lat: -22.781089
                    },
                    {
                        lng: -43.4265299,
                        lat: -22.7811918
                    },
                    {
                        lng: -43.4265203,
                        lat: -22.78134
                    },
                    {
                        lng: -43.4265191,
                        lat: -22.7813712
                    },
                    {
                        lng: -43.426363,
                        lat: -22.7817175
                    },
                    {
                        lng: -43.4262997,
                        lat: -22.7818577
                    },
                    {
                        lng: -43.4261397,
                        lat: -22.7822126
                    },
                    {
                        lng: -43.4260701,
                        lat: -22.7822408
                    },
                    {
                        lng: -43.4260443,
                        lat: -22.7822512
                    },
                    {
                        lng: -43.4260835,
                        lat: -22.7823372
                    },
                    {
                        lng: -43.4259137,
                        lat: -22.7827139
                    },
                    {
                        lng: -43.4258301,
                        lat: -22.7827362
                    },
                    {
                        lng: -43.4258442,
                        lat: -22.7827995
                    },
                    {
                        lng: -43.4258538,
                        lat: -22.7828424
                    },
                    {
                        lng: -43.4252497,
                        lat: -22.7841865
                    },
                    {
                        lng: -43.4191179,
                        lat: -22.78177
                    },
                    {
                        lng: -43.4194058,
                        lat: -22.7814641
                    },
                    {
                        lng: -43.4204743,
                        lat: -22.7802256
                    },
                    {
                        lng: -43.4223947,
                        lat: -22.7781132
                    },
                    {
                        lng: -43.4270584,
                        lat: -22.7800766
                    },
                ],
                strokeColor: "#e67373",
                fillColor: "#e67373"
            },
            {
                coords: [

                    {
                        lng: -43.4133011,
                        lat: -22.7845642
                    },
                    {
                        lng: -43.4101284,
                        lat: -22.7875062
                    },
                    {
                        lng: -43.408194,
                        lat: -22.7871734
                    },
                    {
                        lng: -43.4071493,
                        lat: -22.7870109
                    },
                    {
                        lng: -43.4065071,
                        lat: -22.7866591
                    },
                    {
                        lng: -43.4064204,
                        lat: -22.7865132
                    },
                    {
                        lng: -43.4063246,
                        lat: -22.7863519
                    },
                    {
                        lng: -43.4061628,
                        lat: -22.7862375
                    },
                    {
                        lng: -43.4060127,
                        lat: -22.7861312
                    },
                    {
                        lng: -43.4057719,
                        lat: -22.7859608
                    },
                    {
                        lng: -43.4057037,
                        lat: -22.7859125
                    },
                    {
                        lng: -43.4055958,
                        lat: -22.7858737
                    },
                    {
                        lng: -43.4055464,
                        lat: -22.785856
                    },
                    {
                        lng: -43.4054227,
                        lat: -22.7858116
                    },
                    {
                        lng: -43.4050335,
                        lat: -22.7856718
                    },
                    {
                        lng: -43.4049918,
                        lat: -22.7856568
                    },
                    {
                        lng: -43.4044675,
                        lat: -22.7854685
                    },
                    {
                        lng: -43.4039875,
                        lat: -22.7852465
                    },
                    {
                        lng: -43.4039235,
                        lat: -22.7852169
                    },
                    {
                        lng: -43.4038737,
                        lat: -22.7851939
                    },
                    {
                        lng: -43.403771,
                        lat: -22.7851464
                    },
                    {
                        lng: -43.4035609,
                        lat: -22.7849722
                    },
                    {
                        lng: -43.4034141,
                        lat: -22.7848504
                    },
                    {
                        lng: -43.4031268,
                        lat: -22.7845196
                    },
                    {
                        lng: -43.4031152,
                        lat: -22.7845005
                    },
                    {
                        lng: -43.4027873,
                        lat: -22.7839624
                    },
                    {
                        lng: -43.4027525,
                        lat: -22.7835097
                    },
                    {
                        lng: -43.4026246,
                        lat: -22.7827955
                    },
                    {
                        lng: -43.4026114,
                        lat: -22.7827216
                    },
                    {
                        lng: -43.4025305,
                        lat: -22.7826076
                    },
                    {
                        lng: -43.4023692,
                        lat: -22.7826221
                    },
                    {
                        lng: -43.4023567,
                        lat: -22.7826189
                    },
                    {
                        lng: -43.4024153,
                        lat: -22.7823886
                    },
                    {
                        lng: -43.4026257,
                        lat: -22.7815424
                    },
                    {
                        lng: -43.4027947,
                        lat: -22.7810227
                    },
                    {
                        lng: -43.4029006,
                        lat: -22.780847
                    },
                    {
                        lng: -43.4033208,
                        lat: -22.7802369
                    },
                    {
                        lng: -43.4036014,
                        lat: -22.7799909
                    },
                    {
                        lng: -43.4042946,
                        lat: -22.7793916
                    },
                    {
                        lng: -43.4061025,
                        lat: -22.7778181
                    },
                    {
                        lng: -43.4108835,
                        lat: -22.7822986
                    },
                    {
                        lng: -43.4112414,
                        lat: -22.782634
                    },
                    {
                        lng: -43.4112866,
                        lat: -22.7826764
                    },
                    {
                        lng: -43.4126834,
                        lat: -22.7839665
                    },
                    {
                        lng: -43.4133011,
                        lat: -22.7845642
                    },
                ],
                strokeColor: "#b8e673",
                fillColor: "#b8e673"
            },
            {
                coords: [

                    {
                        lng: -43.4454013,
                        lat: -22.7959741
                    },
                    {
                        lng: -43.4452822,
                        lat: -22.796178
                    },
                    {
                        lng: -43.4452474,
                        lat: -22.7963833
                    },
                    {
                        lng: -43.4449783,
                        lat: -22.7967717
                    },
                    {
                        lng: -43.4444066,
                        lat: -22.7970925
                    },
                    {
                        lng: -43.4438128,
                        lat: -22.7973577
                    },
                    {
                        lng: -43.4432866,
                        lat: -22.797524
                    },
                    {
                        lng: -43.443031,
                        lat: -22.7975766
                    },
                    {
                        lng: -43.4426293,
                        lat: -22.7975133
                    },
                    {
                        lng: -43.4420163,
                        lat: -22.7976288
                    },
                    {
                        lng: -43.4418497,
                        lat: -22.7977219
                    },
                    {
                        lng: -43.4415525,
                        lat: -22.7976523
                    },
                    {
                        lng: -43.4412839,
                        lat: -22.7976798
                    },
                    {
                        lng: -43.4411582,
                        lat: -22.7977995
                    },
                    {
                        lng: -43.4409047,
                        lat: -22.7978687
                    },
                    {
                        lng: -43.4407346,
                        lat: -22.7977429
                    },
                    {
                        lng: -43.4404435,
                        lat: -22.7975233
                    },
                    {
                        lng: -43.4402602,
                        lat: -22.7974287
                    },
                    {
                        lng: -43.4398929,
                        lat: -22.7972139
                    },
                    {
                        lng: -43.4396056,
                        lat: -22.7972145
                    },
                    {
                        lng: -43.4393324,
                        lat: -22.7972816
                    },
                    {
                        lng: -43.4388574,
                        lat: -22.7973935
                    },
                    {
                        lng: -43.4385841,
                        lat: -22.7977184
                    },
                    {
                        lng: -43.4383543,
                        lat: -22.7978368
                    },
                    {
                        lng: -43.4380676,
                        lat: -22.7977216
                    },
                    {
                        lng: -43.4379511,
                        lat: -22.7976687
                    },
                    {
                        lng: -43.4376175,
                        lat: -22.7976429
                    },
                    {
                        lng: -43.4373991,
                        lat: -22.7977034
                    },
                    {
                        lng: -43.4372884,
                        lat: -22.7977917
                    },
                    {
                        lng: -43.4372329,
                        lat: -22.79784
                    },
                    {
                        lng: -43.4371777,
                        lat: -22.79788
                    },
                    {
                        lng: -43.4369086,
                        lat: -22.797864
                    },
                    {
                        lng: -43.4367131,
                        lat: -22.7977837
                    },
                    {
                        lng: -43.4365599,
                        lat: -22.7978042
                    },
                    {
                        lng: -43.4364547,
                        lat: -22.7977099
                    },
                    {
                        lng: -43.4364218,
                        lat: -22.7975927
                    },
                    {
                        lng: -43.4363428,
                        lat: -22.797524
                    },
                    {
                        lng: -43.4362352,
                        lat: -22.797521
                    },
                    {
                        lng: -43.4361478,
                        lat: -22.7974271
                    },
                    {
                        lng: -43.4360102,
                        lat: -22.7971906
                    },
                    {
                        lng: -43.4358786,
                        lat: -22.7971037
                    },
                    {
                        lng: -43.4359019,
                        lat: -22.7969878
                    },
                    {
                        lng: -43.4364041,
                        lat: -22.7939957
                    },
                    {
                        lng: -43.4364394,
                        lat: -22.793815
                    },
                    {
                        lng: -43.4361336,
                        lat: -22.7926529
                    },
                    {
                        lng: -43.4357616,
                        lat: -22.7911169
                    },
                    {
                        lng: -43.4356557,
                        lat: -22.7904977
                    },
                    {
                        lng: -43.4349506,
                        lat: -22.7887552
                    },
                    {
                        lng: -43.4337807,
                        lat: -22.7858384
                    },
                    {
                        lng: -43.4348358,
                        lat: -22.7857593
                    },
                    {
                        lng: -43.4354296,
                        lat: -22.7857132
                    },
                    {
                        lng: -43.435517,
                        lat: -22.7856192
                    },
                    {
                        lng: -43.4357795,
                        lat: -22.7853713
                    },
                    {
                        lng: -43.4358766,
                        lat: -22.7854078
                    },
                    {
                        lng: -43.4359628,
                        lat: -22.7853696
                    },
                    {
                        lng: -43.4360863,
                        lat: -22.7853705
                    },
                    {
                        lng: -43.436505,
                        lat: -22.7852464
                    },
                    {
                        lng: -43.4369212,
                        lat: -22.7851403
                    },
                    {
                        lng: -43.437258,
                        lat: -22.7851176
                    },
                    {
                        lng: -43.4373387,
                        lat: -22.7850415
                    },
                    {
                        lng: -43.4376726,
                        lat: -22.7847276
                    },
                    {
                        lng: -43.4382472,
                        lat: -22.7841821
                    },
                    {
                        lng: -43.4386416,
                        lat: -22.7843355
                    },
                    {
                        lng: -43.4388,
                        lat: -22.7844265
                    },
                    {
                        lng: -43.4392241,
                        lat: -22.7846782
                    },
                    {
                        lng: -43.4394966,
                        lat: -22.7847399
                    },
                    {
                        lng: -43.4399297,
                        lat: -22.7846857
                    },
                    {
                        lng: -43.4401911,
                        lat: -22.7846869
                    },
                    {
                        lng: -43.4405904,
                        lat: -22.784743
                    },
                    {
                        lng: -43.440761,
                        lat: -22.7848724
                    },
                    {
                        lng: -43.4412031,
                        lat: -22.7853038
                    },
                    {
                        lng: -43.4415408,
                        lat: -22.7852007
                    },
                    {
                        lng: -43.4419062,
                        lat: -22.7850173
                    },
                    {
                        lng: -43.442336,
                        lat: -22.784759
                    },
                    {
                        lng: -43.4426787,
                        lat: -22.7847763
                    },
                    {
                        lng: -43.4429816,
                        lat: -22.7847499
                    },
                    {
                        lng: -43.4432101,
                        lat: -22.78484
                    },
                    {
                        lng: -43.4431479,
                        lat: -22.7850066
                    },
                    {
                        lng: -43.4430543,
                        lat: -22.7852381
                    },
                    {
                        lng: -43.4429436,
                        lat: -22.7854475
                    },
                    {
                        lng: -43.4427618,
                        lat: -22.7857472
                    },
                    {
                        lng: -43.4426092,
                        lat: -22.7860962
                    },
                    {
                        lng: -43.4424564,
                        lat: -22.7865186
                    },
                    {
                        lng: -43.4425778,
                        lat: -22.7868963
                    },
                    {
                        lng: -43.4428061,
                        lat: -22.787175
                    },
                    {
                        lng: -43.4429287,
                        lat: -22.7872718
                    },
                    {
                        lng: -43.4430822,
                        lat: -22.7873947
                    },
                    {
                        lng: -43.4433654,
                        lat: -22.7875191
                    },
                    {
                        lng: -43.4442171,
                        lat: -22.7874754
                    },
                    {
                        lng: -43.4446313,
                        lat: -22.7873034
                    },
                    {
                        lng: -43.4449899,
                        lat: -22.7871034
                    },
                    {
                        lng: -43.4452539,
                        lat: -22.7870065
                    },
                    {
                        lng: -43.4454628,
                        lat: -22.7870859
                    },
                    {
                        lng: -43.4454793,
                        lat: -22.7873175
                    },
                    {
                        lng: -43.4453698,
                        lat: -22.7876804
                    },
                    {
                        lng: -43.4451716,
                        lat: -22.7880184
                    },
                    {
                        lng: -43.4448516,
                        lat: -22.7883891
                    },
                    {
                        lng: -43.4437377,
                        lat: -22.788983
                    },
                    {
                        lng: -43.4433687,
                        lat: -22.7891119
                    },
                    {
                        lng: -43.4430379,
                        lat: -22.7892597
                    },
                    {
                        lng: -43.4428067,
                        lat: -22.7894418
                    },
                    {
                        lng: -43.4427838,
                        lat: -22.7896482
                    },
                    {
                        lng: -43.4430197,
                        lat: -22.7897506
                    },
                    {
                        lng: -43.4431154,
                        lat: -22.7897909
                    },
                    {
                        lng: -43.4435796,
                        lat: -22.7899047
                    },
                    {
                        lng: -43.443621,
                        lat: -22.7900554
                    },
                    {
                        lng: -43.4434532,
                        lat: -22.7903358
                    },
                    {
                        lng: -43.4431684,
                        lat: -22.7906018
                    },
                    {
                        lng: -43.4426194,
                        lat: -22.7908445
                    },
                    {
                        lng: -43.4420983,
                        lat: -22.7909198
                    },
                    {
                        lng: -43.4419441,
                        lat: -22.7909976
                    },
                    {
                        lng: -43.4417103,
                        lat: -22.7911288
                    },
                    {
                        lng: -43.4415186,
                        lat: -22.791294
                    },
                    {
                        lng: -43.4412689,
                        lat: -22.7914803
                    },
                    {
                        lng: -43.4409476,
                        lat: -22.7918278
                    },
                    {
                        lng: -43.4408244,
                        lat: -22.7920494
                    },
                    {
                        lng: -43.4407186,
                        lat: -22.7922876
                    },
                    {
                        lng: -43.4405525,
                        lat: -22.7927029
                    },
                    {
                        lng: -43.4404232,
                        lat: -22.7932594
                    },
                    {
                        lng: -43.4404827,
                        lat: -22.7937041
                    },
                    {
                        lng: -43.4405222,
                        lat: -22.7939253
                    },
                    {
                        lng: -43.4406279,
                        lat: -22.7943791
                    },
                    {
                        lng: -43.4406766,
                        lat: -22.7945198
                    },
                    {
                        lng: -43.4408545,
                        lat: -22.7948953
                    },
                    {
                        lng: -43.4410781,
                        lat: -22.7951351
                    },
                    {
                        lng: -43.4412417,
                        lat: -22.7953521
                    },
                    {
                        lng: -43.4414714,
                        lat: -22.7956723
                    },
                    {
                        lng: -43.4415738,
                        lat: -22.7957703
                    },
                    {
                        lng: -43.4417776,
                        lat: -22.7959169
                    },
                    {
                        lng: -43.441919,
                        lat: -22.7960306
                    },
                    {
                        lng: -43.4420752,
                        lat: -22.7961408
                    },
                    {
                        lng: -43.4423856,
                        lat: -22.7963884
                    },
                    {
                        lng: -43.4428325,
                        lat: -22.7964107
                    },
                    {
                        lng: -43.4434241,
                        lat: -22.7962825
                    },
                    {
                        lng: -43.4436542,
                        lat: -22.7961938
                    },
                    {
                        lng: -43.4440707,
                        lat: -22.796021
                    },
                    {
                        lng: -43.4447494,
                        lat: -22.7957885
                    },
                    {
                        lng: -43.4452604,
                        lat: -22.7958689
                    },
                    {
                        lng: -43.4454013,
                        lat: -22.7959741
                    },
                ],
                strokeColor: "#73e692",
                fillColor: "#73e692"
            },
            {
                coords: [

                    {
                        lng: -43.4329443,
                        lat: -22.7665239
                    },
                    {
                        lng: -43.4311157,
                        lat: -22.7685117
                    },
                    {
                        lng: -43.4301102,
                        lat: -22.7696215
                    },
                    {
                        lng: -43.4290374,
                        lat: -22.7708324
                    },
                    {
                        lng: -43.4279425,
                        lat: -22.7721062
                    },
                    {
                        lng: -43.4267074,
                        lat: -22.7734325
                    },
                    {
                        lng: -43.4258183,
                        lat: -22.7744916
                    },
                    {
                        lng: -43.4247123,
                        lat: -22.7756444
                    },
                    {
                        lng: -43.4242969,
                        lat: -22.7760925
                    },
                    {
                        lng: -43.4233187,
                        lat: -22.7771477
                    },
                    {
                        lng: -43.4223947,
                        lat: -22.7781132
                    },
                    {
                        lng: -43.4208482,
                        lat: -22.7779838
                    },
                    {
                        lng: -43.4212538,
                        lat: -22.7763529
                    },
                    {
                        lng: -43.4210179,
                        lat: -22.7761831
                    },
                    {
                        lng: -43.4209961,
                        lat: -22.7760459
                    },
                    {
                        lng: -43.4210172,
                        lat: -22.7758784
                    },
                    {
                        lng: -43.4219226,
                        lat: -22.7721531
                    },
                    {
                        lng: -43.4220209,
                        lat: -22.7718712
                    },
                    {
                        lng: -43.4221363,
                        lat: -22.7717329
                    },
                    {
                        lng: -43.4205308,
                        lat: -22.7699839
                    },
                    {
                        lng: -43.4190664,
                        lat: -22.7685205
                    },
                    {
                        lng: -43.4189737,
                        lat: -22.7684221
                    },
                    {
                        lng: -43.4190078,
                        lat: -22.7683627
                    },
                    {
                        lng: -43.4190359,
                        lat: -22.7683243
                    },
                    {
                        lng: -43.4194155,
                        lat: -22.7682385
                    },
                    {
                        lng: -43.4194222,
                        lat: -22.7682367
                    },
                    {
                        lng: -43.4196692,
                        lat: -22.7679506
                    },
                    {
                        lng: -43.4198623,
                        lat: -22.7677315
                    },
                    {
                        lng: -43.4201166,
                        lat: -22.7674443
                    },
                    {
                        lng: -43.4204038,
                        lat: -22.7671188
                    },
                    {
                        lng: -43.4206394,
                        lat: -22.7668321
                    },
                    {
                        lng: -43.420894,
                        lat: -22.7665184
                    },
                    {
                        lng: -43.4209537,
                        lat: -22.7664532
                    },
                    {
                        lng: -43.4211648,
                        lat: -22.7662276
                    },
                    {
                        lng: -43.4214212,
                        lat: -22.765938
                    },
                    {
                        lng: -43.4216752,
                        lat: -22.7656232
                    },
                    {
                        lng: -43.4217784,
                        lat: -22.7654731
                    },
                    {
                        lng: -43.421945,
                        lat: -22.7651438
                    },
                    {
                        lng: -43.4219751,
                        lat: -22.7650818
                    },
                    {
                        lng: -43.422182,
                        lat: -22.7647712
                    },
                    {
                        lng: -43.4222279,
                        lat: -22.7647326
                    },
                    {
                        lng: -43.4225161,
                        lat: -22.7644888
                    },
                    {
                        lng: -43.4227298,
                        lat: -22.7643824
                    },
                    {
                        lng: -43.4227419,
                        lat: -22.76438
                    },
                    {
                        lng: -43.4229377,
                        lat: -22.7643409
                    },
                    {
                        lng: -43.4232667,
                        lat: -22.7643404
                    },
                    {
                        lng: -43.4233985,
                        lat: -22.764385
                    },
                    {
                        lng: -43.4234159,
                        lat: -22.7643909
                    },
                    {
                        lng: -43.4234542,
                        lat: -22.7644039
                    },
                    {
                        lng: -43.4235566,
                        lat: -22.7644386
                    },
                    {
                        lng: -43.4238533,
                        lat: -22.7646839
                    },
                    {
                        lng: -43.4241453,
                        lat: -22.7649436
                    },
                    {
                        lng: -43.4244706,
                        lat: -22.7651509
                    },
                    {
                        lng: -43.4245958,
                        lat: -22.7652567
                    },
                    {
                        lng: -43.4247599,
                        lat: -22.7653954
                    },
                    {
                        lng: -43.4249072,
                        lat: -22.7654866
                    },
                    {
                        lng: -43.425086,
                        lat: -22.7655972
                    },
                    {
                        lng: -43.4253963,
                        lat: -22.7658173
                    },
                    {
                        lng: -43.4255043,
                        lat: -22.7658973
                    },
                    {
                        lng: -43.4257058,
                        lat: -22.7660465
                    },
                    {
                        lng: -43.4257939,
                        lat: -22.7661171
                    },
                    {
                        lng: -43.426003,
                        lat: -22.7662848
                    },
                    {
                        lng: -43.4260746,
                        lat: -22.766334
                    },
                    {
                        lng: -43.4264004,
                        lat: -22.7665442
                    },
                    {
                        lng: -43.426699,
                        lat: -22.76678
                    },
                    {
                        lng: -43.4269591,
                        lat: -22.7669744
                    },
                    {
                        lng: -43.4270043,
                        lat: -22.7670082
                    },
                    {
                        lng: -43.4273065,
                        lat: -22.7672404
                    },
                    {
                        lng: -43.4275907,
                        lat: -22.7673654
                    },
                    {
                        lng: -43.4276618,
                        lat: -22.7673968
                    },
                    {
                        lng: -43.4280596,
                        lat: -22.7674004
                    },
                    {
                        lng: -43.4284496,
                        lat: -22.7673264
                    },
                    {
                        lng: -43.4287611,
                        lat: -22.7672974
                    },
                    {
                        lng: -43.4288409,
                        lat: -22.76729
                    },
                    {
                        lng: -43.4292282,
                        lat: -22.7672279
                    },
                    {
                        lng: -43.429614,
                        lat: -22.7671742
                    },
                    {
                        lng: -43.429999,
                        lat: -22.7671132
                    },
                    {
                        lng: -43.4303633,
                        lat: -22.7669792
                    },
                    {
                        lng: -43.4303797,
                        lat: -22.7669729
                    },
                    {
                        lng: -43.4307693,
                        lat: -22.7669418
                    },
                    {
                        lng: -43.4311585,
                        lat: -22.7668811
                    },
                    {
                        lng: -43.4313304,
                        lat: -22.7668483
                    },
                    {
                        lng: -43.4316097,
                        lat: -22.7667246
                    },
                    {
                        lng: -43.4317619,
                        lat: -22.7666423
                    },
                    {
                        lng: -43.4317977,
                        lat: -22.7666229
                    },
                    {
                        lng: -43.4318445,
                        lat: -22.7664626
                    },
                    {
                        lng: -43.4321111,
                        lat: -22.766199
                    },
                    {
                        lng: -43.4322241,
                        lat: -22.7660313
                    },
                    {
                        lng: -43.4329443,
                        lat: -22.7665239
                    },
                ],
                strokeColor: "#73e2e6",
                fillColor: "#73e2e6"
            },
            {
                coords: [

                    {
                        lng: -43.424296,
                        lat: -22.7924517
                    },
                    {
                        lng: -43.4229257,
                        lat: -22.7916163
                    },
                    {
                        lng: -43.4221165,
                        lat: -22.7911555
                    },
                    {
                        lng: -43.4217735,
                        lat: -22.7909755
                    },
                    {
                        lng: -43.4216667,
                        lat: -22.7908989
                    },
                    {
                        lng: -43.4211724,
                        lat: -22.7905434
                    },
                    {
                        lng: -43.4201601,
                        lat: -22.7898442
                    },
                    {
                        lng: -43.4190007,
                        lat: -22.7890595
                    },
                    {
                        lng: -43.4185134,
                        lat: -22.7887171
                    },
                    {
                        lng: -43.4180787,
                        lat: -22.7884362
                    },
                    {
                        lng: -43.4172403,
                        lat: -22.7880315
                    },
                    {
                        lng: -43.4166387,
                        lat: -22.7879523
                    },
                    {
                        lng: -43.4159337,
                        lat: -22.7878684
                    },
                    {
                        lng: -43.4150081,
                        lat: -22.7879089
                    },
                    {
                        lng: -43.4141133,
                        lat: -22.7879349
                    },
                    {
                        lng: -43.4132002,
                        lat: -22.7882387
                    },
                    {
                        lng: -43.4151724,
                        lat: -22.7860284
                    },
                    {
                        lng: -43.4154991,
                        lat: -22.7856623
                    },
                    {
                        lng: -43.4160085,
                        lat: -22.7851474
                    },
                    {
                        lng: -43.4170148,
                        lat: -22.7840717
                    },
                    {
                        lng: -43.4172209,
                        lat: -22.7837992
                    },
                    {
                        lng: -43.4178995,
                        lat: -22.7831128
                    },
                    {
                        lng: -43.4180232,
                        lat: -22.7829677
                    },
                    {
                        lng: -43.4181249,
                        lat: -22.7828488
                    },
                    {
                        lng: -43.4182386,
                        lat: -22.7827275
                    },
                    {
                        lng: -43.418437,
                        lat: -22.7824979
                    },
                    {
                        lng: -43.4187379,
                        lat: -22.7821668
                    },
                    {
                        lng: -43.4187807,
                        lat: -22.7821222
                    },
                    {
                        lng: -43.4191179,
                        lat: -22.78177
                    },
                    {
                        lng: -43.4252497,
                        lat: -22.7841865
                    },
                    {
                        lng: -43.4256839,
                        lat: -22.7843525
                    },
                    {
                        lng: -43.4257403,
                        lat: -22.7844454
                    },
                    {
                        lng: -43.4258513,
                        lat: -22.784417
                    },
                    {
                        lng: -43.4258526,
                        lat: -22.7844175
                    },
                    {
                        lng: -43.4272836,
                        lat: -22.7849659
                    },
                    {
                        lng: -43.4273,
                        lat: -22.7850376
                    },
                    {
                        lng: -43.4273728,
                        lat: -22.7850053
                    },
                    {
                        lng: -43.4273791,
                        lat: -22.7850024
                    },
                    {
                        lng: -43.4275287,
                        lat: -22.7850598
                    },
                    {
                        lng: -43.4275657,
                        lat: -22.7851445
                    },
                    {
                        lng: -43.4275564,
                        lat: -22.7851656
                    },
                    {
                        lng: -43.4268873,
                        lat: -22.7866894
                    },
                    {
                        lng: -43.4267328,
                        lat: -22.7870412
                    },
                    {
                        lng: -43.4264682,
                        lat: -22.787649
                    },
                    {
                        lng: -43.4264655,
                        lat: -22.7876548
                    },
                    {
                        lng: -43.42626,
                        lat: -22.7880993
                    },
                    {
                        lng: -43.4261433,
                        lat: -22.7883489
                    },
                    {
                        lng: -43.4254818,
                        lat: -22.7897938
                    },
                    {
                        lng: -43.4254581,
                        lat: -22.7898481
                    },
                    {
                        lng: -43.4249035,
                        lat: -22.7911293
                    },
                    {
                        lng: -43.4247394,
                        lat: -22.7915083
                    },
                    {
                        lng: -43.4245451,
                        lat: -22.7919569
                    },
                    {
                        lng: -43.424296,
                        lat: -22.7924517
                    },
                ],
                strokeColor: "#7388e6",
                fillColor: "#7388e6"
            },
            {
                coords: [

                    {
                        lng: -43.4151724,
                        lat: -22.7860284
                    },
                    {
                        lng: -43.4132002,
                        lat: -22.7882387
                    },
                    {
                        lng: -43.4114413,
                        lat: -22.7901183
                    },
                    {
                        lng: -43.4102923,
                        lat: -22.7914197
                    },
                    {
                        lng: -43.4100673,
                        lat: -22.7913682
                    },
                    {
                        lng: -43.4096339,
                        lat: -22.7906551
                    },
                    {
                        lng: -43.4096074,
                        lat: -22.7906114
                    },
                    {
                        lng: -43.4094245,
                        lat: -22.7903165
                    },
                    {
                        lng: -43.4091619,
                        lat: -22.7900025
                    },
                    {
                        lng: -43.4087485,
                        lat: -22.7898365
                    },
                    {
                        lng: -43.4087255,
                        lat: -22.7898272
                    },
                    {
                        lng: -43.4086592,
                        lat: -22.7898029
                    },
                    {
                        lng: -43.4082721,
                        lat: -22.7896609
                    },
                    {
                        lng: -43.4082545,
                        lat: -22.7896515
                    },
                    {
                        lng: -43.4081566,
                        lat: -22.7895996
                    },
                    {
                        lng: -43.4081451,
                        lat: -22.7895935
                    },
                    {
                        lng: -43.4081385,
                        lat: -22.7895899
                    },
                    {
                        lng: -43.408101,
                        lat: -22.7895415
                    },
                    {
                        lng: -43.4078047,
                        lat: -22.7891582
                    },
                    {
                        lng: -43.4074394,
                        lat: -22.7886858
                    },
                    {
                        lng: -43.4074078,
                        lat: -22.7886077
                    },
                    {
                        lng: -43.4073605,
                        lat: -22.7884973
                    },
                    {
                        lng: -43.4073475,
                        lat: -22.7884669
                    },
                    {
                        lng: -43.4072962,
                        lat: -22.7883471
                    },
                    {
                        lng: -43.4069279,
                        lat: -22.7874768
                    },
                    {
                        lng: -43.406835,
                        lat: -22.7872573
                    },
                    {
                        lng: -43.4068213,
                        lat: -22.7872248
                    },
                    {
                        lng: -43.4067151,
                        lat: -22.7870327
                    },
                    {
                        lng: -43.4065456,
                        lat: -22.786726
                    },
                    {
                        lng: -43.4065282,
                        lat: -22.7866945
                    },
                    {
                        lng: -43.4065071,
                        lat: -22.7866591
                    },
                    {
                        lng: -43.4071493,
                        lat: -22.7870109
                    },
                    {
                        lng: -43.408194,
                        lat: -22.7871734
                    },
                    {
                        lng: -43.4101284,
                        lat: -22.7875062
                    },
                    {
                        lng: -43.4133011,
                        lat: -22.7845642
                    },
                    {
                        lng: -43.4151724,
                        lat: -22.7860284
                    },
                ],
                strokeColor: "#9f73e6",
                fillColor: "#9f73e6"
            },
            {
                coords: [

                    {
                        lng: -43.4259476,
                        lat: -22.8009863
                    },
                    {
                        lng: -43.4259403,
                        lat: -22.8009825
                    },
                    {
                        lng: -43.4257852,
                        lat: -22.8009006
                    },
                    {
                        lng: -43.4255572,
                        lat: -22.8007783
                    },
                    {
                        lng: -43.4252975,
                        lat: -22.800639
                    },
                    {
                        lng: -43.4249809,
                        lat: -22.800387
                    },
                    {
                        lng: -43.4246579,
                        lat: -22.8001868
                    },
                    {
                        lng: -43.4243866,
                        lat: -22.8000446
                    },
                    {
                        lng: -43.4241152,
                        lat: -22.7998605
                    },
                    {
                        lng: -43.4237761,
                        lat: -22.7997119
                    },
                    {
                        lng: -43.4233885,
                        lat: -22.7994923
                    },
                    {
                        lng: -43.4230073,
                        lat: -22.7993243
                    },
                    {
                        lng: -43.4225615,
                        lat: -22.799221
                    },
                    {
                        lng: -43.4216784,
                        lat: -22.7988326
                    },
                    {
                        lng: -43.4215197,
                        lat: -22.7987628
                    },
                    {
                        lng: -43.4221698,
                        lat: -22.7973516
                    },
                    {
                        lng: -43.4224607,
                        lat: -22.7967081
                    },
                    {
                        lng: -43.4225934,
                        lat: -22.7964081
                    },
                    {
                        lng: -43.4229022,
                        lat: -22.795682
                    },
                    {
                        lng: -43.4230059,
                        lat: -22.7954589
                    },
                    {
                        lng: -43.4235842,
                        lat: -22.7941065
                    },
                    {
                        lng: -43.4237552,
                        lat: -22.7937064
                    },
                    {
                        lng: -43.4239827,
                        lat: -22.793186
                    },
                    {
                        lng: -43.424296,
                        lat: -22.7924517
                    },
                    {
                        lng: -43.4245451,
                        lat: -22.7919569
                    },
                    {
                        lng: -43.4247394,
                        lat: -22.7915083
                    },
                    {
                        lng: -43.4249035,
                        lat: -22.7911293
                    },
                    {
                        lng: -43.4254581,
                        lat: -22.7898481
                    },
                    {
                        lng: -43.4279068,
                        lat: -22.7907916
                    },
                    {
                        lng: -43.4364041,
                        lat: -22.7939957
                    },
                    {
                        lng: -43.4359019,
                        lat: -22.7969878
                    },
                    {
                        lng: -43.4355559,
                        lat: -22.7969206
                    },
                    {
                        lng: -43.4352521,
                        lat: -22.7968534
                    },
                    {
                        lng: -43.4350209,
                        lat: -22.7967019
                    },
                    {
                        lng: -43.4345396,
                        lat: -22.7966849
                    },
                    {
                        lng: -43.43432,
                        lat: -22.7966736
                    },
                    {
                        lng: -43.4341555,
                        lat: -22.7965388
                    },
                    {
                        lng: -43.4339671,
                        lat: -22.7963649
                    },
                    {
                        lng: -43.4337838,
                        lat: -22.7963759
                    },
                    {
                        lng: -43.4336497,
                        lat: -22.7963197
                    },
                    {
                        lng: -43.433423,
                        lat: -22.7964431
                    },
                    {
                        lng: -43.4333012,
                        lat: -22.7966174
                    },
                    {
                        lng: -43.4330213,
                        lat: -22.7967354
                    },
                    {
                        lng: -43.4325548,
                        lat: -22.7968297
                    },
                    {
                        lng: -43.4322566,
                        lat: -22.7969869
                    },
                    {
                        lng: -43.4318369,
                        lat: -22.7972616
                    },
                    {
                        lng: -43.4316237,
                        lat: -22.7974859
                    },
                    {
                        lng: -43.4313855,
                        lat: -22.7977442
                    },
                    {
                        lng: -43.4312354,
                        lat: -22.7979056
                    },
                    {
                        lng: -43.4308517,
                        lat: -22.7983492
                    },
                    {
                        lng: -43.4303759,
                        lat: -22.7987484
                    },
                    {
                        lng: -43.4301744,
                        lat: -22.7988553
                    },
                    {
                        lng: -43.4298019,
                        lat: -22.7988947
                    },
                    {
                        lng: -43.4296187,
                        lat: -22.798996
                    },
                    {
                        lng: -43.4293867,
                        lat: -22.7991367
                    },
                    {
                        lng: -43.4291729,
                        lat: -22.7991987
                    },
                    {
                        lng: -43.4290203,
                        lat: -22.7991198
                    },
                    {
                        lng: -43.4287577,
                        lat: -22.798996
                    },
                    {
                        lng: -43.4285072,
                        lat: -22.7989678
                    },
                    {
                        lng: -43.4280661,
                        lat: -22.7990693
                    },
                    {
                        lng: -43.4276617,
                        lat: -22.7992779
                    },
                    {
                        lng: -43.4274997,
                        lat: -22.7994517
                    },
                    {
                        lng: -43.4272312,
                        lat: -22.7996844
                    },
                    {
                        lng: -43.4270785,
                        lat: -22.7998361
                    },
                    {
                        lng: -43.4269867,
                        lat: -22.8001002
                    },
                    {
                        lng: -43.4269862,
                        lat: -22.8003531
                    },
                    {
                        lng: -43.4268818,
                        lat: -22.8005444
                    },
                    {
                        lng: -43.4265318,
                        lat: -22.8007133
                    },
                    {
                        lng: -43.4261635,
                        lat: -22.8008432
                    },
                    {
                        lng: -43.4259476,
                        lat: -22.8009863
                    },
                ],
                strokeColor: "#dc73e6",
                fillColor: "#dc73e6"
            },
        ];

        const locaisEleitorais = {!! json_encode($locais_eleitorais) !!};
        const secoesEleitorais = {!! json_encode($secoes_eleitorais) !!};
        const map = L.map('map').setView([-22.7862072, -43.4252523], 15);
        map.doubleClickZoom.disable();

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        polygons.forEach((polygon) => {
            L.polygon(polygon.coords, {
                color: polygon.strokeColor,
                fillColor: polygon.fillColor,
                fillOpacity: 0.3,
                weight: 2
            }).addTo(map);
        })

        const icons = {
            faint: L.icon({
                iconUrl: "{{ asset('img/markers/marker-faint.png') }}",
                shadowUrl: "{{ asset('img/markers/marker-shadow.png') }}",
                shadowSize: [15, 25],
                shadowAnchor: [2, 10],
                iconSize: [20, 34],
                iconAnchor: [10, 17],
                popupAnchor: [0, -15]
            }),
            green: L.icon({
                iconUrl: "{{ asset('img/markers/marker-green.png') }}",
                shadowUrl: "{{ asset('img/markers/marker-shadow.png') }}",
                shadowSize: [15, 25],
                shadowAnchor: [2, 10],
                iconSize: [20, 34],
                iconAnchor: [10, 17],
                popupAnchor: [0, -15]
            }),
            yellow: L.icon({
                iconUrl: "{{ asset('img/markers/marker-yellow.png') }}",
                shadowUrl: "{{ asset('img/markers/marker-shadow.png') }}",
                shadowSize: [15, 25],
                shadowAnchor: [2, 10],
                iconSize: [20, 34],
                iconAnchor: [10, 17],
                popupAnchor: [0, -15]
            }),
            orange: L.icon({
                iconUrl: "{{ asset('img/markers/marker-orange.png') }}",
                shadowUrl: "{{ asset('img/markers/marker-shadow.png') }}",
                shadowSize: [15, 25],
                shadowAnchor: [2, 10],
                iconSize: [20, 34],
                iconAnchor: [10, 17],
                popupAnchor: [0, -15]
            }),
            red: L.icon({
                iconUrl: "{{ asset('img/markers/marker-red.png') }}",
                shadowUrl: "{{ asset('img/markers/marker-shadow.png') }}",
                shadowSize: [15, 25],
                shadowAnchor: [2, 10],
                iconSize: [20, 34],
                iconAnchor: [10, 17],
                popupAnchor: [0, -15]
            }),
        }

        const locaisEleitoraisData = {!! $locais_eleitorais_json !!};
        const maxPessoas = {!! json_encode($max_pessoas_local_eleitoral) !!};

        locaisEleitoraisData.forEach(local => {
            console.log(local);
            const totalPessoas = local.secoes.reduce((acc, current) => acc + current.grupos.length, 0);

            const totalVotos = local.secoes.reduce((pcc, secao) => pcc + secao.eleitores_aptos, 0);

            let popupContent = `<div class="popup" style="width: 300px; height: 200px; overflow-y: auto;">
        <p class="popup-nome">${local.nome_local}</p>
        <p class="popup-tipo">Total de Pessoas: ${totalPessoas} / ${totalVotos}</p>`;
                
            // Verifica se há eleitores antes de renderizar a tabela
            if (totalPessoas > 0) {
                popupContent += `<table class="popup-tabela">
            <thead>
                <tr>
                    <th>Eleitor</th>
                    <th>Seção</th>
                    <th>Líder</th>
                </tr>
            </thead>
            <tbody>`;

                local.secoes.forEach(secao => {
                    secao.eleitores.forEach(eleitor => {
                        popupContent += `<tr>
                    <td>${eleitor.nome}</td>
                    <td>${eleitor.secao}</td>
                    <td>${eleitor.lider}</td>
                </tr>`;
                    });
                });

                popupContent += `</tbody>
            </table>`;
            } else {
                popupContent += `<div  class="popup-content">
                    <h3 style="color:black;padding-top:20%">Nenhum eleitor encontrado nesta seção.</h3>
                </div>`;
            }

            popupContent += `</div>`;

            const iconKey = totalPessoas <= (maxPessoas / 4) ? "red" :
                totalPessoas <= (maxPessoas / 4) * 2 ? "orange" :
                totalPessoas <= (maxPessoas / 4) * 3 ? "yellow" :
                "green";

            L.marker([
                    parseFloat(local["lat"]),
                    parseFloat(local["lng"])
                ], {
                    icon: icons[iconKey],
                    title: local["nome_local"]
                })
                .bindPopup(popupContent, {
                    closeButton: false,
                    maxWidth: 400
                })
                .addTo(map);
        });
    </script>
    <script>
        const total_por_bairro = document.getElementById('myChart');
        const total_liders_bairro = document.getElementById('myChart1');
        const total_colabora_bairro = document.getElementById('myChart2');
        const total_indeciso_bairro = document.getElementById('myChart3');
        const idade_colaboradores = document.getElementById('myChart4');
        const sexo_lideranca = document.getElementById('myChart5');
        const sexo_colaborador = document.getElementById('myChart6');

        ////////////////////////////////////////////////////
        let bairro = [];
        let qtd = [];

        @foreach ($total_por_bairro as $t)
            bairro.push("{{ $t->bairro }}");
            qtd.push({{ $t->qtd }});
        @endforeach

        new Chart(total_por_bairro, {
            type: 'bar',
            data: {
                labels: bairro,
                datasets: [{
                    label: 'Total',
                    data: qtd,
                    borderWidth: 1
                }]
            },
            plugins: [ChartDataLabels]
        });
        ////////////////////////////////////////////////////

        let bairro_1 = [];
        let qtd_1 = [];
        @foreach ($total_liders_bairro as $t)
            bairro_1.push("{{ $t->bairro }}");
            qtd_1.push({{ $t->qtd }});
        @endforeach

        new Chart(total_liders_bairro, {
            type: 'bar',
            data: {
                labels: bairro_1,
                datasets: [{
                    label: 'Total',
                    data: qtd_1,
                    borderWidth: 1
                }]
            },
            plugins: [ChartDataLabels]
        });
        ////////////////////////////////////////////////////

        let bairro_2 = [];
        let qtd_2 = [];
        @foreach ($total_colabora_bairro as $t)
            bairro_2.push("{{ $t->bairro }}");
            qtd_2.push({{ $t->qtd }});
        @endforeach

        new Chart(total_colabora_bairro, {
            type: 'bar',
            data: {
                labels: bairro_2,
                datasets: [{
                    label: 'Total',
                    data: qtd_2,
                    borderWidth: 1
                }]
            },
            plugins: [ChartDataLabels]
        });
        ////////////////////////////////////////////////////

        let bairro_3 = [];
        let qtd_3 = [];
        @foreach ($total_indeciso_bairro as $t)
            bairro_3.push("{{ $t->bairro }}");
            qtd_3.push({{ $t->qtd }});
        @endforeach

        new Chart(total_indeciso_bairro, {
            type: 'bar',
            data: {
                labels: bairro_3,
                datasets: [{
                    label: 'Total',
                    data: qtd_3,
                    borderWidth: 1
                }]
            },
            plugins: [ChartDataLabels]
        });

        ////////////////////////////////////////////////////

        let idade = [];
        let qtd_idade = [];
        @foreach ($idades as $t)
            idade.push("{{ $t->idade }}");
            qtd_idade.push({{ $t->total }});
        @endforeach

        new Chart(idade_colaboradores, {
            type: 'bar',
            data: {
                labels: idade,
                datasets: [{
                    label: 'Total',
                    data: qtd_idade,
                    borderWidth: 1
                }]
            },
            plugins: [ChartDataLabels]
        });
        ////////////////////////////////////////////////////

         ////////////////////////////////////////////////////

         let sexolider = [];
        let qtd_sexo_lider = [];
        @foreach ($total_liders_sexo as $t)
            sexolider.push("{{ $t->sexo }}");
            qtd_sexo_lider.push({{ $t->qtd }});
        @endforeach

        new Chart(sexo_lideranca, {
            type: 'bar',
            data: {
                labels: sexolider,
                datasets: [{
                    label: 'Total',
                    data: qtd_sexo_lider,
                    borderWidth: 1
                }]
            },
            plugins: [ChartDataLabels]
        });
        // ////////////////////////////////////////////////////

        //  ////////////////////////////////////////////////////

         let sexocolabora = [];
        let qtd_sexo_colabora = [];
        @foreach ($total_colabora_sexo as $t)
            sexocolabora.push("{{ $t->sexo }}");
            qtd_sexo_colabora.push({{ $t->qtd }});
        @endforeach

        new Chart(sexo_colaborador, {
            type: 'bar',
            data: {
                labels: sexocolabora,
                datasets: [{
                    label: 'Total',
                    data: qtd_sexo_colabora,
                    borderWidth: 1
                }]
            },
            plugins: [ChartDataLabels]
        });
        ////////////////////////////////////////////////////
    </script>
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script>
        const myTable = $("#myTable").DataTable({
            language: {
                'url': '{{ asset('assets/js/portugues.json') }}',
                "decimal": ",",
                "thousands": ".",
            },
            order: [
                [4, "asc"]
            ],
            stateSave: true,
            stateDuration: -1,
            responsive: true,
        });
    </script>
@endpush
