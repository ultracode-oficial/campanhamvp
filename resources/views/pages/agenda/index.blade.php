@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
<link rel="stylesheet" href="assets/css/jquery.dataTables.min.css">
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
                                    <h6 class="mb-0">Minha Agenda</h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <div class="row mb-lg-7">
                                <div class="col-xl-9">
                                    <div class="card card-calendar" style="padding: 16px;">
                                        <div id='calendar'></div>
                                    </div>
                                </div>
                                <div class="col-xl-3">
                                    <div class="row">
                                        <div class="col-xl-12 col-md-6 mt-xl-0 mt-4">
                                            <div class="card">
                                                <div class="card-header p-3 pb-0">
                                                    <h6 class="mb-0">Proximos Eventos</h6>
                                                </div>
                                                <div class="card-body border-radius-lg p-3">
                                                    @foreach ($prox_eventos as $prox_evento)
                                                        <div class="d-flex mt-4">
                                                            <div>
                                                                <div
                                                                    class="icon icon-shape bg-success-soft shadow text-center border-radius-md shadow-none">
                                                                    <i class="ni ni-calendar-grid-58 text-lg text-success text-gradient opacity-10"
                                                                        aria-hidden="true"></i>
                                                                </div>
                                                            </div>
                                                            <div class="ms-3">
                                                                <div class="numbers">
                                                                    <h6 class="mb-1 text-dark text-sm">{{$prox_evento->title}}
                                                                    </h6>
                                                                    <span class="text-sm">{{ date('d/m/Y', strtotime($prox_evento->start)) }}, as {{$prox_evento->hora}}</span>
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
                </div>
            </div>
        </div>


        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Novo Agendamento</h5>

                    </div>
                    <form action="{{ url('/agenda') }}" method="post">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="">Titulo</label>
                                <input type="text" class="form-control" name="title" id="title">
                            </div>
                            <div class="form-group">
                                <label for="">data</label>
                                <input type="text" class="form-control" name="start" id="start"
                                    style="background: #EEE; cursor: not-allowed; color: #777" readonly>
                            </div>
                            <div class="form-group">
                                <label for="">Hora</label>
                                <input type="time" class="form-control" name="hora" id="hora" required>
                            </div>

                            <div class="form-group">
                                <label for="">Descrição</label>
                                <textarea type="text" class="form-control" name="descricao" id="descricao"></textarea>
                            </div>


                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="btn_salvar" class="btn btn-primary">Agendar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="modal fade" id="modaleventclick" tabindex="-1" role="dialog" aria-labelledby="modaleventclickLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modaleventclickLabel">Detalhes da Agenda</h5>
                    </div>
                    <form>
                        <div class="modal-body">
                            {{-- <div style="display:inline-block;font-size: 16px;" hidden id="id"></div> --}}
                            <div>
                                <div style="display:inline-block;font-weight: bolder;font-size: 16px;">Titulo:
                                </div>
                                <div style="display:inline-block;font-size: 16px;" id="title"></div>
                            </div>

                            <div>
                                <div style="display:inline-block;font-weight: bolder;font-size: 16px;">Data:
                                </div>
                                <div style="display:inline-block;font-size: 16px;" id="start"></div>
                            </div>

                            <div>
                                <div style="display:inline-block;font-weight: bolder;font-size: 16px;">Hora:
                                </div>
                                <div style="display:inline-block;font-size: 16px;" id="hora"></div>
                            </div>

                            <div>
                                <div style="display:inline-block;font-weight: bolder;font-size: 16px;">Descrição:
                                </div>
                                <div style="display:inline-block;font-size: 16px;" id="descricao"></div>
                            </div>

                        </div>

                        <div class="modal-footer">

                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="modal fade" id="modalaniversario" tabindex="-1" role="dialog" aria-labelledby="modalaniversarioLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalaniversarioLabel">Detalhes do Aniversariante</h5>
                    </div>
                    <form>
                        <div class="modal-body">
                            {{-- <div style="display:inline-block;font-size: 16px;" hidden id="id"></div> --}}
                            <div>
                                <div style="display:inline-block;font-weight: bolder;font-size: 16px;">Nome:
                                </div>
                                <div style="display:inline-block;font-size: 16px;" id="nome"></div>
                            </div>
                            <div>
                                <div style="display:inline-block;font-weight: bolder;font-size: 16px;">Telefone:
                                </div>
                                <div style="display:inline-block;font-size: 16px;" id="telefone"></div>
                            </div>

                        </div>

                        <div class="modal-footer">

                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection

    @push('js')
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="{{ asset('assets/fullcalendar-6.1.11/dist/index.global.min.js') }}"></script>
        

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    
                    locale: 'pt-br',
                    dateClick: function(info) {

                        $("#exampleModal").modal("show");
                        $("#start").val(info.dateStr);

                    },
                    eventClick: function(arg) {

                        if(arg.event.extendedProps.tipo == 'AGENDA'){

                        
                            $("#modaleventclick #id").text(arg.event.id);
                            $("#modaleventclick #title").text(arg.event.extendedProps.texto);
                            $("#modaleventclick #start").text(arg.event.extendedProps.data);
                            $("#modaleventclick #hora").text(arg.event.extendedProps.hora);
                            $("#modaleventclick #descricao").text(arg.event.extendedProps.descricao);

                            var deleteButton =
                                '<a id="deleteButton" class="btn btn-danger btn-xs action botao_acao btn_delete" ' +
                                'data-delete="' + arg.event.id + '" data-toggle="tooltip" ' +
                                'data-placement="bottom" title="Deletar Pessoa">' +
                                '<i class="fa fa-trash-o"></i></a>';

                            $("#modaleventclick .modal-footer").html(deleteButton);

                            $("#modaleventclick").modal("show");
                        }else{
                            $("#modalaniversario #nome").text(arg.event.extendedProps.nome);
                            $("#modalaniversario #telefone").text(arg.event.extendedProps.telefone);

                            $("#modalaniversario").modal("show");   
                        }
                    },
                    events: [
                        @foreach ($agendas as $agenda)
                            {
                                id: '{{ $agenda->id }}',
                                title: '{{ $agenda->hora }} ' + '{{ $agenda->title }}',
                                start: '{{ $agenda->start }}',
                                texto: '{{ $agenda->title }}',
                                data: '{{ date('d/m/Y', strtotime($agenda->start)) }}',
                                hora: '{{ $agenda->hora }}',
                                descricao: '{{ $agenda->descricao }}',
                                tipo: 'AGENDA',
                            },
                        @endforeach
                        @foreach ($aniversarios as $aniversario)
                        @if(isset($aniversario->nascimento))
                        {
                            
                            tipo: 'ANIVERSARIO',
                            title:  ' {{ $aniversario->nome }}',
                            nome:  '{{ $aniversario->nome }}',
                            telefone: '{{$aniversario->telefone}}',
                            start: '{{$ano}}-{{ date('m-d', strtotime($aniversario->nascimento)) }}',                            
                        },
                        @endif
                        @endforeach
                    ]
                });

                calendar.render();
            });
        </script>
        <script type="text/javascript">
            $(document).ready(function() {
                $("body").on("click", "a.btn_delete", function(e) {
                    // Evitar que a página seja recarregada	
                    e.preventDefault();
                    let id = $(this).data('delete');
                    console.log(id);
                    swal({
                        title: "Atenção!",
                        text: 'Você esta prestes a EXCLUIR uma data da Agenda',
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
                            }
                        }
                    }).then(function(resultado) {
                        console.log("chegou");
                        if (resultado === 'excluir') {
                            $.post("{{ url('/agenda') }}/" + id, {
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
        </script>
    @endpush
