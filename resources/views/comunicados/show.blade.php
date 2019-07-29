@extends('adminlte::page')

@section('title', 'Add Comunicado')

@section('content_header')
    <h1>Visualização do Comunicado</h1>
@stop

@section('content')
<div class="box">
    <div class="box-header with-border">
        <h1 class="box-title">{{$comunicado->titulo}}</h1>
        <div class="box-tools pull-right">
        <a href="{{ route('comunicados.edit', ['id'=>$comunicado->id]) }}" class="btn btn-box-tool">
            <i class="fa fa-edit"></i>
        </a>
        <a href="{{ route('comunicados.destroy', ['id'=>$comunicado->id]) }}" class="btn btn-box-tool">
            <i class="fa fa-remove"></i></a>
        </div>
    </div>
    <div class="box-body">          
        {!!$comunicado->descricao!!}
    </div>
    <!-- /.box-body 
    <div class="box-footer">
        Footer
    </div>-->
    <!-- /.box-footer-->
</div>

@stop