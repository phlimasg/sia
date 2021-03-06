@extends('adminlte::page')

@section('title', 'Inscrições')

@section('content_header')
    <h1>Listagem de inscrições</h1>
@stop

@section('content')
<div class="card">
  <div class="card-body">
    <div class="table-responsive">          
      <table class="table table-hover" id="tabela">
        <thead>
          <tr>
            <th>#</th>
            <th>Nome</th>
            <th>Ano</th>
            <th>Escolaridade</th>            
            <th>Turno</th>
            <th>Status</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($candidatos as $i) 
            <tr>
              <td>{{$i->id}}</td>
              <td>{{$i->NOME}}</td>
              <td>{{$i->Escolaridade->ESCOLARIDADE}}</td>
              <td>{{$i->Escolaridade->ANO}}</td>
              <td>{{$i->Escolaridade->TURNO}}</td>
              <td><span class="badge
                  @if($i->status == "Falta Documento")
                    bg-danger
                  @elseif($i->status == "Aprovado")
                    bg-success
                  @elseif($i->status == null)
                  bg-warning
                  @endif
                ">{{$i->status ? $i->status : 'Analizar'}}</span></td>
              <td><a href="{{ route('alunos_novos.show',['candidato'=>$i->id]) }}" class="btn btn-primary">Analisar</a></td>
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
    $('#tabela').DataTable({
      //paging: false,
      //searching: false,
    });
    //$('#tabela').hide();
} );
 </script>
@endsection