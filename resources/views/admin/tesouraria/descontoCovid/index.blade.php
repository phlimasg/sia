@extends('adminlte::page')

@section('title', 'Extraclasse')

@section('content_header')
    <h1>Desconto COVID-19</h1>
@stop

@section('content')
<div class="box">
  <div class="box-header">
    Relatório dos descontos deferidos - COVID 19
  </div>
<form action="{{ route('covid.storeRelatorio') }}" method="POST">
  @csrf
  <div class="box-body">
    <div class="row">
      <div class="col-sm-2">
        <label for="">Início</label>
        <input type="text" name="ini" id="ini" class="form-control" value="{{date('d/m/Y', strtotime('-1 day'))}}">
        @error('ini')
            <div class=" text-danger">* {{ $message }}</div>
        @enderror
      </div>
      <div class="col-sm-2">
        <label for="">Fim</label>
      <input type="text" name="fim" id="fim" class="form-control" value="{{date('d/m/Y')}}">
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