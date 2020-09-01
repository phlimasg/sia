@extends('adminlte::page')

@section('title', 'Download de Leads')

@section('content_header')
    <h1>Central de Atendimento</h1>
@stop

@section('content')
@if (Session::has('message'))
    <div class="alert alert-success">
      {{Session::get('message')}}
    </div>
@endif
@if (Session::has('error2'))
<div class="alert alert-danger alert-dismissible" id='message'>
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  <h4><i class="icon fa fa-check"></i> Aviso!</h4>
  {{Session::get('error2')}} <br>
</div>    
@endif
@if (Session::has('error'))
<div class="alert alert-danger alert-dismissible" id='message'>
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  <h4><i class="icon fa fa-check"></i> Aviso!</h4>
  {{Session::get('error')['message']}}. <br>
  Código: {{Session::get('error')['status_code']}}.<br>
  {{Session::get('error')['details'][0]['description']}}.<br>
  {{Session::get('error')['details'][0]['description_detail']}}  
</div>    
@endif
@error('motivo')
<div class="panel panel-danger">
  <div class="panel-body">
    <div class=" text-danger">* {{ $message }}</div>
  </div>
</div>
@enderror
@error('amount')
<div class="panel panel-danger">
  <div class="panel-body">
    <div class=" text-danger">* {{ $message }}</div>
  </div>
</div>
@enderror
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Download de Leads</h3>
  
        <div class="box-tools">
          <form action="{{ route('extraclasse_terceirizadas.store') }}" method="post">
            @csrf
            <div class="input-group input-group-sm hidden-xs" style="width: 250px;">
              <input type="text" name="table_search" class="form-control pull-right" placeholder="Procurar">
    
              <div class="input-group-btn">
                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
              </div>
            </div>
          
          </form>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body ">
        <form action="{{ route('leads.store') }}" method="post">
            @csrf            
            <button type="submit" class="btn btn-success">Download</button>               
        </form>
      </div>
      <!-- /.box-body -->
      
    </div>
    <!-- /.box -->
  </div>

</div>
    
@stop

@section('js')
    
@endsection