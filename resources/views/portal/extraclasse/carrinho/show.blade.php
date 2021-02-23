@extends('adminlte::page')
@section('title', 'Atividades Extraclasse')
@section('content_header')
<div class="row">
    <div class="col-xs-6"><a href="{{ route('extraclasse.show', ['extraclasse'=>$_SESSION['ra']]) }}" class="btn btn-danger"><i class="fa fa-chevron-left"></i> Voltar</a></div>    
</div>
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
<form action="{{ route('pagamento') }}" method="post">
<input type="hidden" name="cart_id" value="{{$carrinho->id}}">
<div class="card card-danger">
    <div class="card-header">
        <i class="fa fa-map-marker"></i> Confirme se os dados do comprador estão corretos.
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-2">
                <label for="">Nome:</label>
                <input type="text" name="firstname" id="" value="{{explode(' ', $totvs->RESPFIN)[0]}}" class="form-control">
                @error('firstname')
                <div class=" text-danger">* {{ $message }}</div>
            @enderror
            </div>
            <div class="col-sm-8">
                <label for="">Sobrenome:</label>
                <input type="text" name="lastname" id="" value="@foreach(explode(' ', $totvs->RESPFIN) as $i)@if(explode(' ', $totvs->RESPFIN)[0]!= $i){{$i}} @endif @endforeach" class="form-control">
                @error('lastname')
                <div class=" text-danger">* {{ $message }}</div>
            @enderror
            </div>

        </div>
        <div class="row">
            <div class="col-sm-2">
                <label for="">CEP:</label>
            <input type="text" name="cep" id="cep" class="form-control" value="{{empty(old('cep')) ? $endereco['cep'] : old('cep')}}">
            @error('cep')
                <div class=" text-danger">* {{ $message }}</div>
            @enderror
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <label for="">Rua:</label>
            <input type="text" name="rua" id="rua" class="form-control" value="{{empty(old('rua')) ? $endereco['rua'] : old('rua')}}">
            @error('rua')
                <div class=" text-danger">* {{ $message }}</div>
            @enderror
            </div>

            <div class="col-sm-1">
                <label for="">Nº:</label>
            <input type="text" name="num" id="num" class="form-control" value="{{empty(old('num')) ? $endereco['numero'] : old('num')}}">
            @error('num')
                <div class=" text-danger">* {{ $message }}</div>
            @enderror
            </div> 
            
            <div class="col-sm-2">
                <label for="">Bairro:</label>
            <input type="text" name="bairro" id="bairro" class="form-control" value="{{empty(old('bairro')) ? $endereco['bairro'] : old('bairro')}}">
            @error('bairro')
                <div class=" text-danger">* {{ $message }}</div>
            @enderror
            </div> 
            <div class="col-sm-2">
                <label for="">Cidade:</label>
            <input type="text" name="cidade" id="cidade" class="form-control" value="{{empty(old('cidade')) ? $endereco['cidade'] : old('cidade')}}">
            @error('cidade')
                <div class=" text-danger">* {{ $message }}</div>
            @enderror
            </div> 
            <!--<div class="col-sm-2">
                <label for="">Estado:</label>
            <input type="text" name="estado" id="estado" class="form-control" value="{{empty(old('estado')) ? $endereco['estado'] : old('estado')}}">
            @error('estado')
                <div class=" text-danger">* {{ $message }}</div>
            @enderror
            </div> 
        -->
            <div class="col-sm-1">
                <label for="">UF:</label>
            <input type="text" name="uf" id="uf" class="form-control" value="{{empty(old('uf')) ? $endereco['uf'] : old('uf')}}">
            @error('uf')
                <div class=" text-danger">* {{ $message }}</div>
            @enderror
            </div> 
        </div>  
    </div>
</div>
    <div class="card card-primary">
        <div class="card-header">
            <i class="fa fa-credit-card"></i> Dados para pagamentos com cartão de crédito: 
        </div>
            @csrf
            <div class="card-body">
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
                    <input type="text" name="cod" id="" class="form-control" value="{{old('cod')}}" maxlength="4">
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
                    <input type="text" name="mes" id="" class="form-control" value="{{old('mes')}}" max="99" maxlength="2">
                    @error('mes')
                        <div class=" text-danger">* {{ $message }}</div>
                    @enderror
                </div>
                <div class="col-sm-1">
                    <label for="">Ano:</label>
                    <input type="text" name="ano" id="" class="form-control" value="{{old('ano')}}" max="99" maxlength="2">
                    @error('ano')
                        <div class=" text-danger">* {{ $message }}</div>
                    @enderror
                </div>
            </div>                                   
                      
            
            <div class="row mt-3">
                <div class="col-md-12"> 
                    <div class="alert alert-warning">                        
                        <h5><i class="icon fas fa-exclamation-triangle"></i> Informação!</h5>
                        <b>
                            * As atividades podem ficar indisponíveis. <br>
                            * Caso a atividade fique indisponível, você será adicionado a lista de espera e não será cobrado por isso. <br>
                            <!--* A assinatura dos contratos e a prova dos uniformes serão na Central de Matrículas, em frente à capela do dia 05/03 a 13/03.<br>                        -->

                        </b>
                    </div>
                    @php($count = 0)                    
                    <div class="callout callout-success" >
                        <ul>
                        @forelse ($carrinho->ItensCarrinho()->get() as $i)
                            @if ($i->ExtAtvTurma->ExtAtvVagas($i->ExtAtvTurma->id)<=0 || !empty(App\Model\AtividadesExtraclasse\ExtAtvListaDeEspera::where('ext_atv_turmas_id',$i->ExtAtvTurma->id)->where('ano', date('Y'))->first()))
                                <li>{{$i->ExtAtvTurma->ExtAtv->atividade}} - Lista de espera </li>
                                @else
                                <li>{{$i->ExtAtvTurma->ExtAtv->atividade}} - {{str_replace('.',',',number_format(floatval(str_replace(',','.',$i->ExtAtvTurma->valor)), 2, '.', ''))}}       <br></li>
                                @php($count += floatval(str_replace(',','.',$i->ExtAtvTurma->valor)))
                                @endif         
                                @empty
                                Carrinho vazio
                                @endforelse 
                        </ul>                        
                    </div>
                    <h3 class="text-success">Total a pagar: {{str_replace('.',',',number_format($count, 2, '.', ''))}}</h3>
                </div>    
            </div> 

            <div class="row text-center mt-3 mb-3">                    
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-success btn-lg btn-block" data-toggle="modal" data-target="#modal-default"><i class="fa fa-credit-card"></i> Efetuar pagamento</button>
                </div>                    
            </div>  
        </div>
    </form>
        <div class="card">
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