@extends('adminlte::page')

@section('title', 'Alunos Matriculados')

@section('content')



<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Listagem de alunos</h3>
  
        <div class="box-tools">
          <form action="{{ route('alunos_matriculados.store') }}" method="post">
            @csrf
            <div class="input-group input-group-sm hidden-xs" style="width: 250px;">
              <input type="text" name="table_search" class="form-control pull-right" placeholder="Procurar" value="{{old('table_search')}}">
    
              <div class="input-group-btn">
                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
              </div>
            </div>
          
          </form>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body ">
        <div class="table-responsive">          
          <table class="table" id="tabela">
            <thead>
              <tr>
                <th>Ra</th>
                <th>Nome</th>
                <th>Ano</th>
                <th>Turma</th>            
                <th>Turno</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($totvs as $i) 
                <tr>
                  <td>{{$i->RA}}</td>
                  <td>{{$i->NOME_ALUNO}}</td>
                  <td>{{$i->ANO}}</td>
                  <td>{{$i->TURMA}}</td>
                  <td>{{$i->TURNO_ALUNO}}</td>                      
                  <td><a href="{{ route('alunos_matriculados.show',['id'=>$i->RA]) }}" class="btn btn-primary">Analisar</a></td>
                </tr>              
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <!-- /.box-body -->
      
    </div>
    <!-- /.box -->
  </div>

</div>
<div class="row">
<div class="col-md-12">
  <div class="box box-primary">
    <div class="box-body">
      <canvas id="myChart" style="height-max: 250px; height: 250px"></canvas>
    </div>
  </div>
</div>
</div>   
@stop

@section('js')
<script>
  $(document).ready( function () {    
   $('#tabela').DataTable({
     //paging: false,
     searching: false,
   });
   //$('#tabela').hide();
} 
);

var ctx = document.getElementById('myChart').getContext('2d');
      var chart = new Chart(ctx, {
          // The type of chart we want to create
          type: 'bar',
          
          // The data for our dataset
          data: {
              labels: [@foreach ($segmento as $i) '{{str_replace('ESCOLA','',$i->ANO)}}', @endforeach],
              datasets: [{
                  label: 'Alunos',
                  backgroundColor: [@foreach ($segmento as $i) 'rgb({{rand(0,254)}}, {{rand(0,254)}}, {{rand(0,254)}})', @endforeach ],
                  borderColor: 'rgb(255, 245, 245)',
                  data: [@foreach ($segmento as $i) '{{$i->Total}}', @endforeach]
              }]
          },

          // Configuration options go here
          options: {}
      });

</script>
@endsection