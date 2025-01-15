<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatórios</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 12px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .table, .table th, .table td {
            border: 1px solid #ccc;
        }
        .table th, .table td {
            padding: 8px;
            text-align: left;
        }
        .text-center {
            text-align: center;
        }
        .text-uppercase {
            text-transform: uppercase;
        }
        .text-secondary {
            color: #6c757d;
        }
        .text-xs {
            font-size: 10px;
        }
        .font-weight-bolder {
            font-weight: bold;
        }
        .avatar {
            border-radius: 50%;
            width: 30px;
            height: 30px;
        }
        .d-flex {
            display: flex;
            align-items: center;
        }
        .me-3 {
            margin-right: 10px;
        }
        .mb-15 {
            margin-bottom: 15;
        }
        .px-2 {
            padding-left: 8px;
            padding-right: 8px;
        }
        .py-1 {
            padding-top: 4px;
            padding-bottom: 4px;
        }
        .btn {
            padding: 5px 10px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        .btn-warning {
            background-color: #ffc107;
            color: white;
        }
        .font-size-18 {
            font-size: 18
        }
    </style>
</head>
<body>
    <div class="text-center text-uppercase mb-15 font-size-18">
            Liderança: {{$lider[0]['nome']}}
    </div>
    <div class="card-body p-3">
        <div class="card">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xs font-weight-bolder">Nome</th>
                            <th class="text-uppercase text-secondary text-xs font-weight-bolder">Telefone</th>
                            <th class="text-uppercase text-secondary text-xs font-weight-bolder">Endereço</th>
                            <th class="text-uppercase text-secondary text-xs font-weight-bolder">Colegio Eleitoral</th>
                            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder">Zona/Seção</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($colaboradores as $colaborador)
                            <tr>
                                <td class="text-uppercase">{{$colaborador->nome}} @if(isset($colaborador->apelido)) ({{$colaborador->apelido}}) @endif</td>
                                <td class="text-uppercase">{{$colaborador->telefone}}</td>
                                <td class="text-uppercase">{{$colaborador->rua}}, {{$colaborador->bairro}}</td>
                                <td class="text-uppercase">{{$colaborador->nome_local}}</td>
                                <td class="text-uppercase">{{$colaborador->zona}}/{{$colaborador->secao}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>