@extends('adminlte::page')
@section('css')
  <meta name="csrf-token" content="{{ Session::token() }}">
@stop

@section('title', 'Solicitação de Flexibilização de Parcelas')
@section('content_header')
    <h1><i class="fa fa-money"></i> Solicitação de Flexibilização de Parcelas</h1>
@stop

@section('content')

<div class="box box-primary">
  <div class="box-header" id="usuario"></div>
  <form action="{{ route('solicita_flex.store') }}" method="post" enctype="multipart/form-data">
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
        <input type="text" name="cpf" id="cpf" class="form-control" data-mask="000.000.000-00" placeholder="123.456.789-10"  autofocus value="{{old('cpf')}}">   
        @if ($errors->has('cpf'))
            <span class="text-danger">*{{$errors->first('cpf')}}</span>                      
        @endif       
        </div>
      <input type="hidden" name="user_token" value="{{str_random(32)}}">
        <div class="col-md-3" id="divMotivo">
          <label for="">Motivo da solicitação:</label>
          <select name="motivo_id" id="motivo" class="form-control" >
            <option value="0"></option>
            @foreach ($motivo as $i)
              <option value="{{$i->id}}">{{$i->motivo}}</option>                
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
        <div class="col-md-6" id="divApelacao" >
          <label for="">Descreva a solicitação:</label>
          <textarea name="apelacao" cols="30" rows="10" class="form-control" >{{old('apelacao')}}</textarea>
          @if ($errors->has('apelacao'))
            <span class="text-danger">*{{$errors->first('apelacao')}}</span>                      
        @endif  
        </div>
      </div>
      <div class="row">
        <div class="col-md-3" id="divComprovante">
          <label for="">Envio de comprovante</label>
          <input type="file" name="upload[]" id="" accept=".jpg, .jpeg, .pdf"  multiple>
          <small class="text-danger">*somente arquivos com extensão: .jpg, .jpeg ou .pdf</small>    
          @if ($errors->has('upload'))
            <br><span class="text-danger">*{{$errors->first('upload')}}</span>                      
        @endif  
        </div>
      </div>
    </div>
    <div class="box-footer" id="divSolicitacao">
      <button type="submit" class="btn btn-success" data-toggle="modal" data-target="#load"> <i class="fa fa-save"></i> Enviar solicitação</button>
    </div>
    <div class="box-footer" id="divVerSolicitacao">
      
    </div>
  </form>
  </div>


<!-- Modal -->
<div id="load" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">        
        <h4 class="modal-title">Aguarde...</h4>
      </div>
      <div class="modal-body">
        <p>Por favor, aguarde enquanto salvamos os dados.</p>        
          <img src="{{ asset('portal/img/load.gif') }}" alt="" class="img-responsive" style="max-width: 150px"></div>
      </div>      

    </div>

  </div>
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
  $("#cpf").focusout(function(){
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
             if(JSON.parse(data).user_token){
              $('#divApelacao').hide(100);
              $('#divComprovante').hide(100);
              $('#divMotivo').hide(100);
              $('#divSolicitacao').hide(100);
              var url = 'http://sia.abel.org.br/solicita_flex/'+JSON.parse(data).cpf+'/edit?token='+JSON.parse(data).user_token;
              $('#divVerSolicitacao').append('<a href="'+url+'" class="btn btn-success">Acompanhe sua solicitação</a>')
              $(location).attr('href', url);
             }
            }
         }
         
      });
});
</script>
@endsection