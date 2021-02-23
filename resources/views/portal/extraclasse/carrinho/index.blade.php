@extends('adminlte::page')
@section('title', 'Atividades Extraclasse')
@section('content_header')
<div class="row">
    <div class="col-md-6"><a href="{{ route('extraclasse.show', ['extraclasse'=>$_SESSION['ra']]) }}"
            class="btn btn-primary"><i class="fa fa-chevron-left"></i> Voltar</a></div>
</div>
@endsection
@section('content')
<div class="card card-outline card-primary">
    <!-- /.card-header -->
    <div class="card-header">
        <h3 class="card-title">Resumo das atividades escolhidas para {{ucwords($_SESSION['name'])}}.</h3>
    </div>
    <div class="card-body table-responsive no-padding">
        <table class="table table-hover">
            <tbody>
                @php($total = 0)
                @forelse ($orcamento->ItensCarrinho()->get() as $i)
                <tr>
                    <td>
                        <div class="row">
                            <div class="col-sm-3">
                                <img src="{{$i->ExtAtvTurma->ExtAtv->imagem_mini}}" alt="" srcset="" class="img-fluid">
                            </div>
                            <div class="col-sm-6">
                                <h3>{{$i->ExtAtvTurma->ExtAtv->atividade}}</h3>
                                <div class="lj-small"><small>Turma: {{$i->ExtAtvTurma->descricao_turma}}</small></div>
                                <div class="lj-small"><small>Aulas: {{substr($i->ExtAtvTurma->dia, 0, -2)}}</small>
                                </div>
                                <div class="lj-small"><small>Das {{substr($i->ExtAtvTurma->hora_ini, 0, -3)}} às
                                        {{substr($i->ExtAtvTurma->hora_fim, 0, -3)}}</small></div>
                                @if ($i->ExtAtvTurma->ExtAtvVagas($i->ExtAtvTurma->id) <= 0 ||
                                    !empty(App\Model\AtividadesExtraclasse\ExtAtvListaDeEspera::where('ext_atv_turmas_id',$i->
                                    ExtAtvTurma->id)->where('ano', date('Y'))->first()))
                                    <div><span class="text-danger">
                                            <h3>*Lista de espera</h3>
                                        </span></div>
                                    @else
                                    <div><span class="details-preco">R$ {{$i->ExtAtvTurma->valor}}</span></div>
                                    @php($total += floatval(str_replace(',','.',$i->ExtAtvTurma->valor)))
                                    @endif

                            </div>

                        </div>
                    </td>
                    <td></td>
                    <td>
                        <form action="{{ route('cart.destroy',['cart'=>$i->id]) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                        </form>
                    </td>
                </tr>

                @empty
                <div class="text-center">
                    <h1><i class="fa fa-shopping-cart"></i></h1>
                    <h3>Carrinho vazio.</h3>
                </div>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer clearfix">
        <div class="row">
            <div class="col-sm-3 offset-9 text-right">
                <span class="details-preco"><small>Total</small> R$:
                    {{str_replace('.',',',number_format($total, 2, '.', ''))}}</span>
                    <!-- REMOVER 
                php($total2 = $total)
                php($total = 0)
                <!-- FIM REMOVER -->
                    @if ($total ==0)
                    <form action="{{ route('inscricao', ['cart_id'=>$orcamento->id]) }}" method="POST">
                        @csrf
                        <button class="btn btn-primary btn-block btn-lg" type="submit"><i class="fa fa-credit-card"></i>
                            Efetuar Inscrição</button>
                    </form>
        
                    @else
        
                    <a href="{{ route('cart.show', ['cart'=>$orcamento->id]) }}" class="btn btn-success btn-block btn-lg"><i
                            class="fa fa-credit-card"></i> Efetuar Pagamento</a>
                    @endif
            </div>                
        </div>
        
        
    </div>
    <!-- /.card-body -->
</div>

@stop
@section('js')
<script>
    function check() {
        if (document.getElementById("accept").checked == true) {
            document.getElementById("insc").disabled = false;
        } else {
            document.getElementById("insc").disabled = true;
        }
    }

</script>
@endsection
