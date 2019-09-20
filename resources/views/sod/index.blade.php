@extends('adminlte::page')

@section('title', 'SOD')

@section('content_header')
    <h1>Estatísticas <small>Acessos</small></h1>
@stop

@section('content')
<div class="row">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3>@php
                $t =0;
                @endphp 
                @foreach ($total as $i)
                    @php
                    $t = $t + $i->total;
                    @endphp                    
                @endforeach
                {{$t}}</h3>

            <p>Alunos Ativos</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>          
        </div>
      </div>

      <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>
                  @php
                  $t = 0;
                  @endphp
                  @foreach ($total as $i)
                    @if($i->TURNO_ALUNO == 'MANHÃ' || $i->TURNO_ALUNO == 'INTEGRAL')
                      @php
                      $t = $t + $i->total;
                      @endphp
                    @endif                    
                  @endforeach
                  {{round(($falta_M/$t)*100,2)}}<sup style="font-size: 20px">%</sup></h3>

              <p><b>{{$falta_M}}</b> da manhã, passaram na catraca</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>            
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-blue">
              <div class="inner">
                <h3>
                    @php
                    $t = 0;
                    @endphp
                    @foreach ($total as $i)
                    @if($i->TURNO_ALUNO == 'TARDE')
                      @php
                      $t = $t + $i->total;
                      @endphp
                    @endif                    
                  @endforeach
                  {{round(($falta_T/$t)*100,2)}}<sup style="font-size: 20px">%</sup></h3>
  
                <p><b>{{$falta_T}}</b> da tarde, passaram na catraca</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>            
            </div>
          </div>
</div>
<div class="row">
    <div class="col-sm-7 col-xs-8">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Total de alunos: 
                @php
                $t =0;
                @endphp 
                @foreach ($total as $i)
                    @php
                    $t = $t + $i->total;
                    @endphp                    
                @endforeach
                {{$t}}
                </h3>        
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-8">
                  <div class="chart-responsive">
                    <canvas id="myChart" ></canvas>
                  </div>
                  <!-- ./chart-responsive -->
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                  <ul class="chart-legend clearfix">
                    <li><i class="fa fa-circle-o text-red"></i> Manhã</li>
                    <li><i class="fa fa-circle-o text-green"></i> Tarde</li>            
                    <li><i class="fa fa-circle-o text-light-blue"></i> Integral</li>            
                  </ul>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-body -->    
          </div>

    </div>

    <div class="col-sm-5">
            <div class="box box-default">
                <div class="box-header with-border">
                  <h3 class="box-title">Atrasos <small>Analizar depois das 14h</small></h3>        
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="chart-responsive">
                        <canvas id="atrasos" ></canvas>
                      </div>
                      <!-- ./chart-responsive -->
                    </div>
                    
                  </div>
                  <!-- /.row -->
                </div>
                <!-- /.box-body -->    
              </div>
    
        </div>
</div>



@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script>
var ctx = document.getElementById('myChart').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'doughnut',

    // The data for our dataset
    data:{
            datasets: [{
                            data: [@foreach ($total as $i){{$i->total}},@endforeach],
                            label: 'Total de Alunos',
                            backgroundColor: ['lightblue','red','lightgreen'],
                        }],            
            labels: [
                'Integral',
                'Manhã',
                'Tarde',                
                ]
            },

    // Configuration options go here
    options: {
        legend: {
            display: false,            
        }
    }
});

var ctx = document.getElementById('atrasos').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'bar',

    // The data for our dataset
    data:{
            datasets: [{
                            data: [{{$atrasos_M}},{{$atrasos_T}}],
                            label: 'Total de Alunos',
                            backgroundColor: ['lightblue','red','lightgreen'],
                        }],            
            labels: [                
                'Manhã',
                'Tarde',                
                ]
            },

    // Configuration options go here
    options: {
        legend: {
            display: false,            
        }
    }
});
</script>   
@endsection