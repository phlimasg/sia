@extends('adminlte::page')
@section('css')
  <meta name="csrf-token" content="{{ Session::token() }}">
@stop

@section('title', 'Solicitação de Flexibilização de Parcelas')
@section('content_header')
    <h1><i class="fa fa-money"></i> Solicitação de Flexibilização de Parcelas</h1>
@stop

@section('content')

<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">Recebemos sua solicitação com sucesso!</h3>
  </div>
  <div class="box-body">
    <div class="row">
      <div class="col-sm-6">
        <div class="row">
          <div class="col-sm-12">
            <p>Caso precise, continue editando as informações abaixo. Se já estiver terminado, pode fechar essa página e deixo tudo com a gente!</p>
        A última alteração salva em <b> {{date('d/m/Y  H:i:s', strtotime($isencao->updated_at))}}</b>.
          </div>          
        </div>
      </div>
      
      
      <div class="col-sm-push-3 col-sm-3">        
        @if ($isencao->status== 'Em Análise')
        <div class="info-box bg-aqua">
          <span class="info-box-icon"><i class="fa fa-envelope-o"></i></span>
    
          <div class="info-box-content">
            <small>Status</small>
          <h3>{{$isencao->status}}</h3>
            
          </div>
          <!-- /.info-box-content -->
        </div>
        @elseif($isencao->status== 'Indeferido')
        <div class="info-box bg-red">
          <span class="info-box-icon"><i class="fa fa-remove"></i></span>
    
          <div class="info-box-content">
            <small>Status</small>
          <h3>{{$isencao->status}}</h3>
            
          </div>
          <!-- /.info-box-content -->
        </div>
        @elseif($isencao->status== 'Deferido')
        <div class="info-box bg-green">
          <span class="info-box-icon"><i class="fa fa-check"></i></span>
    
          <div class="info-box-content">
            <small>Status</small>
          <h3>{{$isencao->status}}</h3>
            
          </div>
          <!-- /.info-box-content -->
        </div>
        
        @elseif($isencao->status== 'Falta Documento')
        <div class="info-box bg-yellow">
          <span class="info-box-icon"><i class="fa fa-fa-file"></i></span>
    
          <div class="info-box-content">
            <small>Status</small>
          <h3>{{$isencao->status}}</h3>
            
          </div>
          <!-- /.info-box-content -->
        </div>
        @elseif($isencao->status== 'Supervisão Administrativa')
        <div class="info-box bg-gray">
          <span class="info-box-icon"><i class="fa fa-fa-user"></i></span>
    
          <div class="info-box-content">
            <small>Status</small>
          <h3>{{$isencao->status}}</h3>
            
          </div>
          <!-- /.info-box-content -->
        </div>
        @endif
        
        @foreach ($isencao->alunos as $i)
          @if ($isencao->descontoAutorizado($i->RA))
            @php($aut = $isencao->descontoAutorizado($i->RA)->orderBy('created_at','desc')->first('percentual'))
            @if ($aut)
            <div class="box box-widget widget-user-2">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-yellow">
                <div class="widget-user-image">                                                    
                  <img class="img-circle" 
                  @if (Storage::disk('public')->exists('alunos/00000'.$i->RA.'.JPG'))
                    src="{{Storage::url('alunos/00000'.$i->RA.'.JPG')}}"
                    @else
                    src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" 
                  @endif  alt="User Avatar">
                </div>
                <!-- /.widget-user-image -->
                <h3 class="widget-user-username">{{$i->NOME_ALUNO}}</h3>
                <h5 class="widget-user-desc">{{$i->TURMA}}</h5>
              </div>
              <div class="box-footer no-padding">
                <ul class="nav nav-stacked">                  
                  <li><a href="#">Desconto Deferido Total<span class="pull-right">{{ $aut->percentual }}%</span></a></li>
                </ul>
              </div>
            </div>
            @endif
          @endif
            
        @endforeach
    
      </div>
    </div>
  </div>
</div>

<div class="box box-success direct-chat direct-chat-success">
  <div class="box-header with-border">
    <h3 class="box-title">Mensagens da comissão de descontos:</h3>

    <div class="box-tools pull-right">
      <span data-toggle="tooltip" title="" class="badge bg-green" data-original-title="{{$isencao->mensagemPubAllAsc->count()}} Mensagens">{{$isencao->mensagemPubAllAsc->count()}}</span>
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
      </button>      
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <!-- Conversations are loaded here -->
    <div class="direct-chat-messages">
      <!-- Message. Default to the left -->
      @forelse ($isencao->mensagemPubAllAsc as $i)
      <div class="direct-chat-msg">
        <div class="direct-chat-info clearfix">
          <span class="direct-chat-name pull-left">Comissão de descontos</span>
          <span class="direct-chat-timestamp pull-right"> {{date('d/m/Y', strtotime($i->created_at))}} às {{date('H:i', strtotime($i->created_at))}}</span>
        </div>
        <!-- /.direct-chat-info -->
        <img class="direct-chat-img" src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" alt="Message User Image"><!-- /.direct-chat-img -->
        <div class="direct-chat-text">
          {!!$i->msg_usuario!!}
        </div>
        <!-- /.direct-chat-text -->
      </div>        
      @empty
          Nenhuma mensagem para mostar
      @endforelse 
    </div>
  </div>
  <!-- /.box-body -->  
</div>

<div class="box box-primary">
  <div class="box-header with-border" id="usuario"></div>
  <form action="{{ route('solicita_flex.update',['id'=> $isencao->id]) }}" method="post" enctype="multipart/form-data">
    @method('put')
    @csrf
    <div class="box-body">
      <div class="row">
        <div class="col-md-6">
          <div class="alert alert-danger alert-dismissible" style="display: none" id="aviso">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-ban"></i> AVISO!</h4>
            Verifique o CPF. <br> Responsável financeiro não encontrado na base TOTVS.
          </div>
        </div>
      </div>
      <div class="row">        
        <div class="col-md-2 form-group" id="input_cpf">
          <label for="">CPF do Responsável financeiro:</label>
        <input type="text" name="cpf" id="cpf" class="form-control" data-mask="000.000.000-00" placeholder="123.456.789-10" required autofocus value="{{$isencao->cpf}}" disabled>  
        @if ($errors->has('cpf'))
            <span class="text-danger">*{{$errors->first('cpf')}}</span>                      
        @endif         
        </div>
      <input type="hidden" name="user_token" value="{{$isencao->user_token}}">
        <div class="col-md-3">
          <label for="">Motivo da solicitação:</label>
          <select name="motivo_id" id="motivo" class="form-control" required>
            <option value="0"></option>
            @foreach ($motivo as $i)
              <option value="{{$i->id}}" @if ($i->id == $isencao->motivo_id) selected @endif >{{$i->motivo}}</option>                
            @endforeach            
          </select>
          @if ($errors->has('motivo_id'))
            <span class="text-danger">*{{$errors->first('motivo_id')}}</span>                      
        @endif  
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          @foreach ($motivo as $i)
          <div class="alert alert-danger text-justify" id="motivo{{$i->id}}" style="display: none">            
            <h4><i class="icon fa fa-info"></i> Aviso! Documentos de envio obrigatórios.</h4>
            {!!$i->descricao!!}
          </div>             
          @endforeach
        </div>
      </div>
      <div class="row">
        <div class="col-md-6" >
          <label for="">Descreva a solicitação:</label>
          <textarea name="apelacao" cols="30" rows="10" class="form-control" required>@if (empty(old('apelacao'))){{$isencao->apelacao}}@else {{old('apelacao')}} @endif</textarea>
          @if ($errors->has('apelacao'))
            <span class="text-danger">*{{$errors->first('apelacao')}}</span>                      
        @endif 
        </div>
      </div>
      <div class="row">
        <div class="col-md-3" >
          <label for="">Envio de comprovante</label>
          <input type="file" name="upload[]" id="" accept=".jpg, .jpeg, .pdf" multiple>
          @if ($errors->has('upload'))
            <span class="text-danger">*{{$errors->first('upload')}}</span>                      
           @endif
        </div>
      </div>
      <hr>
      <div class="panel panel-default">
        <div class="panel-heading">
          Documentos anexados
        </div>
        <div class="panel-body">
          <div class="row">
            @forelse ($isencao->documentos as $i)
            <div class="col-sm-1 text-center">
              @if (substr($i->url, -4) == '.pdf')
              <a href="{{Storage::url($i->url)}}" download="">
                <img src="{{ asset('portal/img/pdf-icon.png') }}" alt="Fazer download" class="img-responsive">              
                {{mb_strimwidth( $i->nome, 0, 15, "..." )}} 
              </a>
              @if ($isencao->status== 'Em Análise' || $isencao->status== 'Falta Documento')
              <a href="{{ route('destroyImage', ['id'=>$i->id,'nome'=>$i->nome]) }}" class="btn btn-danger btn-block"> <i class="fa fa-trash"></i> Apagar</a>
              @endif
              @else
              <a href="{{Storage::url($i->url)}}" download="">
                <img src="{{Storage::url($i->url)}}" alt="Fazer download" class="img-responsive">              
                {{mb_strimwidth( $i->nome, 0, 15, "..." )}}  
              </a>
              @if ($isencao->status== 'Em Análise' || $isencao->status== 'Falta Documento')
                <a href="{{ route('destroyImage', ['id'=>$i->id,'nome'=>$i->nome]) }}" class="btn btn-danger btn-block"> <i class="fa fa-trash"></i> Apagar</a>              
              @endif
              @endif
            </div>
            @empty
            <h1>Nenhum arquivo adicionado</h1>
                
            @endforelse
          </div>
          
        </div>
        
      </div>
    </div>
    <div class="box-footer">
      @if ($isencao->status== 'Em Análise' || $isencao->status== 'Falta Documento')
        <button type="submit" class="btn btn-primary btn-block btn-lg"> <i class="fa fa-save"></i> Atualizar solicitação</button>        
      @endif
      
    </div>
  </form>
  </div>
  
  
@stop

@section('js')
<script>
  let last_id = $('#motivo').val()
  $("body").addClass('sidebar-collapse').trigger('collapsed.pushMenu');
  $('#motivo').change(function(){
    let id = $('#motivo').val()
    $('#motivo'+id).show(100);
    if(last_id != id){
      $('#motivo'+last_id).hide(100)
      last_id = id
    }
  })
</script>

<script type="text/javascript">   
  $(document).ready(function(){
      var cpf = $("#cpf").val();        
      var token = $("input[name=_token]").val();  
      //alert(token + cpf)
      $.post({
        headers: {
              'X-CSRF-TOKEN': $("input[name=_token]").val()
        },
         type:'POST',
         url:"{{ route('verificaCPF') }}",
         data:{cpf:cpf},
         success:function(data,status){
           if (data == 'null') {
             $('#aviso').css('display','block')             
             $('#input_cpf').attr('class','col-md-3 form-group has-error') 
           }else{                                             
            $('#cpf').focusin()
            $('#input_cpf').attr('class','col-md-3 form-group has-success') 
            $('#aviso').css('display','none') 
             console.log(JSON.parse(data), status);
             $('#usuario').empty()
             $('#usuario').append('Nome: ' + JSON.parse(data).RESPFIN + ' | Email: ' + JSON.parse(data).RESPFINEMAIL + ' | CPF: '+JSON.parse(data).RESPFINCPF)
            }
         }
         
      });
});
</script>
@endsection