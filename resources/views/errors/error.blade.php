@extends('adminlte::page')

@section('title', 'Erro')
@section('content_header')
    <h1><i class="fa fa-danger"></i> Oooops!</h1>
@stop

@section('content')
<form action="{{route('senderror')}}" method="post">
    @csrf
<input type="hidden" name="name" 
    @if(!empty(Auth::user()->name) ) 
        value="{{Auth::user()->name}}" 
    @endif 
    >
    <input type="hidden" name="email" 
    @if(!empty(Auth::user()->email) ) 
        value="{{Auth::user()->email}}" 
    @endif 
    >
    <input type="hidden" name="error" value="{{$e->getMessage()}}">
    <div class="box">
        <div class="box-header">        
        </div>
        <div class="alert alert-danger alert-dismissible">    
            <h4><i class="icon fa fa-ban"></i> Tivemos um erro! :/</h4>
            <code>{{$e->getMessage()}}</code>
        </div>
        <button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Enviar erro para o administrador</button>
    </div>

</form>

@stop

@section('js')    
@endsection