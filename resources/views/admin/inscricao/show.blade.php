@extends('adminlte::page')

@section('title', 'Inscrições')

@section('content_header')
    
@stop

@section('content')
<form action="{{ route('alunos_novos.update', ['id'=>$candidato->id]) }}" method="POST">
  @csrf
  @method('PUT')
  <div class="box box-primary">
    <div class="box-header">
      <h3 class="box-title">Alterar Status</h3>
    </div>
    <div class="box-body">
      <div class="row">
        <div class="col-md-4">        
          <select name="status" id="" class="form-control" required>
            <option value=""></option>
            <option value="Falta Documento" {{ $candidato->status == "Falta Documento"? 'selected' : ''}}>Falta Documento</option>
            <option value="Aprovado" {{ $candidato->status == "Aprovado"? 'selected' : ''}}>Aprovado</option>
          </select>
        </div>
        <div class="col-md-2">
          <button type="submit" class="btn btn-warning"><i class="fa fa-save"></i> Alterar Status</button>
        </div>
      </div>
    </div>
  </div>
</form>
<div class="box box-primary">
  <div class="box-header">
    <h3 class="box-title">Dados de {{$candidato->NOME}}</h3>
    <div class="box-tools pull-right"><a href="http://inscricao.abel.org.br/inscricao/candidato/infos/{{$candidato->RESPFIN_CPF}}/{{$candidato->Inscricao->id}}" target="_blank" class="btn btn-primary"><i class="fa fa-print"></i> Imprimir ficha</a></div>
  </div>
  <div class="box-body">

    <div class="row">
      <div class="col-sm-3">
        <label for="">Escolaridade:</label>
        <p>{{$candidato->Escolaridade->ESCOLARIDADE}}</p>
      </div>
      <div class="col-sm-2">
        <label for="">Ano:</label>
        <p>{{$candidato->Escolaridade->ANO}}</p>
      </div>
      <div class="col-sm-2">
        <label for="">Turno:</label>
        <p>{{$candidato->Escolaridade->TURNO}}</p>
      </div>
      <div class="col-sm-2">
        <label for="">Integral?</label>
        <p>{{$candidato->INTEGRAL_ID ? 'SIM' : 'NÃO'}}</p>
      </div>
      <div class="col-sm-2">
        <label for="">Avaliação</label>
        <p>{{ date('d/m/Y', strtotime($candidato->Inscricao->Avaliacao->DTPROVA)) }} - {{$candidato->Inscricao->Avaliacao->HORAPROVA }}</p>
      </div>
    </div>
    <hr>


    <div class="row">
      <div class="col-sm-4">
        <label for="">Nome:</label>
        <p>{{$candidato->NOME}}</p>
      </div>
      <div class="col-sm-3">
        <label for="">Data de Nascimento:</label>
        <p>{{date('d/m/Y', strtotime($candidato->DTNASC))}}</p>
      </div>
      <div class="col-sm-3">
        <label for="">Data de Nascimento:</label>
        <p>{{$candidato->NAT}}</p>
      </div>
      <div class="col-sm-2">
        <label for="">Telefone:</label>
        <p>{{$candidato->TEL}}</p>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-2">
        <label for="">Ex-Aluno?</label>
        <p>{{$candidato->EXALUNO==0 ? 'NÃO' : 'SIM'}}</p>
      </div>
      <div class="col-sm-3">
        <label for="">Necessidade especiais?</label>
        <p>{{$candidato->NEC_ESP ? $candidato->NEC_ESP : 'NÃO'}}</p>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-sm-4">
        <label for="">Endereço:</label>
        <p>{{$candidato->ENDERECO}} - {{$candidato->BAIRRO}}</p>
      </div>
      <div class="col-sm-3">
        <label for="">Cidade/UF</label>
        <p> {{$candidato->CIDADE}} - {{$candidato->ESTADO}}</p>
      </div>
      <div class="col-sm-2">
        <label for="">CEP:</label>
        <p>{{$candidato->CEP}}</p>
      </div>
    </div>
  </div>
</div>
<div class="box box-warning">
  <div class="box-header">
    <h3 class="box-title">Documentos</h3>
  </div>
  <div class="box-body">
    <div class="row">
      @forelse ($candidato->Documentos as $i)
        <div class="col-sm-2">
          @if (strpos($i->nome,'.pdf'))
            <a href="http://inscricao.abel.org.br{{Storage::url($i->url)}}" target="_blank">
              <img src="{{asset('https://www.iconfinder.com/data/icons/file-extension-names-vol-8/512/24-512.png')}}" alt="" width="100%">
            </a>
          @else
            <a href="http://inscricao.abel.org.br{{Storage::url($i->url)}}" target="_blank">
              <img src="http://inscricao.abel.org.br{{Storage::url($i->url)}}" alt="" style="max-height: 136px; max-width: 100%;">
            </a>
          @endif    
        </div>      
      @empty
          <div class="col-sm-12">Nenhum documento enviado</div>
      @endforelse
    </div>
  </div>
</div>
@stop

@section('css')
 <style>
   .box-body{
     font-size: 20px;
   }
 </style>
@endsection
@section('js')
 
@endsection