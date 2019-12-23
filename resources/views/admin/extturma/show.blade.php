@extends('adminlte::page')

@section('title', 'Extraclasse')



@section('content')
<div class="row">
    <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>150</h3>

              <p>Alunos Inscritos</p>
            </div>
            <div class="icon">
              <i class="fa fa-group"></i>
            </div>
            <a href="#" class="small-box-footer">Ver mais <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
              <div class="inner">
                <h3>150</h3>
  
                <p>Cancelamentos</p>
              </div>
              <div class="icon">
                <i class="fa fa-user-times"></i>
              </div>
              <a href="#" class="small-box-footer">Ver mais <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3>150</h3>
    
                  <p>Trocas de Turma</p>
                </div>
                <div class="icon">
                  <i class="fa fa-exchange"></i>
                </div>
                <a href="#" class="small-box-footer">Ver mais <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                  <div class="inner">
                    <h3>150</h3>
      
                    <p>Faltas</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-exclamation-triangle"></i>
                  </div>
                  <a href="#" class="small-box-footer">Ver mais <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
</div>

@if (Session::has('message'))
    <div class="alert alert-success">
        <b>Dados salvos!</b> <br>
        {{Session::get('message')}}                
    </div>  
    <br>       
  @endif

  <div class="box box-primary">
    <div class="box-header with-border">
    <h3 class="box-title">Informações da Turma </h3>

      <div class="box-tools">
          <div class="input-group input-group-sm hidden-xs" style="width: 100px;">                  
          <a href="{{route('turma.edit',['id'=>Request::segment(3), 'turma'=> $turma->id])}}" class="btn"><i class="fa fa-pencil"></i> </a>
              <a href="" class="btn"><i class="fa fa-trash"></i> </a>
          </div>
      </div>          
    </div>
    <!-- /.box-header -->
    <div class="box-body">            
      <div class="row">
          <div class="col-sm-3">
            <label for="">Descrição da turma:</label> {{$turma->descricao_turma}}
          </div>
          <div class="col-sm-3">
              <label for="">Dia:</label> {{$turma->dia}}
            </div>
            <div class="col-sm-2">
              <label for="">Hora:</label> Das {{date('H:i', strtotime($turma->hora_ini))}} até {{date('H:i', strtotime($turma->hora_fim))}}
            </div>
            <div class="col-sm-2">
                <label for="">Vagas:</label> {{$turma->vagas}}
              </div>
              <div class="col-sm-2">
                <label for="">Valor:</label> {{$turma->valor}}
              </div>
        </div>
        <div class="row">
          <div class="col-sm-3">
            <label for="">Libera:</label> {{date('d/m/Y H:i', strtotime($turma->dia_libera))}}
          </div>
          <div class="col-sm-3">
            <label for="">Bloqueia:</label> {{date('d/m/Y H:i', strtotime($turma->dia_bloqueia))}}
          </div>                                                     
        </div>
        <div class="row">
            <div class="col-sm-6">
                <label for="">Última edição por:</label> {{$turma->user}}
              </div>
              <div class="col-sm-3">
                <label for="">Criado em:</label> {{date('d/m/Y H:i', strtotime($turma->created_at))}}
              </div>
              <div class="col-sm-3">
                  <label for="">Modificado em:</label> {{date('d/m/Y H:i', strtotime($turma->updated_at))}}
                </div>     
        </div> 
    </div>
    <!-- /.box-body -->
    <div class="box-footer clearfix">
    
    </div>
  </div>
  <!-- /.box -->
  <div class="box box-danger">
    <div class="box-header">
      <h3 class="box-title">Inscritos</h3>
      <div class="box-tools">
          <div class="input-group input-group-sm hidden-xs" style="width: 100px;">                  
              <a href="" class="btn btn-danger"><i class="fa fa-eye"></i> Lista de espera</a>
          </div>
      </div>  
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-md-12">
                <!-- Custom Tabs -->
                
              </div>
        </div>
    </div>
  </div>


@stop

@section('js')

@endsection