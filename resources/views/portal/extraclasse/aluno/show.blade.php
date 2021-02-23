@extends('adminlte::page')
@section('title', 'Atividades Extraclasse')
@section('content_header')
<h1></h1>
@endsection
@section('content')  
@if (Session::has('message'))
  <div class="alert alert-success alert-dismissible" id='message'>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-check"></i> Aviso!</h4>
    {{Session::get('message')}}
  </div>   
  @endif
    <div class="row">
      <div class="col-md-3">
        <div class="card-profile card">
          <div class="card-body">
            <div class="text-center">
              <img class="profile-user-img img-responsive img-circle" 
            @if (Storage::disk('public')->exists('alunos/00000'.$aluno->RA.'.JPG'))
              src="{{Storage::url('alunos/00000'.$aluno->RA.'.JPG')}}"
              @else
              src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" 
            @endif 
            alt="User profile picture">
            </div>
  
            <h3 class="profile-username text-center">{{$aluno->NOME_ALUNO}}</h3>
  
            <p class="text-muted text-center">{{$aluno->CPF}}</p>
  
            <ul class="list-group list-group-unbordered">
              <li class="list-group-item">
                <b>Matrícula</b> <a class="pull-right">{{$aluno->RA}}</a>
              </li>
              <li class="list-group-item">
                <b>Ano</b> <a class="pull-right">{{$aluno->ANO}}</a>
              </li>
              <li class="list-group-item">
                <b>Turma</b> <a class="pull-right">{{$aluno->TURMA}}</a>
              </li>
            </ul>

          </div>
        </div>
      </div>
      <div class="col-md-9 ">
        <div class="card card-primary card-tabs ">
          <div class="card-header p-0 pt-1">
            <ul class="nav nav-tabs pull-right">
              <li class="pt-2 px-3"><h3 class="card-title"><i class="fa fa-futbol"></i></h3></li>
              <li class="nav-item "><a class="nav-link active" href="#tab_1-1" data-toggle="tab">Inscrições</a></li>
              <li class="nav-item"><a class="nav-link" href="#tab_2-2" data-toggle="tab">Lista de espera</a></li>                      
              <li class="nav-item "><a class="nav-link" href="#tab_1-2" data-toggle="tab">Aguardando Pagamento</a></li>              
            </ul>
          </div>
          <div class="card-body">
            <div class="tab-content">
              <div class="tab-pane fade active show" id="tab_1-1">                
                @forelse ($inscricoes as $i)
                <div class="row">
                  <div class="col-sm-2">
                    <img src="{{$i->ExtAtvTurma->ExtAtv->imagem_mini}}" alt="" class="img-fluid">
                  </div>
                  <div class="col-sm-8">
                    <div class="row">
                      <div class="col-sm-12"><h4>{{$i->ExtAtvTurma->ExtAtv->atividade}}</h4></div>
                      <div class="col-sm-12">{{$i->ExtAtvTurma->descricao_turma}}</div>                    
                    </div>
                  </div>
                </div>
                <hr>
                @empty
                    Nenhuma inscrição...
                @endforelse
              </div>
              <div class="tab-pane fade" id="tab_1-2">
                <h3>Aguardando Pagamento:</h3>
                @forelse ($inscricoes_t as $i)
                <div class="row">
                  <div class="col-sm-2">
                    <img src="{{$i->ExtAtvTurma->ExtAtv->imagem_mini}}" alt="" class="img-responsive">
                  </div>
                  <div class="col-sm-8">
                    <div class="row">
                      <div class="col-sm-12"><h4>{{$i->ExtAtvTurma->ExtAtv->atividade}}</h4></div>
                      <div class="col-sm-12">{{$i->ExtAtvTurma->descricao_turma}}</div>                    
                    </div>
                  </div>
                </div>
                <hr>
                @empty
                    Nenhuma inscrição...
                @endforelse
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane fade" id="tab_2-2">
                <h3>Lista de Espera:</h3>
                @forelse ($espera as $i)
                <div class="row">
                  <div class="col-sm-2">
                    <img src="{{$i->ExtAtvTurma->ExtAtv->imagem_mini}}" alt="" class="img-responsive">
                  </div>
                  <div class="col-sm-8">
                    <div class="row">
                      <div class="col-sm-12"><h4>{{$i->ExtAtvTurma->ExtAtv->atividade}}</h4></div>
                      <div class="col-sm-12">{{$i->ExtAtvTurma->descricao_turma}}</div>                    
                    </div>
                  </div>
                </div>
                <hr>
                @empty
                    Nenhuma espera...
                @endforelse
              </div> 
                                     
              <!-- /.tab-pane -->
            </div>
          </div>
          <!-- /.tab-content -->
        </div>
      </div>
    </div>
  










@stop
@section('js')

    
@endsection