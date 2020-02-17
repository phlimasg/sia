@extends('adminlte::page')

@section('title', 'Extraclasse')

@section('content_header')
    <h1>Detalhes da Atividade Extraclasse</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- Widget: user widget style 1 -->
        <div class="box box-widget widget-user">
            <div class="box-tools pull-right">                
                <a href="{{ route('extclasse.edit', ['id'=>$atv->id]) }}" type="button" class="btn btn-box-tool">
                  <i class="fa fa-pencil"></i>
                </a>                
                <a type="button" class="btn btn-box-tool" ><i class="fa fa-trash"></i></a>
              </div>
          <!-- Add the bg color to the header using any of the bg-* classes -->
          <div class="widget-user-header bg-black" style="background: url('{{$atv->imagem_fundo}}') center center;">
           <div class="col-sm-12" style="background-color: rgba(0, 0, 0, 0.4)">
              <h3 class="widget-user-username">{{$atv->atividade}}</h3>
              <span class="widget-user-desc">Criado por: {{$atv->user}}</span> <br>              
              <span class="widget-user-desc">Última modificação: {{$atv->updated_at}}</span> <br>
           </div>
          </div>
          <div class="widget-user-image">
            <img class="img-circle" src="{{$atv->imagem_mini}}" alt="User Avatar" style="max-height: 90px;">
          </div>
          <div class="box-footer">
            <div class="row">
              <div class="col-sm-6 border-right">
                <div class="description-block">
                  <h5 class="description-header">{{$inscricao}}</h5>
                  <span class="description-text">Inscrições</span>
                </div>
                <!-- /.description-block -->
              </div>
              <!-- /.col -->
              <div class="col-sm-6">
                <div class="description-block">
                  <h5 class="description-header">{{$espera}}</h5>
                  <span class="description-text">Lista de Espera</span>
                </div>
                <!-- /.description-block -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
        </div>
        <!-- /.widget-user -->
      </div>
</div>
@if (Session::has('message'))
    <div class="alert alert-success">
        <b>Dados salvos!</b> <br>
        {{Session::get('message')}}                
    </div>  
    <br>       
  @endif
<div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">Turmas Cadastradas</h3>

          <div class="box-tools">
              <div class="input-group input-group-sm hidden-xs" style="width: 150px;">                  
                  <a href="{{ route('turma.create',['id'=>Request::segment(3)]) }}" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Adicionar Turma</a>
              </div>
          </div>          
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="box-body table-responsive ">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Desc.Turma</th>
                      <th>Dias</th>
                      <th>Horário</th>
                      <th>Vagas</th>
                      <th>Valor</th>
                      <th>Criado por</th>
                      <th></th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>  
        @forelse ($turmas as $i)    
                    <tr>
                      <td>{{$i->id}}</td>
                      <td>{{$i->descricao_turma}}</td>
                      <td>{{$i->dia}}</td>
                      <td>Das {{date('H:i', strtotime($i->hora_ini))}} às {{date('H:i', strtotime($i->hora_fim))}}</td>
                      <td>{{$i->vagas}}</td>
                      <td>{{$i->valor}}</td>
                      <td>{{$i->user}}</td>
                      <td><a href="{{route('turma.show',['id'=>Request::segment(3) ,'turma' => $i->id])}}" class="btn btn-primary"><span class="glyphicon glyphicon-eye-open"></span></a></td>
                      <td><a href="{{route('turma.edit',['id'=>Request::segment(3) ,'turma' => $i->id])}}" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span></a></td>                  
                    </tr>    
        @empty
          <div class="alert alert-info">
              <strong>Ops!</strong> Nenhuma atividade cadastrada. <br>  
          </div> 
        @endforelse
                </tbody>
              </table>
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
        
        </div>
      </div>
      <!-- /.box -->
    </div>
  </div>


@stop

@section('js')

@endsection