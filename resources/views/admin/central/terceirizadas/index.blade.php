@extends('adminlte::page')

@section('title', 'Extraclasse')

@section('content_header')
    <h1>Atividades Extraclasse</h1>
@stop

@section('content')
@if (Session::has('message'))
    <div class="alert alert-success">
      {{Session::get('message')}}
    </div>
@endif
@if (Session::has('error2'))
<div class="alert alert-danger alert-dismissible" id='message'>
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  <h4><i class="icon fa fa-check"></i> Aviso!</h4>
  {{Session::get('error2')}} <br>
</div>    
@endif
@if (Session::has('error'))
<div class="alert alert-danger alert-dismissible" id='message'>
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  <h4><i class="icon fa fa-check"></i> Aviso!</h4>
  {{Session::get('error')['message']}}. <br>
  Código: {{Session::get('error')['status_code']}}.<br>
  {{Session::get('error')['details'][0]['description']}}.<br>
  {{Session::get('error')['details'][0]['description_detail']}}  
</div>    
@endif
@error('motivo')
<div class="panel panel-danger">
  <div class="panel-body">
    <div class=" text-danger">* {{ $message }}</div>
  </div>
</div>
@enderror
@error('amount')
<div class="panel panel-danger">
  <div class="panel-body">
    <div class=" text-danger">* {{ $message }}</div>
  </div>
</div>
@enderror
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Inscrições</h3>
  
        <div class="box-tools">
          <form action="{{ route('extraclasse_terceirizadas.store') }}" method="post">
            @csrf
            <div class="input-group input-group-sm hidden-xs" style="width: 250px;">
              <input type="text" name="table_search" class="form-control pull-right" placeholder="Procurar">
    
              <div class="input-group-btn">
                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
              </div>
            </div>
          
          </form>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body table-responsive no-padding">
        <table class="table table-hover">
          <tbody><tr>
            <th>ID</th>
            <th>Aluno</th>
            <th>Atividade</th>
            <th>Turma</th>
            <th>Valor</th>
            <th></th>
          </tr>
          @foreach ($inscricao as $i)
          <tr>
            <td>{{$i->id}}</td>
            <td>{{!empty($i->aluno->NOME_ALUNO) ? $i->aluno->NOME_ALUNO : 'Saiu da escola'}}</td>
            <td>{{$i->ExtAtvTurma->ExtAtv->atividade}}</td>
            <td>{{$i->ExtAtvTurma->descricao_turma}}</td>
            <td>{{substr_replace($i->amount,',',-2,0)}}</td>
            <td>
              <div class="btn-group">                
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pg_{{$i->id}}">Pagar</button>
                <div class="btn-group">
                  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span></button>
                  <ul class="dropdown-menu" role="menu">                    
                    <li><a href="#"  data-toggle="modal" data-target="#{{$i->id}}"><i class="fa fa-trash "></i> Excluir</a></li>
                  </ul>
                </div>
              </div>              
            </td>
          </tr> 
          <!-- Modal -->
          <div id="{{$i->id}}" class="modal fade" role="dialog">
            <div class="modal-dialog">

              <!-- Modal content-->
              <form action="{{ route('inscricao.cancelamento') }}" method="post">
                <input type="hidden" name="id" value="{{$i->id}}">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Extorno de Valor/Cancelar inscrição</h4>
                </div>
                <div class="modal-body">
                    @csrf
                  <p>Valor da inscrição: R${{substr_replace($i->amount,',',-2,0)}}</p>
                    <div class="row">
                      <div class="col-sm-5">
                        <label>Valor para devolução:</label>
                        <input type="text" name="amount" id="amount" class="form-control" data-mask="#.##0,00" data-mask-reverse="true">
                      </div>
                    </div>
                    <div class="row">
                    <div class="col-sm-12">
                      <label>Motivo:</label>
                      <textarea name="motivo" id="" cols="30" rows="5" class="form-control"></textarea>                      
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <input type="checkbox" name="cancel" id="" checked>Cancelar inscrição.
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-danger" >Confirmar</button>
                </div>
              </div>
            </form>

            </div>
          </div>   
          
          <!-- Modal -->
          <div id="pg_{{$i->id}}" class="modal fade" role="dialog">
            <div class="modal-dialog">

              <!-- Modal content-->
              <form action="{{ route('extraclasse_terceirizadas.pagamento') }}" method="post">
                <input type="hidden" name="id" value="{{$i->id}}">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Confirma o pagamento?</h4>
                </div>
                <div class="modal-body">
                    @csrf
                  <p>Valor da inscrição: R${{substr_replace($i->amount,',',-2,0)}}</p>                                     
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-success" >Confirmar Pagamento</button>
                </div>
              </div>
            </form>

            </div>
          </div>   
          @endforeach
        </tbody></table>
      </div>
      <!-- /.box-body -->
      <div class="box-bottom">
        {{ $inscricao->links() }}
      </div>
    </div>
    <!-- /.box -->
  </div>

</div>
    
@stop

@section('js')
    
@endsection