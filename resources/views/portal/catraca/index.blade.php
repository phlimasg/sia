@extends('adminlte::page')

@section('title', 'Acesso/Catraca')
@section('content_header')
    <h1><i class="fa fa-500"></i> Acessos nos últimos 30 dias</h1>
@stop

@section('content')

    <div class="box">
        <div class="box-header">
           Listagem de acessos
        </div>
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
              <tbody><tr>
                <th>#</th>
                <th>Dia</th>
                <th>Hora</th>
                <th>Ação</th>              
              </tr>
              @forelse ($catraca as $i)
              @if ($i->MOV_ENTRADASAIDA == 1)
                <tr class="text-success">                  
                @else
                <tr class="text-danger">                  
              @endif
                <td>{{$i->EQPI_NUMERO}}</td>
                  <td>{{date('d/m/Y',strtotime($i->MOV_DATAHORA))}}</td>
                  <td>{{date('H:i:s',strtotime($i->MOV_DATAHORA))}}</td>
                  @if ($i->MOV_ENTRADASAIDA == 1)
                <td>{{$i->MOV_ENTRADASAIDA}} - Entrada</td>
                  @else 
                  <td>{{$i->MOV_ENTRADASAIDA}} - Saída</td>
                  @endif
                </tr>
              @empty
              Nenhum comunicado para exibir    
              @endforelse
                  
            </tbody></table>
          </div>
    </div>
@stop

@section('js')

    
@endsection