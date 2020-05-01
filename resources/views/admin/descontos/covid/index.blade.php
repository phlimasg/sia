@extends('adminlte::page')

@section('title', 'Desconto - COVID')

@section('content_header')
    <h1>Solicitação de desconto | COVID-19</h1>
@stop

@section('content')
<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">Desconto Solicitados</h3>
        <div class="box-tools">
          <div class="row" >
            <form action="{{ route('covid.search') }}" method="post">
              @csrf
              <div class=" col-sm-offset-8 col-sm-2">
                <div class="input-group-sm">
                  <select name="status" id="" class="form-control">
                    <option value=""></option>
                    <option value="Em Análise">Em Análise</option>
                    <option value="Indeferido">Indeferido</option>
                      <option value="Deferido">Deferido</option>                  
                    <option value="Falta Documento">Falta Documento</option>
                    <option value="Supervisão Administrativa">Supervisão Administrativa</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-2">
                <div class="input-group input-group-sm" >
                  <input type="text" name="busca" class="form-control " placeholder="Procurar">
          
                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>

            </form>

            </div>
          </div>
    </div>    
    <div class="box-body">
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
              <tbody>              
            
        @forelse ($isencao as $i)
        <tr>
                <td>{{$i->id}}</td>
                <td>{{$i->totvs->RESPFIN}}</td>
                <td>{{date('d/m/Y H:i', strtotime($i->created_at))}}</td>
                <td>
                    <span class="label 
                    @if ($i->status== 'Em Análise')
                    label-primary                    
                    @elseif($i->status== 'Indeferido')
                    label-danger
                    @elseif($i->status== 'Deferido')
                    label-success
                    @elseif($i->status== 'Falta Documento')
                    label-warning
                    @elseif($i->status== 'Supervisão Administrativa')
                    label-primary
                    @endif">{{$i->status}}</span>
                </td>
                <td>{{$i->motivo->motivo}}</td>
                <td><a href="{{ route('covid.show', ['id'=>$i->id]) }}" class="btn btn-sm btn-primary"> <i class="fa fa-eye"></i> Analizar</a></td>
            
        </tr>
            
        @empty
            
        @endforelse
    </tbody></table>
</div>
    </div>
    <div class="box-footer">
        {{ $isencao->links() }}
    </div>
</div>
    
@stop

@section('js')

    
@endsection