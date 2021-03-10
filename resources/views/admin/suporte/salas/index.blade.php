@extends('adminlte::page')

@section('title', 'Suporte')

@section('content_header')
    <h1>Filiais</h1>
@stop

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Filiais cadastradas</h3>
        <div class="card-tools">              
          <a href="{{ route('salas.create', ['filial' => $filial->id]) }}" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Adicionar Sala</a>
        </div>              
      </div> 
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover" id="tabela">
            <thead>
              <tr>                
                <th>Código</th>            
                <th>Filial</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
            @forelse ($salas as $i)
              <tr>                
                <td>{{($i->codigo)}}</td>
                <td>{{$i->nome}}</td>  
                <td><a href="{{ route('filial.update',['filial' => $i->id]) }}" class="btn btn-primary"><i class="fa fa-eye"></i> Ver</a></td>              
              </tr>
            @empty
            Nenhuma filial cadastrada  
            @endforelse
                
          </tbody>
        </table>

        </div>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
</div>
    
@stop

@section('js')

<script src="{{ asset('/js/jquery.mask.min.js') }}"></script>   
@endsection