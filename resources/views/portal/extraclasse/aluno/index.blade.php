@extends('adminlte::page')
@section('title', 'Atividades Extraclasse')
@section('content_header')
<h1>Selecione o Aluno:</h1>
@endsection
@section('content')   
<div class="row">
  @foreach ($aluno as $i)
  <div class="col-sm-3">
    <div class="card card-primary">
            <div class="card-body card-profile">
              <div class="text-center">
                <img class="profile-user-img img-responsive img-circle" 
                @if (Storage::disk('public')->exists('alunos/00000'.$i->RA.'.JPG'))
                src="{{Storage::url('alunos/00000'.$i->RA.'.JPG')}}"
                @else
                src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" 
              @endif 
                alt="User profile picture">
              </div>

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

              <a href="{{ route('aluno.show', ['aluno'=>$i->RA]) }}" class="btn btn-primary btn-block"><b>Selecionar</b></a>
            </div>            
          </div>
</div>
  @endforeach
</div>
@stop
@section('js')

    
@endsection