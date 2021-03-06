@extends('adminlte::page')
@section('title', 'Atividades Extraclasse')
@section('content_header')

@endsection
@section('content')
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
<form action="{{ route('pagamento.espera') }}" method="post">
<input type="hidden" name="id_espera" value="{{$autoriza->ExtAtvListaDeEspera->id}}">
<input type="hidden" name="token_autoriza" value="{{$autoriza->token}}">

<div class="row">
    <div class="col-sm-3">
<div class="box box-primary">
    <div class="box-header">
       <i class="fa fa-user"></i> Dados do Aluno
    </div>
    <div class="box-body">
        <b>Matrícula: </b>{{$autoriza->ExtAtvListaDeEspera->aluno->RA}} <br>
        <b>Nome:</b> {{$autoriza->ExtAtvListaDeEspera->aluno->NOME_ALUNO}} <br>
        <b>Turma:</b> {{$autoriza->ExtAtvListaDeEspera->aluno->TURMA}} <br>
    </div>
</div>
    </div>
    <div class="col-sm-9">
        <div class="box box-primary">
            <div class="box-header">Dados da atividade</div>
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-3">
                        <img src="{{$autoriza->ExtAtvListaDeEspera->ExtAtvTurma->ExtAtv->imagem_mini}}" class="img-responsive">
                    </div>
                    <div class="col-sm-9">
                        <b>{{$autoriza->ExtAtvListaDeEspera->ExtAtvTurma->ExtAtv->atividade}}</b> <br>
                        {{$autoriza->ExtAtvListaDeEspera->ExtAtvTurma->descricao_turma}}<br>
                        {{$autoriza->ExtAtvListaDeEspera->ExtAtvTurma->dia}}<br>
                        {{$autoriza->ExtAtvListaDeEspera->ExtAtvTurma->hora_ini}}<br>
                        <b>Valor:</b> {{$autoriza->ExtAtvListaDeEspera->ExtAtvTurma->valor}}<br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@php($valor = floatval(str_replace(',','.',$autoriza->ExtAtvListaDeEspera->ExtAtvTurma->valor)))
@if ($valor != 0)
<div class="box box-danger">
    <div class="box-header">
        <i class="fa fa-map-marker"></i> Confirme se os dados do comprador estão corretos.
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-sm-2">
                <label for="">Nome:</label>
                <input type="text" name="firstname" id="" value="{{explode(' ', $autoriza->ExtAtvListaDeEspera->aluno->RESPFIN)[0]}}" class="form-control">
                @error('firstname')
                <div class=" text-danger">* {{ $message }}</div>
            @enderror
            </div>
            <div class="col-sm-8">
                <label for="">Sobrenome:</label>
                <input type="text" name="lastname" id="" value="@foreach(explode(' ', $autoriza->ExtAtvListaDeEspera->aluno->RESPFIN) as $i)@if(explode(' ', $autoriza->ExtAtvListaDeEspera->aluno->RESPFIN)[0]!= $i){{$i}} @endif @endforeach" class="form-control">
                @error('lastname')
                <div class=" text-danger">* {{ $message }}</div>
            @enderror
            </div>

        </div>
        <div class="row">
            <div class="col-sm-2">
                <label for="">CEP:</label>
            <input type="text" name="cep" id="cep" class="form-control" value="{{old('cep')}}">
            @error('cep')
                <div class=" text-danger">* {{ $message }}</div>
            @enderror
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <label for="">Rua:</label>
            <input type="text" name="rua" id="rua" class="form-control" value="{{old('rua')}}">
            @error('rua')
                <div class=" text-danger">* {{ $message }}</div>
            @enderror
            </div>

            <div class="col-sm-1">
                <label for="">Nº:</label>
            <input type="text" name="num" id="num" class="form-control" value="{{old('num')}}">
            @error('num')
                <div class=" text-danger">* {{ $message }}</div>
            @enderror
            </div> 
            
            <div class="col-sm-2">
                <label for="">Bairro:</label>
            <input type="text" name="bairro" id="bairro" class="form-control" value="{{old('bairro')}}">
            @error('bairro')
                <div class=" text-danger">* {{ $message }}</div>
            @enderror
            </div> 
            <div class="col-sm-2">
                <label for="">Cidade:</label>
            <input type="text" name="cidade" id="cidade" class="form-control" value="{{old('cidade')}}">
            @error('cidade')
                <div class=" text-danger">* {{ $message }}</div>
            @enderror
            </div>             
            <div class="col-sm-1">
                <label for="">UF:</label>
            <input type="text" name="uf" id="uf" class="form-control" value="{{old('uf')}}">
            @error('uf')
                <div class=" text-danger">* {{ $message }}</div>
            @enderror
            </div> 
        </div>  
    </div>
</div>
    <div class="box box-primary">
        <div class="box-header">
            <i class="fa fa-credit-card"></i> Dados para pagamentos com cartão de crédito: 
        </div>
            @csrf
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-6">
                        <label for="">Nome do titular do cartão:</label>
                    <input type="text" name="nome" id="" class="form-control" value="{{old('nome')}}">
                    @error('nome')
                        <div class=" text-danger">* {{ $message }}</div>
                    @enderror
                    </div>            
                </div>        
                
            <div class="row">
                <div class="col-sm-6">
                    <label for="">Número do cartão:</label>
                    <input type="text" name="numero" id="" class="form-control" value="{{old('numero')}}">
                    @error('numero')
                        <div class=" text-danger">* {{ $message }}</div>
                    @enderror
                </div>
                <div class="col-sm-2">
                    <label for="">Código de segurança:</label>
                    <input type="text" name="cod" max="999" maxlength="3" id="" class="form-control" value="{{old('cod')}}">
                    @error('cod')
                        <div class=" text-danger">* {{ $message }}</div>
                    @enderror
                </div>                      
            </div>
            <div class="row">
                <div class="col-sm-2">
                    <label for="">Data de validade:</label>                
                </div>               
            </div>
            <div class="row">
                <div class="col-sm-1">
                    <label for="">Mês:</label>
                    <input type="text" name="mes" id="" max="99" maxlength="2" class="form-control" value="{{old('mes')}}">
                    @error('mes')
                        <div class=" text-danger">* {{ $message }}</div>
                    @enderror
                </div>
                <div class="col-sm-1">
                    <label for="">Ano:</label>
                    <input type="text" name="ano" id="" max="99" maxlength="2" class="form-control" value="{{old('ano')}}">
                    @error('ano')
                        <div class=" text-danger">* {{ $message }}</div>
                    @enderror
                </div>
            </div>                       
            <div class="box-footer">
                <div class="row text-center">                    
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-success btn-lg btn-block" data-toggle="modal" data-target="#modal-default"><i class="fa fa-credit-card"></i> Efetuar pagamento</button>
                    </div>                    
                </div>            
            </div>
            <div class="panel">
                <div class="panel-body bg-gray"> 
                    <p class="text-danger">
                        <b>
                            * As atividades podem ficar indisponíveis. <br>
                            * Caso a atividade fique indisponível, você será adicionado a lista de espera e não será cobrado por isso. <br>
                            * A assinatura dos contratos e a prova dos uniformes serão na Central de Matrículas, em frente à capela do dia 05/03 a 13/03.<br>                        

                        </b>
                    </p>
                    
                </div>    
            </div> 
        </div>
    </form>
        <div class="box">
            <div class="row" style="vertical-align: baseline;">
                <div class="col-sm-1" >                    
                    <img src="https://ncdn0.infojobs.com.br/logos/Company_Evaluation/18197.jpg" alt="" srcset=""  height="50">                                        
                </div>
                <div class="col-sm-1">
                    <img src="https://i0.wp.com/elias.praciano.com/wp-content/uploads/2016/06/le-logo-standard.png" alt="" srcset=""  height="50">
                </div>                                  
            </div>
        </div>
    </div>    
@else
    <form action="" method="post">
        @csrf
        <div class="row">
            <div class="col-sm-12">
                <button type="submit" class="btn btn-success btn-lg btn-block">Confirmar inscrição</button>
            </div>
        </div>
    </form>
@endif
    <div class="modal fade" id="modal-default" style="display: none;">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
              <h4 class="modal-title">Registrando pagamento. Aguarde...</h4>
            </div>
            <div class="modal-body text-center">
              <p></p>
            <img src="{{asset('portal/img/load.gif')}}" width="150px">
            </div>            
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
@stop
@section('js')
<script>
    $('#cep').mask('00000-000');
    $(document).ready(function() {

function limpa_formulário_cep() {
    // Limpa valores do formulário de cep.
    $("#rua").val("");
    $("#bairro").val("");
    $("#cidade").val("");
    $("#uf").val("");
    $("#ibge").val("");
}

//Quando o campo cep perde o foco.
$("#cep").blur(function() {

    //Nova variável "cep" somente com dígitos.
    var cep = $(this).val().replace(/\D/g, '');

    //Verifica se campo cep possui valor informado.
    if (cep != "") {

        //Expressão regular para validar o CEP.
        var validacep = /^[0-9]{8}$/;

        //Valida o formato do CEP.
        if(validacep.test(cep)) {

            //Preenche os campos com "..." enquanto consulta webservice.
            $("#rua").val("...");
            $("#bairro").val("...");
            $("#cidade").val("...");
            $("#uf").val("...");
            $("#num").val("");
            //$("#ibge").val("...");

            //Consulta o webservice viacep.com.br/
            $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                if (!("erro" in dados)) {
                    //Atualiza os campos com os valores da consulta.
                    $("#rua").val(dados.logradouro);
                    $("#bairro").val(dados.bairro);
                    $("#cidade").val(dados.localidade);                    
                    $("#uf").val(dados.uf);
                    //$("#ibge").val(dados.ibge);
                } //end if.
                else {
                    //CEP pesquisado não foi encontrado.
                    limpa_formulário_cep();
                    alert("CEP não encontrado.");
                }
            });
        } //end if.
        else {
            //cep é inválido.
            limpa_formulário_cep();
            alert("Formato de CEP inválido.");
        }
    } //end if.
    else {
        //cep sem valor, limpa formulário.
        limpa_formulário_cep();
    }
});
});
</script>
    
@endsection