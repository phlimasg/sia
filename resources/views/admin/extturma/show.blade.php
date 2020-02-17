@extends('adminlte::page')

@section('title', 'Extraclasse')



@section('content')
<div class="row">
    <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
            <h3>{{$inscricao_count}}</h3>

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
    
        <div class="row">
            <div class="col-md-12">
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#tab_1" data-toggle="tab">Inscrições</a></li>
                  <li><a href="#tab_2" data-toggle="tab">Lista de espera</a></li>                                                    
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1">
                    <div class="box">
                      <div class="box-header">
                        <div class="box-title"></div>
          
                        <div class="box-tools">
                          {{ $inscricao->links() }}
                        </div>
                      </div>
                      <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                          <tbody><tr>
                            <th>RA</th>
                            <th>Nome</th>
                            <th>Turma</th>
                            <th></th>
                            <th></th>
                          </tr>
                          @forelse ($inscricao as $i)
                            <tr>
                              <td>{{$i->aluno->RA}}</td>
                              <td><a href="#" data-toggle="modal" data-target="#insc-{{$i->aluno->RA}}">{{$i->aluno->NOME_ALUNO}}</a></td>
                              <td>{{$i->aluno->TURMA}}</td>
                              <td></td>
                              <td></td>
                            </tr> 
                            <div class="modal fade" id="insc-{{$i->aluno->RA}}">
                              <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title">Dados do aluno</h4>
                                  </div>
                                  <div class="modal-body">
                                    <p>One fine body…</p>
                                  </div>
                                  <div class="modal-footer">                                    
                                    <button type="button" data-dismiss="modal" class="btn btn-primary">Fechar</button>
                                  </div>
                                </div>
                                <!-- /.modal-content -->
                              </div>
                              <!-- /.modal-dialog -->
                            </div>                           
                          @empty
                              Nenhuma inscrição
                          @endforelse
                        </tbody></table>
                      </div>
                    </div>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_2">
                    The European languages are members of the same family. Their separate existence is a myth.
                    For science, music, sport, etc, Europe uses the same vocabulary. The languages only differ
                    in their grammar, their pronunciation and their most common words. Everyone realizes why a
                    new common language would be desirable: one could refuse to pay expensive translators. To
                    achieve this, it would be necessary to have uniform grammar, pronunciation and more common
                    words. If several languages coalesce, the grammar of the resulting language is more simple
                    and regular than that of the individual languages.
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_3">
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                    Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                    when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                    It has survived not only five centuries, but also the leap into electronic typesetting,
                    remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset
                    sheets containing Lorem Ipsum passages, and more recently with desktop publishing software
                    like Aldus PageMaker including versions of Lorem Ipsum.
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div>
                
              </div>
        </div>
   


@stop

@section('js')

@endsection