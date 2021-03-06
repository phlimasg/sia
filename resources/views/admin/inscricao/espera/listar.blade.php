@extends('adminlte::page')

@section('title', 'Inscrições')

@section('content_header')
    <h1>Listagem de inscrições</h1>
@stop

@section('content')
<div class="box">
  <div class="box-body">
    <div class="table-responsive">          
      <table class="table" id="tabela">
        <thead>
          <tr>
            <th>#</th>
            <th>Nome</th>
            <th>Ano</th>            
            <th>Turno</th>
            <th>Vagas</th>
            <th>Status</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($candidatos::where('ESPERA',1)->get() as $i) 
            <tr>
              <td>{{$i->id}}</td>
              <td>{{$i->NOME}}</td>              
              <td>{{$i->Escolaridade->ANO}}</td>
              <td>{{$i->Escolaridade->TURNO}}</td>
              <td>{{$i->Escolaridade->QTD_VAGAS - $candidatos->where('ESCOLARIDADE_ID',$i->Escolaridade->ID)
                ->whereIn('id',
                  $inscricoes::select('CANDIDATO_ID')
                  ->where('PAGAMENTO',1)->get()
                  )->count() }}</td>
              <td><span class="label
                  @if($i->status == "Falta Documento")
                    label-danger
                  @elseif($i->status == "Aprovado")
                    label-success
                  @elseif($i->status == null)
                  label-warning
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