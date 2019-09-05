@extends('adminlte::page')

@section('title', 'Acessos/Catraca')
@section('content_header')
    <h1><i class="fa fa-500"></i> Acessos nos últimos 30 dias</h1>
@stop

@section('content')
<div class="row">
  <div class="col-md-12">
    <!-- Custom Tabs -->
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        @php
          $count = 1;
        @endphp
        @forelse ($acesso as $i)
        @if ($count==1)
          <li class="active"><a href="#{{$i->RA}}" data-toggle="tab" aria-expanded="true"><i class="fa fa-user"></i> {{$i->NOME_ALUNO}}</a></li>
          @php $count = 0; @endphp
        @else
          <li class=""><a href="#{{$i->RA}}" data-toggle="tab" aria-expanded="true"><i class="fa fa-user"></i> {{$i->NOME_ALUNO}}</a></li>
        @endif
        @empty
            Nenhuma aluno para mostrar
        @endforelse
      </ul>

      <div class="tab-content">
        @forelse ($acesso as $i)
          @if ($count==0)
            <div class="tab-pane active" id="{{$i->RA}}">
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                      <tbody><tr>
                        <th>#</th>
                        <th>Dia</th>
                        <th>Hora</th>
                        <th>Ação</th>              
                      </tr>
                      @forelse ($catraca as $c)
                          @if ($i->RA == $c->PES_NUMERO)
                            @if ($c->MOV_ENTRADASAIDA == 1)
                              <tr class="text-success">                  
                            @else
                              <tr class="text-danger">                  
                            @endif
                            <td>{{$c->EQPI_NUMERO}}</td>
                            <td>{{date('d/m/Y',strtotime($c->MOV_DATAHORA))}}</td>
                            <td>{{date('H:i:s',strtotime($c->MOV_DATAHORA))}}</td>
                            @if ($c->MOV_ENTRADASAIDA == 1)
                              <td>{{$c->MOV_ENTRADASAIDA}} - Entrada</td>
                            @else 
                              <td>{{$c->MOV_ENTRADASAIDA}} - Saída</td>
                            @endif
                          @endif
                      @empty
                        Nada para exibir
                      @endforelse
                      </tbody>
                    </table>
                </div>
            </div>    
            @php
                $count = 1;
            @endphp
            @else
            <div class="tab-pane" id="{{$i->RA}}">
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                      <tbody><tr>
                        <th>#</th>
                        <th>Dia</th>
                        <th>Hora</th>
                        <th>Ação</th>              
                      </tr>
                      @forelse ($catraca as $c)
                          @if ($i->RA == $c->PES_NUMERO)
                            @if ($c->MOV_ENTRADASAIDA == 1)
                              <tr class="text-success">                  
                            @else
                              <tr class="text-danger">                  
                            @endif
                            <td>{{$c->EQPI_NUMERO}}</td>
                            <td>{{date('d/m/Y',strtotime($c->MOV_DATAHORA))}}</td>
                            <td>{{date('H:i:s',strtotime($c->MOV_DATAHORA))}}</td>
                            @if ($c->MOV_ENTRADASAIDA == 1)
                              <td>{{$c->MOV_ENTRADASAIDA}} - Entrada</td>
                            @else 
                              <td>{{$c->MOV_ENTRADASAIDA}} - Saída</td>
                            @endif
                          @endif
                      @empty
                        Nada para exibir
                      @endforelse
                      </tbody>
                    </table>
                </div>
            </div> 
          @endif
        @empty
            Nenhum dado desse aluno
        @endforelse
        
      </div>
      
    </div>
    
  </div>
</div>
@stop

@section('js')

    
@endsection