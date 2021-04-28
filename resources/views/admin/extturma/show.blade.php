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
        <!-- small card -->
        <div class="small-box bg-blue">
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
        <!-- small card -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3>{{App\Model\AtividadesExtraclasse\ExtAtvCancelamento::where('ext_atv_turmas_id',$turma->id)->where('created_at','like','2020%')->count()}}
                </h3>

                <p>Cancelamentos</p>
            </div>
            <div class="icon">
                <i class="fa fa-user-times"></i>
            </div>
            <a href="#" class="small-box-footer">Ver mais <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <!-- small card -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3>{{App\Model\AtividadesExtraclasse\ExtAtvTroca::where('ext_atv_turmas_origem',$turma->id)->where('created_at','like','2020%')->count()}}
                </h3>

                <p>Trocas de Turma</p>
            </div>
            <div class="icon">
                <i class="fa fa-exchange"></i>
            </div>
            <a href="#" class="small-box-footer">Ver mais <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <!-- small card -->
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





<div class="card card-primary">
    <div class="card-header with-border">
        <h3 class="card-title">Informações da Turma </h3>

        <div class="card-tools">
            <div class="input-group input-group-sm hidden-xs" style="width: 100px;">
                <a href="{{route('turma.edit',['turma'=>$turma->id, 'id'=> Request::segment(3)])}}"
                    class="btn btn-warning">
                    <i class="fa fa-pen"></i> </a>
                <a href="" class="btn btn-danger"><i class="fa fa-trash"></i> </a>
            </div>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="row">
            <div class="col-sm-3">
                <label for="">Descrição da turma:</label> {{$turma->descricao_turma}}
            </div>
            <div class="col-sm-3">
                <label for="">Dia:</label> {{$turma->dia}}
            </div>
            <div class="col-sm-2">
                <label for="">Hora:</label> Das {{date('H:i', strtotime($turma->hora_ini))}} até
                {{date('H:i', strtotime($turma->hora_fim))}}
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
    <!-- /.card-body -->
    <div class="card-footer clearfix">

    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card card card-primary card-tabs">
            <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs">
                    <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Inscrições <span
                                class="badge">{{$inscricao_count}}</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Lista de espera <span
                                class="badge">{{$espera_count}}</span></a></li>

                    <li class="dropdown pull-right nav-link">
                        <a class="dropdown-toggle dropdown-icon" data-toggle="dropdown" href="#" aria-expanded="false">
                            Opções <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li role="presentation" class="dropdown-item bg-white"><a role="menuitem" class=""
                                    tabindex="-1" href="#">Efetuar chamada</a></li>
                            <li role="presentation" class="divider bg-white"></li>
                            <li role="presentation" class="dropdown-item bg-white"><a role="menuitem" tabindex="-1"
                                    href="#"> <i class="fa fa-email"></i> Enviar email para turma</a></li>
                            <li role="presentation" class="divider bg-white"></li>
                            <li role="presentation" class="dropdown-item bg-white"><a role="menuitem" tabindex="-1"
                                    href="#">Baixar lista de espera</a></li>
                            <li role="presentation" class="dropdown-item bg-white"><a role="menuitem" tabindex="-1"
                                    href="{{ route('extclasse.inscritos', ['id'=> Request::segment(3),'turma'=>$turma->id]) }}">Baixar lista de inscritos</a></li>
                        </ul>
                    </li>


                </ul>
            </div>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab_1">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-tools">
                                    {{ $inscricao->links() }}
                                </div>
                            </div>
                            <div class="card-body table-responsive">
                                <table class="table table-hover">
                                    <tbody>
                                        <tr>
                                            <th>RA</th>
                                            <th>Nome</th>
                                            <th>Turma</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                        @forelse ($inscricao as $i)
                                        <tr>
                                            <td>{{$i->aluno->RA}}</td>
                                            <td><a href="#" data-toggle="modal"
                                                    data-target="#insc-{{$i->aluno->RA}}">{{$i->aluno->NOME_ALUNO}}</a>
                                            </td>
                                            <td>{{$i->aluno->TURMA}}</td>
                                            <td></td>
                                            <td>
                                                <a href="#" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#troca-{{$i->aluno->RA}}">Trocar de turma</a>
                                            </td>
                                        </tr>
                                        <!--Modal de troca de troca alunos inscritos-->
                                        <div class="modal fade" id="troca-{{$i->aluno->RA}}">
                                            <form action="{{ route('inscricao.update',['inscricao'=>$i->id]) }}"
                                                method="post">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">×</span></button>
                                                            <h4 class="modal-title">Troca de turma do aluno
                                                                {{$i->aluno->NOME_ALUNO}}</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            @csrf
                                                            @method('put')
                                                            <input type="hidden" name="ra" value="{{$i->aluno->RA}}">
                                                            <input type="hidden" name="origem"
                                                                value="{{$i->ext_atv_turmas_id}}">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <label for="">Turma de destino:</label>
                                                                    <select name="destino" id="" class="form-control">
                                                                        <option value=""></option>
                                                                        @foreach ($turma->ExtAtv->turmas as $t)
                                                                        @if ($turma->id != $t->id)
                                                                        <option value="{{$t->id}}">
                                                                            {{$t->descricao_turma}} -
                                                                            ({{$t->ExtAtvVagas($t->id)}} Vagas)</option>
                                                                        @endif
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <label for="">Motivo da troca</label>
                                                                    <textarea name="motivo" id="" cols="30" rows="5"
                                                                        class="form-control"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary">Efetuar
                                                                Trocar</button>
                                                        </div>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                            </form>
                                        </div>
                                        <!-- /.modal-dialog -->
                                        <!--Modal de troca de dados aluno inscritos-->
                                        <div class="modal fade" id="insc-{{$i->aluno->RA}}">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Dados do aluno {{$i->aluno->NOME_ALUNO}}</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span></button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <div class="row">
                                                            <div class="col-sm-3">
                                                                <div class="card card-primary">
                                                                    <div class="card-body card-profile">
                                                                        <div class="text-center">
                                                                            <img class="profile-user-img img-responsive img-circle" 
                                                                            @if (Storage::disk('public')->exists('alunos/00000'.$i->aluno->RA.'.JPG'))
                                                                            src="{{Storage::url('alunos/00000'.$i->aluno->RA.'.JPG')}}"
                                                                            @else
                                                                            src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" 
                                                                            @endif 
                                                                            alt="User profile picture">
                                                                        </div>
                                                        
                                                                        <h3 class="profile-username text-center">{{$i->aluno->NOME_ALUNO}}</h3>
                                                        
                                                                        <p class="text-muted text-center"><strong>CPF:</strong> {{$i->aluno->CPF}}</p>
                                                        
                                                                        <ul class="list-group list-group-unbordered">
                                                                        <li class="list-group-item">
                                                                        <b>Matrícula</b> <a class="pull-right">{{$i->aluno->RA}}</a>
                                                                        </li>
                                                                        <li class="list-group-item">
                                                                            <b>Ano</b> <a class="pull-right">{{$i->aluno->ANO}}</a>
                                                                        </li>
                                                                        <li class="list-group-item">
                                                                            <b>Turma</b> <a class="pull-right">{{$i->aluno->TURMA}}</a>
                                                                        </li>
                                                                        </ul>
                                                                    </div>            
                                                                </div>
                                                            </div>
                                                            <div class="card col-md-9">
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
                                                                @if (!empty($i->ExtAtvAlunosDocumentos))
                                                                    <label for="">Documentos anexados:</label>
                                                                    <div class="row">
                                                                        @foreach ($i->ExtAtvAlunosDocumentos->where('ext_atv_turma_id',$i->ext_atv_turmas_id) as $j)
                                                                            <div class="col-md-2">
                                                                                <a href="{{ Storage::url("$j->url") }}" class="btn btn-primary" download><i class="fa fa-download"></i> {{$j->tipoDocumento->documento}}</a>
                                                                                
                                                                        @endforeach
                                                                    </div>                                                        
                                                                @endif

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" data-dismiss="modal"
                                                            class="btn btn-primary">Fechar</button>
                                                    </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        @empty
                                        Nenhuma inscrição
                                        @endforelse
                                      </tbody>
                                    </table>
                                </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab_2">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title"></div>
    
                                <div class="card-tools">
                                    {{ $inscricao->links() }}
                                </div>
                            </div>
                            <div class="card-body table-responsive no-padding">
                                <table class="table table-hover">
                                    <tbody>
                                        <tr>
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
                                            <td><a href="#" data-toggle="modal"
                                                    data-target="#espera-{{$i->aluno->RA}}">{{$i->aluno->NOME_ALUNO}}</a>
                                            </td>
                                            <td>{{$i->aluno->TURMA}}</td>
                                            <td>{{!empty($i->ExtAtvListaDeEsperaAutorizada->id)?'Última Hab.: '.date('d/m/Y H:i',strtotime($i->ExtAtvListaDeEsperaAutorizada->created_at)):null}}
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="#" class="btn btn-primary" data-toggle="modal"
                                                        data-target="#habilita-{{$i->aluno->RA}}">Hab. para Inscrição</a>
                                                    <a type="button" class="btn btn-primary dropdown-toggle"
                                                        data-toggle="dropdown">
                                                        <span class="caret"></span>
                                                    </a>
                                                    <ul class="dropdown-menu" role="menu">
                                                        <li>
                                                            @if(!empty($i->ExtAtvListaDeEsperaAutorizada->token))
                                                            <a target="_blank"
                                                                href="https://api.whatsapp.com/send?phone=55{{$i->aluno->RESPACADTEL2}}&text=É com grande felicidade que informamos que está disponível a vaga na atividade {{$i->ExtAtvTurma->ExtAtv->atividade}} para o aluno(a) {{$i->aluno->NOME_ALUNO}} {{ route('exibe.espera', ['exibe'=>$i->ExtAtvListaDeEsperaAutorizada->token]) }}">Enviar
                                                                por WPP</a></li>
                                                        @endif
                                                        <li><a href="#" data-toggle="modal"
                                                                data-target="#troca-espera-{{$i->aluno->RA}}">Trocar de
                                                                turma</a></li>
                                                        <li><a href="#" data-toggle="modal"
                                                                data-target="#remove-espera-{{$i->aluno->RA}}">Remover</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        <!--Modal de troca de dados do aluno espera-->
                                        <div class="modal fade" id="remove-espera-{{$i->aluno->RA}}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">×</span></button>
                                                        <h4 class="modal-title">Remover {{$i->aluno->NOME_ALUNO}} da lista
                                                            de espera?</h4>
                                                    </div>
                                                    <form action="{{ route('listadeespera.destroy',['id' => $i->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{$i->id}}">
                                                        @method('delete')
                                                        <div class="modal-body">
                                                            <h3>Confirma a remoção do aluno {{$i->aluno->NOME_ALUNO}} da
                                                                lista de espera?</h3>
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <label for="">Motivo:</label>
                                                                    <textarea name="motivo" id="" cols="30" rows="10"
                                                                        class="form-control"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-danger"> <i
                                                                    class="fa fa-remove"></i> Cofirmar remoção</button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
    
                                        <!--Modal de troca de turma espera-->
                                        <div class="modal fade" id="troca-espera-{{$i->aluno->RA}}">
                                            <form action="{{ route('listadeespera.troca',['listadeespera'=>$i->id]) }}"
                                                method="post">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">×</span></button>
                                                            <h4 class="modal-title">Trocar de lista de espera:
                                                                {{$i->aluno->NOME_ALUNO}}</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            @csrf
                                                            @method('put')
                                                            <input type="hidden" name="ra" value="{{$i->aluno->RA}}">
                                                            <input type="hidden" name="origem"
                                                                value="{{$i->ext_atv_turmas_id}}">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <label for="">Turma de destino:</label>
                                                                    <select name="destino" id="" class="form-control">
                                                                        <option value=""></option>
                                                                        @foreach ($turma->ExtAtv->turmas as $t)
                                                                        @if ($turma->id != $t->id)
                                                                        <option value="{{$t->id}}">{{$t->descricao_turma}} -
                                                                            ({{$t->ExtAtvVagas($t->id)}} Vagas)</option>
                                                                        @endif
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <label for="">Motivo da troca</label>
                                                                    <textarea name="motivo" id="" cols="30" rows="5"
                                                                        class="form-control"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary">Efetuar
                                                                Trocar</button>
                                                        </div>
                                                    </div>
                                                    <!-- /.modal-content -->
                                            </form>
                                        </div>
                                        <!-- /.modal-dialog -->
                            </div>
                            <!--Modal de troca de dados do aluno espera-->
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
                                            <button type="button" data-dismiss="modal"
                                                class="btn btn-primary">Fechar</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!--Modal de troca de habilita espera-->
                            <div class="modal fade" id="habilita-{{$i->aluno->RA}}">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span></button>
                                            <h4 class="modal-title">Habilitar inscrição</h4>
                                        </div>
                                        <div class="modal-body">
                                            Deseja realmente habilitar a inscrição para o aluno {{$i->aluno->NOME_ALUNO}}?
                                            <br>
                                            O responsável será notificado por e-mail.
                                        </div>
                                        <div class="modal-footer">
                                            <form action="{{ route('listadeespera.autorizaInscricao') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{$i->id}}">
                                                <button type="submit" class="btn btn-success">Sim</button>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            @empty
                            Nenhuma inscrição
                            @endforelse
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.tab-pane -->
            </div>
            <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
    </div>

</div>

</div>
</div>



@stop

@section('js')
<script src="{{ asset('/js/jquery.mask.min.js') }}"></script> 
@endsection
