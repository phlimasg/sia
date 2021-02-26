@extends('adminlte::page')

@section('title', 'Extraclasse')

@section('header')
<h3>Dashboard</h3>
@endsection

@section('content')

<div class="row">
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-red"><i class="fa fa-remove"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Cancelamentos</span>
        <span class="info-box-number">{{$cancelamentos_count}}</span>
        <a href="#" data-toggle="modal" data-target="#myModal"><i class="fa fa-bar-chart"></i> Relatório</a>
        <!-- Modal -->
        <div id="myModal" class="modal fade" role="dialog">
          <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content ">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Relatório de cancelamento</h4>
              </div>
              <form action="{{ route('extclasse.cancelamentos') }}" method="POST">
                @csrf
                <div class="modal-body">
                  Selecione o período:
                  <div class="row">
                    <div class="col-sm-6">
                      <label for="">Início:</label>
                      <input type="text" name="ini" id="" class="form-control" data-mask="00/00/0000" autofocus></div>
                    <div class="col-sm-6">
                      <label for="">Fim:</label>
                    <input type="text" name="fim" id="" class="form-control" data-mask="00/00/0000">
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-default"><i class="fa fa-gear"></i> Gerar</button>
                </div>
              </form>
            </div>

          </div>
        </div>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-aqua"><i class="fa fa-graduation-cap"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Ativ. Cadastradas</span>
            <span class="info-box-number">{{App\Model\AtividadesExtraclasse\ExtAtv::count()}}</span>
            
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>      
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-yellow"><i class="fa fa-user"></i></span>
    
              <div class="info-box-content">
                <span class="info-box-text">Inscritos em {{date('Y')}}</span>
                <span class="info-box-number">{{App\Model\AtividadesExtraclasse\ExtInscricao::where('ano',date('Y'))->count()}} alunos</span>
                <a href="{{ route('inscricao.index') }}"><i class="fa fa-bar-chart"></i> Relatório</a>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-list-ol"></i></span>
      
                <div class="info-box-content">
                  <span class="info-box-text">Lista de espera</span>
                  <span class="info-box-number">{{App\Model\AtividadesExtraclasse\ExtAtvListaDeEspera::where('ano',date('Y'))->count()}} alunos</span>
                  <a href="{{ route('downloadLista') }}" ><span class="fa fa-download"></span> Baixar Lista</a>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>

<div class="row">
  <div class="col-sm-8">
    <div class="box box-primary">
      <div class="box-header">Cancelamentos ou Devoluções - Total de {{$cancelamentos_count}} em {{date("Y")}}.</div>
      <div class="box-body">
        <canvas id="myChart" width="100%" style="max-height: 1500px"></canvas>      
      </div>
    </div>
    
    
  </div>
  <div class="col-sm-4">
    <div class="box box-danger">
      <div class="box-header">Últimos cancelamentos</div>
      <div class="box-body">
        @foreach ($ult_cancelamentos as $i)
        
            <div class="row">
              <div class="col-sm-3">
                <img src="{{ asset($i->ExtAtvTurma->ExtAtv->imagem_mini) }}" alt="" class="img-responsive">
              </div>
              <div class="col-sm-9">
                <b>{{ $i->aluno_id}} - {{$i->aluno->NOME_ALUNO}}</b> <br>
                <b>Turma:</b> {{ $i->ExtAtvTurma->ExtAtv->atividade}}                               
              </div>
            </div>
            <br>  
            @endforeach      
      </div>
    </div>
  </div>
</div>

   


@stop

@section('js')
<script src="{{ asset('/js/jquery.mask.min.js') }}"></script> 
<script>
  var ctx = document.getElementById('myChart').getContext('2d');
  var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
          labels: [
            @foreach ($cancelamentos as $i)'{{mb_substr($i->atividade,0,12,"UTF-8")}}',@endforeach            
            ],
          datasets: [{
              label: '',
              data: [
                @foreach ($cancelamentos as $i){{$i->total}},@endforeach                
                ],
              backgroundColor: [
                @foreach ($cancelamentos as $i)'rgba(255, '+Math.floor(Math.random() * 255)+', '+Math.floor(Math.random() * 150)+', 0.8)',@endforeach
              ],              
              borderWidth: 1
          }]
      },
      options: {
          scales: {
              yAxes: [{
                  ticks: {
                      beginAtZero: true
                  }
              }]
          }
      }
  });
  </script>



@endsection