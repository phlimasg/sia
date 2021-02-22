@extends('adminlte::page')

@section('title', 'Inscrições')

@section('content_header')
    <h1>Estatísticas <small>Inscrições</small></h1>
@stop

@section('content')
    <div class="row">
      <div class="col-md-8">
        <div class="card card-primary">
          <div class="card-body">
            <canvas id="myChart" style="width: 80vw; height: 90vh;"></canvas>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card card-primary">
          <div class="card-body">
          <div class="table-responsive">          
            <table class="table" id="totalInsc">
              <thead>
                <tr>
                  <th>Escolaridade</th>                  
                  <th>Pretenção</th>
                  <th>Pagos</th>
                  <th>Vagas</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($escolaridade->get() as $i)              
                @if($i->Candidatos()->count()>0)
                  <tr>
                  <td>{{$i->ANO}} {{$i->TURNO}}</td>                    
                    <td>{{$i->Candidatos()->count()}}</td>
                    <td>{{$candidatos->where('ESCOLARIDADE_ID',$i->ID)
                    ->whereIn('id',
                      $inscricoes::select('CANDIDATO_ID')
                      ->where('PAGAMENTO',1)->get()
                      )->count() }}</td>
                      
                      <td>{{$i->QTD_VAGAS - $candidatos->where('ESCOLARIDADE_ID',$i->ID)
                        ->whereIn('id',
                          $inscricoes::select('CANDIDATO_ID')
                          ->where('PAGAMENTO',1)->get()
                          )->count() }}</td>
                  </tr>
                    @endif
                @endforeach
              </tbody>
            </table>
            </div>
        </div>
    </div>

  </div>
</div>

<div class="card card-primary card-outline">
  <div class="card-header">
    <h3 class="card-title">Últimas inscrições</h3>
    <div class="card-tools pull-right"><a href="{{ route('alunos_novos.listar') }}" class="btn btn-primary">Listar Inscrições</a></div>
  </div>
  <div class="card-body">
    <div class="table-responsive">          
      <table class="table" >
        <thead>
          <tr>
            <th>Nome</th>
            <th>Ano</th>
            <th>Escolaridade</th>            
            <th>Turno</th> 
          </tr>
        </thead>
        <tbody>
          @foreach ($candidatos->whereIn('id',
              $inscricoes::select('CANDIDATO_ID')
              ->where('PAGAMENTO',1)->get()
            )->orderBy('id','DESC')->limit(10)->get() as $i)              
          
            <tr>
              <td>{{$i->NOME}}</td>
              <td>{{$i->Escolaridade->ESCOLARIDADE}}</td>
              <td>{{$i->Escolaridade->ANO}}</td>
              <td>{{$i->Escolaridade->TURNO}}</td>
            </tr>              
          @endforeach
        </tbody>
      </table>
      </div>
  </div>
</div>

@stop

@section('js')
<script>
  $(document).ready( function () {    
    $('#totalInsc').DataTable({
      paging: false,
      searching: false,
    });
    $('#totalInsc_info').hide();
} );
  var ctx = document.getElementById('myChart').getContext('2d');
  var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
          labels: ['Cadastrados', 'Inscritos', 'Pagos', 'Não Pagos', 'Espera'],
          datasets: [{              
              data: [
                {{ $candidatos->count() }}, //Candidatos
                {{ $inscricoes->count() }}, //Inscrições
                {{ $inscricoes->where('PAGAMENTO', 1)->whereIn('id', $getnet::select('inscricaos_id')->get())->count() }}, //Pagos
                {{ $candidatos->whereNotIn('id', $inscricoes::select('CANDIDATO_ID')->get())->count() }}, //Não Pagos
                {{ $candidatos->where ('ESPERA', 1)->count() }}, //Erros de pagamento
                ],
              backgroundColor: [
                  'rgba(255, 99, 132)',
                  'rgba(54, 162, 235)',
                  'rgba(255, 206, 86)',
                  'rgba(75, 192, 192)',
                  'rgba(153, 102, 255)',
                  'rgba(255, 159, 64)'
              ],
              borderColor: [
                  'rgba(255, 99, 132, 1)',
                  'rgba(54, 162, 235, 1)',
                  'rgba(255, 206, 86, 1)',
                  'rgba(75, 192, 192, 1)',
                  'rgba(153, 102, 255, 1)',
                  'rgba(255, 159, 64, 1)'
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