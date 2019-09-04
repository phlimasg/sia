@extends('adminlte::page')

@section('title', 'Erro')
@section('content_header')    
@stop

@section('content')
<form action="{{route('senderror')}}" method="post">
    @csrf

    
    <input type="hidden" name="error" value="{{$e->getMessage()}}">    
    <div class="box">
        <div class="box-header">  
          ERRO!       
        </div>
        <div class="alert alert-danger alert-dismissible">    
            <h4><i class="icon fa fa-ban"></i> Tivemos um erro! :/</h4>
            <code>{{$e->getMessage()}}</code>
        </div>
        <div class="row">
          <div class="col-sm-3">
            <label for="">Seu usuário:</label>
            <input type="text" name="name" class="form-control" placeholder="Seu CPF"
    @if(!empty(Auth::user()->name) ) 
        value="{{Auth::user()->name}}" 
    @endif 
    >
          </div>
          <div class="col-sm-4">
            <label for="">Seu email:</label>
            <input type="email" name="email" class="form-control" 
    @if(!empty(Auth::user()->email) ) 
        value="{{Auth::user()->email}}" 
    @endif 
    >
          </div>
          <div class="col-sm-3">
              <label for="">Telefone:</label>
              <input type="text" name="tel" id="" class="form-control">
            </div>  
        </div>
      <input type="hidden" name="url" id="" class="form-control" value="{{Request::url()}}">
        <br>
        <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#modal-load"><i class="fa fa-envelope-o"></i> Enviar erro para o administrador</button>        
    </div>    

</form>
<div class="modal fade" id="modal-load" style="display: none;">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Aguarde</h4>
            </div>
            <div class="modal-body">
              <img src="https://wpamelia.com/wp-content/uploads/2018/11/ezgif-2-6d0b072c3d3f.gif" alt="" srcset="" width="100%">
            </div>            
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
@stop

@section('js')    
@endsection