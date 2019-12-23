@extends('adminlte::page')
@section('title', 'Atividades Extraclasse')
@section('content_header')
<h1>Selecione o Aluno:</h1>
@endsection
@section('content')   
<div class="row">
  @foreach ($aluno as $i)
  <div class="col-sm-3">
    <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="https://cdn.business2community.com/wp-content/uploads/2017/08/blank-profile-picture-973460_640.png" alt="User profile picture">

            <h3 class="profile-username text-center">{{$i->NOME_ALUNO}}</h3>

              <p class="text-muted text-center"><strong>CPF:</strong> {{$i->CPF}}</p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                <b>Matrícula</b> <a class="pull-right">{{$i->RA}}</a>
                </li>
                <li class="list-group-item">
                  <b>Ano</b> <a class="pull-right">{{$i->ANO}}</a>
                </li>
                <li class="list-group-item">
                  <b>Turma</b> <a class="pull-right">{{$i->TURMA}}</a>
                </li>
              </ul>

              <a href="{{ route('extraclasse.create', ['id'=>$i->RA]) }}" class="btn btn-primary btn-block"><b>Selecionar</b></a>
            </div>            
          </div>
</div>
  @endforeach
</div>
@stop
@section('js')

    
@endsection