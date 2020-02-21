@extends('adminlte::page')

@section('title', 'Extraclasse')



@section('content')
@error('motivo')
<div class="alert alert-danger alert-dismissible">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  <h4><i class="icon fa fa-ban"></i> Aviso!</h4>
  *{{$message}}
</div>
@enderror
@if (Session::has('message'))
<div class="alert alert-success alert-dismissible">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  <h4><i class="icon fa fa-check"></i> Aviso!</h4>  
    {{Session::get('message')}}  
</div>      
@endif
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
                <h3>{{App\Model\AtividadesExtraclasse\ExtAtvCancelamento::where('ext_atv_turmas_id',$turma->id)->where('created_at','like','2020%')->count()}}</h3>
  
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
                <h3>{{App\Model\AtividadesExtraclasse\ExtAtvTroca::where('ext_atv_turmas_origem',$turma->id)->where('created_at','like','2020%')->count()}}</h3>
    
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
                    <h3>xxx</h3>
      
                    <p>Faltas</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-exclamation-triangle"></i>
                  </div>
                  <a href="#" class="small-box-footer">Ver mais <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
</div>





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
                  <li class="active"><a href="#tab_1" data-toggle="tab">Inscrições <span class="badge">{{$inscricao_count}}</span></a></li>
                  <li><a href="#tab_2" data-toggle="tab">Lista de espera <span class="badge">{{$espera_count}}</span></a></li>                                                    
                  
                  <li class="dropdown pull-right">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                      Opções <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                      <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Efetuar chamada</a></li>
                      <li role="presentation" class="divider"></li>
                      <li role="presentation"><a role="menuitem" tabindex="-1" href="#"> <i class="fa fa-email"></i> Enviar email para turma</a></li>
                      <li role="presentation" class="divider"></li>
                      <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Baixar lista de espera</a></li>
                      <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Baixar lista de inscritos</a></li>
                    </ul>
                  </li>                  


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
                              <td>                               
                                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#troca-{{$i->aluno->RA}}">Trocar de turma</a>                               
                            </td>
                            </tr> 
                            <div class="modal fade" id="troca-{{$i->aluno->RA}}">
                              <form action="{{ route('inscricao.update',['id'=>$i->id]) }}" method="post">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title">Troca de turma do aluno {{$i->aluno->NOME_ALUNO}}</h4>
                                  </div>
                                  <div class="modal-body">
                                    @csrf   
                                    @method('put')                                    
                                    <input type="hidden" name="ra" value="{{$i->aluno->RA}}">
                                    <input type="hidden" name="origem" value="{{$i->ext_atv_turmas_id}}">
                                    <div class="row">
                                      <div class="col-sm-12">
                                        <label for="">Turma de destino:</label>
                                        <select name="destino" id="" class="form-control">
                                          <option value=""></option>
                                          @foreach ($turma->ExtAtv->turmas as $t)
                                          @if ($turma->id != $t->id)
                                            <option value="{{$t->id}}">{{$t->descricao_turma}} - ({{$t->ExtAtvVagas($t->id)}} Vagas)</option>                                              
                                          @endif
                                          @endforeach
                                        </select>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-sm-12">
                                        <label for="">Motivo da troca</label>
                                        <textarea name="motivo" id="" cols="30" rows="5" class="form-control"></textarea>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="modal-footer">                                    
                                    <button type="submit"  class="btn btn-primary">Efetuar Trocar</button>
                                  </div>
                                </div>
                                <!-- /.modal-content -->
                              </form>                                
                              </div>
                              <!-- /.modal-dialog -->
                            </div>   
                            <div class="modal fade" id="insc-{{$i->aluno->RA}}">
                              <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title">Dados do aluno {{$i->aluno->NOME_ALUNO}}</h4>
                                  </div>
                                  <div class="modal-body">
                                    <div class="row">
                                      <div class="col-sm-3">
                                        <label for="">Resp. Acad.:</label><br>
                                        {{$i->aluno->RESPACAD}}
                                      </div>
                                      <div class="col-sm-3">
                                        <label for="">Tel.:</label><br>
                                        {{$i->aluno->RESPACADTEL1}} - {{$i->aluno->RESPACADTEL2}}
                                      </div>
                                      <div class="col-sm-3">
                                        <label for="">Email:</label><br>
                                        {{$i->aluno->RESPACADEMAIL}}
                                      </div>
                                    </div>                                                                        
                                    <div class="row">
                                      <div class="col-sm-3">
                                        <label for="">Resp. Fin.:</label><br>
                                        {{$i->aluno->RESPFIN}}
                                      </div>
                                      <div class="col-sm-3">
                                        <label for="">Tel.:</label><br>
                                        {{$i->aluno->RESPFINTEL1}} - {{$i->aluno->RESPFINCEL}}
                                      </div>
                                      <div class="col-sm-3">
                                        <label for="">Email:</label><br>
                                        {{$i->aluno->RESPFINEMAIL}}
                                      </div>
                                    </div>                                  
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
                            <th>                              
                          </th>
                          </tr>
                          @forelse ($espera as $i)
                            <tr>
                              <td>{{$i->aluno->RA}}</td>
                              <td><a href="#" data-toggle="modal" data-target="#espera-{{$i->aluno->RA}}">{{$i->aluno->NOME_ALUNO}}</a></td>
                              <td>{{$i->aluno->TURMA}}</td>
                              <td></td>
                              <td>
                                <div class="btn-group">
                                  <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#troca-{{$i->aluno->RA}}">Hab. para Inscrição</a>
                                  <a type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                    <span class="caret"></span>
                                  </a>
                                  <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Trocar de turma</a></li>
                                    <li><a href="#">Remover</a></li>
                                  </ul>
                                </div>
                              </td>
                            </tr> 
                            <div class="modal fade" id="espera-{{$i->aluno->RA}}">
                              <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title">Dados do aluno {{$i->aluno->NOME_ALUNO}}</h4>
                                  </div>
                                  <div class="modal-body">
                                    <div class="row">
                                      <div class="col-sm-3">
                                        <label for="">Resp. Acad.:</label><br>
                                        {{$i->aluno->RESPACAD}}
                                      </div>
                                      <div class="col-sm-3">
                                        <label for="">Tel.:</label><br>
                                        {{$i->aluno->RESPACADTEL1}} - {{$i->aluno->RESPACADTEL2}}
                                      </div>
                                      <div class="col-sm-3">
                                        <label for="">Email:</label><br>
                                        {{$i->aluno->RESPACADEMAIL}}
                                      </div>
                                    </div>                                                                        
                                    <div class="row">
                                      <div class="col-sm-3">
                                        <label for="">Resp. Fin.:</label><br>
                                        {{$i->aluno->RESPFIN}}
                                      </div>
                                      <div class="col-sm-3">
                                        <label for="">Tel.:</label><br>
                                        {{$i->aluno->RESPFINTEL1}} - {{$i->aluno->RESPFINCEL}}
                                      </div>
                                      <div class="col-sm-3">
                                        <label for="">Email:</label><br>
                                        {{$i->aluno->RESPFINEMAIL}}
                                      </div>
                                    </div>                                  
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
                </div>
                <!-- /.tab-content -->
              </div>
                
              </div>
        </div>
   


@stop

@section('js')

@endsection