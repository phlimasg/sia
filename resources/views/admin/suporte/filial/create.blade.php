@extends('adminlte::page')

@section('title', 'Suporte')

@section('content_header')
  @include('admin.suporte.breadcrumb')
@stop

@section('content')
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Cadastrar filial</h3>
  </div>
  <div class="card-body">
    @include('admin.suporte.filial.parcial.form')
  </div>
</div>
    
@stop

@section('js')

<script src="{{ asset('/js/jquery.mask.min.js') }}"></script>   
@endsection