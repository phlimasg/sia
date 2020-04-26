@extends('adminlte::page')
@section('css')
  <meta name="csrf-token" content="{{ Session::token() }}">
@stop

@section('title', 'Solicitação de isenção')
@section('content_header')
    <h1><i class="fa fa-money"></i> Solicitação de Flexibilização de Mensalidade</h1>
@stop

@section('content')
<div class="box box-primary">
  <div class="box-header" id="usuario"></div>
  <form action="{{ route('solicita_flex.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="box-body">
      <div class="row">
        <div class="col-md-12">
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
        <input type="text" name="cpf" id="cpf" class="form-control" data-mask="000.000.000-00" placeholder="123.456.789-10" required autofocus value="{{old('cpf')}}">          
        </div>
        <div class="col-md-3">
          <label for="">Motivo da solicitação:</label>
          <select name="motivo" id="motivo" class="form-control" required>
            <option value="0"></option>
            @foreach ($motivo as $i)
              <option value="{{$i->id}}">{{$i->motivo}}</option>                
            @endforeach            
          </select>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          @foreach ($motivo as $i)
          <div class="alert alert-danger text-justify" id="motivo{{$i->id}}" style="display: none">            
            <h4><i class="icon fa fa-info"></i> Aviso! Documentos de envio obrigatórios.</h4>
            {!!$i->descricao!!}
          </div>             
          @endforeach
        </div>
      </div>
      <div class="row">
        <div class="col-md-12" >
          <label for="">Descreva a solicitação:</label>
          <textarea name="apelacao" cols="30" rows="10" class="form-control" required>{{old('apelacao')}}</textarea>
        </div>
      </div>
      <div class="row">
        <div class="col-md-3" >
          <label for="">Envio de comprovante</label>
          <input type="file" name="upload[]" id="" accept=".jpg, .jpeg, .pdf" required multiple>
        </div>
      </div>
    </div>
    <div class="box-footer">
      <button type="submit" class="btn btn-success"> <i class="fa fa-save"></i> Enviar solicitação</button>
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
            }
         }
         
      });
});
</script>
@endsection