@extends('adminlte::page')

@section('title', 'Inscrições')

@section('content_header')
    <h1>Listagem de inscrições</h1>
@stop

@section('content')
@if (Session::get('message'))
<div class="alert alert-warning alert-dismissible">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  <h4><i class="icon fa fa-warning"></i> Aviso!</h4>
  {{dd(Session::get('message'))}}
</div>
@endif
<div class="box">
  <div class="box-body">
    <div class="table-responsive">          
      <table class="table" id="tabela">
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
              <td>{{$i->CANDIDATO_ID}}</td>
              <td>{{$i->NOME}}</td>
              <td>{{$i->Escolaridade->ESCOLARIDADE}}</td>
              <td>{{$i->Escolaridade->ANO}}</td>
              <td>{{$i->Escolaridade->TURNO}}</td>
              <td><span class="label
                  @if($i->status == "Falta Documento")
                    label-danger
                  @elseif($i->status == "Aprovado")
                    label-success
                  @elseif($i->status == null)
                  label-warning
                  @endif
                ">{{$i->status ? $i->status : 'Analizar'}}</span></td>
              <td>
                <form action="{{ route('alunos_novos.cancelar_duplicidade', ['id'=>$i->id, 'CANDIDATO_ID' => $i->CANDIDATO_ID]) }}" method="post">
                  @csrf
                  <button type="submit" class="btn btn-danger">Cancelar inscrição</button>
                </form>                
              </td>
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