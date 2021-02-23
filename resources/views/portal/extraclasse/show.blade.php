@extends('adminlte::page')

@section('title', 'Atividades Extraclasse')

@section('content_header')
<h1>Atividades disponíveis para {{ucwords($_SESSION['name'])}}. </h1>
<ol class="breadcrumb" style="font-size: 1em">
  <a href="{{ route('cart.index') }}" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Seu carrinho<span class="label label-danger badge">{{$_SESSION['cart']}}</span></a>
</ol>

<hr>
@endsection
@section('content')   
  @if (Session::has('message'))
  <div class="alert alert-success alert-dismissible" id='message'>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-check"></i> Aviso!</h4>
    {{Session::get('message')}}
  </div>    
  @endif

  @if (Session::has('error'))
  <div class="alert alert-danger alert-dismissible" id='message'>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-warning"></i> Aviso!</h4>
    {{Session::get('error')}}
  </div>    
  @endif

<div class="row">
  @foreach ($turmas as $i)
    {{--$i->ExtAtvTurma->ExtAtv--}}
    @if ($i->ExtAtvTurma->dia_libera <= date('Y-m-d H:i:s') && $i->ExtAtvTurma->dia_bloqueia >= date('Y-m-d H:i:s'))
        
    <div class="col-sm-3" style="">
      <div class="card card-default text-center">
        <div class="card-body" style="padding: 0px">
          <a href="{{ route('extraclasse.details', ['id'=>$i->id]) }}"><img src="{{$i->ExtAtvTurma->ExtAtv->imagem_mini}}" alt="" class="img-fluid">
        <div>
          <span  class="lj-atv">{{$i->ExtAtvTurma->ExtAtv->atividade}}</span>          
        </div>
        <div class="lj-small"><small>Turma: {{$i->ExtAtvTurma->descricao_turma}}</small></div>
        <div class="lj-small"><small>Aulas: {{substr($i->ExtAtvTurma->dia, 0, -2)}}</small></div>
        <div class="lj-small"><small>Das {{substr($i->ExtAtvTurma->hora_ini, 0, -3)}} às {{substr($i->ExtAtvTurma->hora_fim, 0, -3)}}</small></div>
        <div>
          <span class="lj-preco">
            R$: {{$i->ExtAtvTurma->valor}}
          </span>
        </div>
      </a>
      <form action="{{ route('cart.store') }}" method="post">
        <a href="{{ route('extraclasse.details', ['id'=>$i->id]) }}" class="btn btn-danger"><i class="fa fa-info"></i> Informações</a>
          @csrf                
          <input type="hidden" name="id" value="{{$i->ExtAtvTurma->id}}">
          <input type="hidden" name="ra" value="{{$_SESSION['ra']}}">
          <button type="submit" class="btn btn-primary"><i class="fa fa-cart-plus"></i> Adicionar</button>
        </form>
        </div>
      </div>
    </div>
    @endif
  @endforeach
 
  
</div>
@stop
@section('js')
<script>
  $(document).ready(function(){      
      $("#message").fadeOut(8000);
    
});
</script>
    
@endsection