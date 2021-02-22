@extends('adminlte::page')

@section('title', 'Add Comunicado')

@section('content_header')
    <h1>Visualização do Comunicado</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header with-border">
        <h1 class="card-title">{{$comunicado->titulo}}</h1>
        <div class="card-tools pull-right">
        <a href="{{ route('comunicados.edit', ['comunicado'=>$comunicado->id]) }}" class="btn btn-card-tool">
            <i class="fa fa-edit"></i>
        </a>
        <a href="{{ route('comunicados.destroy', ['comunicado'=>$comunicado->id]) }}" class="btn btn-card-tool">
            <i class="fa fa-remove"></i></a>
        </div>
    </div>
    <style>
    .showcom>p{
        margin: 0px;
    }
    </style>
    <div class="card-body showcom">          
        
        {!!$comunicado->descricao!!}
    </div>
    
    <!-- /.card-body 
    <div class="card-footer">
        Footer
    </div>-->
    <!-- /.card-footer-->
</div>

@stop