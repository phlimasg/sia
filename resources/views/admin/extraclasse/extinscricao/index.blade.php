@extends('adminlte::page')

@section('title', 'Extraclasse')

@section('content_header')
    <h1>Atividades Extraclasse</h1>
@stop

@section('content')
<div class="card">
  <div class="card-header">
    Relatório das inscrições
  </div>
<form action="{{ route('inscricao.store') }}" method="POST">
  @csrf
  <div class="card-body">
    <div class="row">
      <div class="col-sm-2">
        <label for="">Início</label>
        <input type="text" name="ini" id="ini" class="form-control">
        @error('ini')
            <div class=" text-danger">* {{ $message }}</div>
        @enderror
      </div>
      <div class="col-sm-2">
        <label for="">Fim</label>
        <input type="text" name="fim" id="fim" class="form-control">
        @error('fim')
            <div class=" text-danger">* {{ $message }}</div>
        @enderror
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-sm-4">
        <button type="submit" class="btn btn-success btn-block"> <i class="fa fa-download"></i> Download</button>
      </div>
    </div>
  </div>
</form>
</div>
    
@stop

@section('js')
<script>
  $('#ini').mask('00/00/0000');
  $('#fim').mask('00/00/0000');
  $('#cep').mask('00000-000');
</script>
    
@endsection