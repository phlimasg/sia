@extends('adminlte::page')

@section('title', 'Extraclasse')

@section('content_header')
    <h1>Atividades Extraclasse</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-aqua"><i class="fa fa-graduation-cap"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Ativ. Cadastradas</span>
            <span class="info-box-number">{{App\Model\AtividadesExtraclasse\ExtAtv::count()}}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-group"></i></span>
  
            <div class="info-box-content">
              <span class="info-box-text">Turmas Cadastradas</span>
              <span class="info-box-number">{{App\Model\AtividadesExtraclasse\ExtAtvTurma::count()}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-yellow"><i class="fa fa-user"></i></span>
    
              <div class="info-box-content">
                <span class="info-box-text">Inscritos em {{date('Y')}}</span>
                <span class="info-box-number">{{App\Model\AtividadesExtraclasse\ExtInscricao::where('ano',date('Y'))->count()}} alunos</span>                
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-list-ol"></i></span>
      
                <div class="info-box-content">
                  <span class="info-box-text">Lista de espera</span>
                  <span class="info-box-number">{{App\Model\AtividadesExtraclasse\ExtAtvListaDeEspera::where('ano',date('Y'))->count()}} alunos</span>
                  <a href="{{ route('downloadLista') }}" class="info-box-text"><span class="fa fa-download"></span> Baixar Lista</a>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
</div>
<div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">Atividades Extraclasses Cadastradas</h3>

          <div class="box-tools">
              <div class="input-group input-group-sm hidden-xs" style="width: 150px;">                  
                  <a href="{{ route('extclasse.create') }}" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Adicionar Atividade</a>
              </div>
          </div>          
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive ">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>ID</th>
                <th>Atividade</th>
                <th>Criado por</th>
                <th></th>
                <th></th>
                <th></th>
              </tr>
            </thead>
            <tbody>  
  @forelse ($atv as $i)    
              <tr>
                <td>{{$i->id}}</td>
                <td>{{$i->atividade}}</td>
                <td>{{$i->user}}</td>
                <td></td>
                <td><a href="{{route('extclasse.show',['id' => $i->id])}}" class="btn btn-primary"><span class="glyphicon glyphicon-eye-open"></span></a></td>
                <td><a href="{{route('extclasse.edit',['id' => $i->id])}}" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span></a></td>                  
              </tr>    
  @empty
  
  <div class="alert alert-info">
      <strong>Ops!</strong> Nenhuma atividade cadastrada. <br>  
  </div> 
  @endforelse
          </tbody></table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
            {{ $atv->links() }}
          </div>
      </div>
      <!-- /.box -->
    </div>
  </div>
    
@stop

@section('js')

    
@endsection