@extends('adminlte::page')

@section('title', 'Suporte')

@section('content_header')
    
@stop

@section('content')
<div class="row">

  <div class="col-lg-3">
    <!-- small box -->
    <div class="small-box bg-info">
      <div class="inner">
        <h3>150</h3>

        <p>Sms Gateway Devices</p>
      </div>
      <div class="icon">
        <i class="fa fa-mobile"></i>
      </div>
      <a href="#" class="small-box-footer">Mais informações <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  
  <div class="col-lg-3">
    <!-- small box -->
    <div class="small-box bg-warning">
      <div class="inner">
        <h3>150</h3>

        <p>Categorias</p>
      </div>
      <div class="icon">
        <i class="fa fa-bullhorn "></i>
      </div>
      <a href="#" class="small-box-footer">Mais informações <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>

  <div class="col-lg-3">
    <!-- small box -->
    <div class="small-box bg-danger">
      <div class="inner">
        <h3>150</h3>

        <p>Salas</p>
      </div>
      <div class="icon">
        <i class="fa fa-home"></i>
      </div>
      <a href="#" class="small-box-footer">Mais informações <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>

  <div class="col-lg-3">
    <!-- small box -->
    <div class="small-box bg-success">
      <div class="inner">
        <h3>150</h3>

        <p>Tecnicos</p>
      </div>
      <div class="icon">
        <i class="fa fa-users"></i>
      </div>
      <a href="#" class="small-box-footer">Mais informações <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title"> {{$filial->codigo}} - {{$filial->nome}}</h3>
      </div>
      <div class="card-body">
      </div>
    </div>
  </div>
</div>
    
@stop

@section('js')

<script src="{{ asset('/js/jquery.mask.min.js') }}"></script>   
@endsection