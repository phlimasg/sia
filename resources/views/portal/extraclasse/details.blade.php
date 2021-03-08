@extends('adminlte::page')
@section('title', 'Atividades Extraclasse')
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
@section('content_header')
<div class="row">
  <div class="col-xs-6"><a href="{{ route('extraclasse.show', ['extraclasse'=>$_SESSION['ra']]) }}" class="btn btn-danger"><i class="fa fa-chevron-left"></i> Voltar</a></div>
  <div class="col-xs-6 text-right"><a href="{{ route('cart.index') }}" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Seu carrinho <span class="label label-danger badge">{{$_SESSION['cart']}}</span></a></div>
</div>


@endsection

<div>
  
  <div class="atv_fundo" style="background-image: url('{{$atividade->ExtAtvTurma->ExtAtv->imagem_fundo}}')">
  </div>
  <div class="container" style="width: 90%">
    <div class="details">
      <div class="panel">
        <div class="panel-body">
          <div class="col-sm-3">
            <img src="{{$atividade->ExtAtvTurma->ExtAtv->imagem_mini}}" alt="" class="img-thumbnail">
          </div>
          <div class="col-sm-6">
            <h2>{{$atividade->ExtAtvTurma->ExtAtv->atividade}}</h2>
            <b>Turma: </b>{{$atividade->ExtAtvTurma->descricao_turma}} <br>
            <b>Aulas: </b>{{substr($atividade->ExtAtvTurma->dia, 0, -2)}} <br>
            <b>Horário: </b> Das {{substr($atividade->ExtAtvTurma->hora_ini, 0, -3)}} às {{substr($atividade->ExtAtvTurma->hora_fim, 0, -3)}}
          </div>
          <div class="col-sm-3 padding-md">
            Valor mensal:
            <div><span class="details-preco">R$ {{$atividade->ExtAtvTurma->valor}}</span></div>
            Inscrições até {{date('d/m/Y',strtotime($atividade->ExtAtvTurma->dia_bloqueia))}} às {{date('H:i',strtotime($atividade->ExtAtvTurma->dia_bloqueia))}}
            <div class="details-btn-add">
              <!--<form action="{{ route('cart.store') }}" method="post">                
                  @csrf                
                  <input type="hidden" name="id" value="{{$atividade->ExtAtvTurma->id}}">
                  <input type="hidden" name="ra" value="{{$_SESSION['ra']}}">
                  <button type="submit" class="btn btn-success btn-block btn-lg"><i class="fa fa-cart-plus"></i> Adicionar</button>
                </form>              -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-12">
      <div class="text-center"><h3>Informações: {{$atividade->ExtAtvTurma->ExtAtv->atividade}}</h3></div>
      {!!$atividade->ExtAtvTurma->ExtAtv->descricao!!}
    </div>
  </div>
</div>
@stop
@section('js')
<script>
  $(document).ready(function(){      
      $("#message").fadeOut(8000);
    
});
</script>
    
@endsection