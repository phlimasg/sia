@extends('adminlte::page')

@section('title', 'Inscrições')

@section('content_header')
    <h1>Estatísticas <small>Inscrições</small></h1>
@stop

@section('content')
<canvas id="myChart" style="width: 80vw; height: 70vh;"></canvas>


@stop

@section('js')
<script>
  var ctx = document.getElementById('myChart').getContext('2d');
  var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
          labels: ['Candidatos', 'Inscrições', 'Pagos', 'Não Pagos', 'Erro de pagamento'],
          datasets: [{
              label: '',
              data: [
                {{ $candidatos->count() }}, //Candidatos
                {{ $inscricoes->count() }}, //Inscrições
                {{ $inscricoes->where('PAGAMENTO', 1)->whereIn('id', $getnet::select('inscricaos_id')->get())->count() }}, //Pagos
                {{ $candidatos->whereNotIn('id', $inscricoes::select('CANDIDATO_ID')->get())->count() }}, //Não Pagos
                {{ $inscricoes->whereNotIn ('id', $getnet::select('inscricaos_id')->get())->count() }}, //Erros de pagamento
                3],
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