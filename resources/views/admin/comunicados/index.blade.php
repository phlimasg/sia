@extends('adminlte::page')

@section('title', 'Comunicados')

@section('content_header')
    <h1>Comunicados</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Comunicados cadastrados</h3>

          <div class="card-tools">
                <div class="input-group input-group-sm hidden-xs" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Procurar">
                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>                
                    <a href="{{ route('comunicados.create') }}" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></a>              
                  </div>                
              </div>              
                
            
          </div>          
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-hover" id="tabela">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Título</th>
                  <th>Descrição</th>
                  <th>Ação</th>              
                </tr>
              </thead>
              <tbody>
              @forelse ($comunicado as $i)
                <tr>
                  <td>{{$i->id}}</td>
                  <td>{{$i->titulo}}</td>
                  <td>{{mb_strimwidth(strip_tags($i->descricao), 0, 280,"...")}} </td>
                  <td style="width: 150px">
                          <div class="btn-group">
                              <a href="{{ route('comunicados.show', ['comunicado'=>$i->id]) }}" class="btn btn-primary"> <span class="fa fa-eye"></span> Ver</a>
                              <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                  <span class="caret"></span>
                              </button>
                              <ul class="dropdown-menu" role="menu">
                                  <li><a href="{{ route('comunicados.edit', ['comunicado'=>$i->id]) }}"><span class="fa fa-edit"></span> Editar</a></li>
                                  <li>
                                    <a href="#" data-toggle="modal" data-target="#modal{{$i->id}}"><span class="fa fa-remove"></span>Excluir</a></li>
                              </ul>
                          </div>
                  </td>                
                </tr>
                <!-- Modal -->
              <div class="modal fade" id="modal{{$i->id}}" role="dialog">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Apagar comunicado?</h4>
                    </div>
                    <div class="modal-body">
                    <p>Confirma a exclusão do comunicado <b>{{$i->titulo}}</b>?</p>
                    <span class="text-danger">* A ação não poderá ser desfeita!</span>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                      <form action="{{ route('comunicados.destroy', ['comunicado'=>$i->id]) }}" method="POST">
                        @csrf
                        @method("DELETE")
                        <button type="submit" class="btn btn-danger">Confirmar</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              @empty
              Nenhum comunicado para exibir    
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
 <script>
   $(document).ready( function () {    
    $('#tabela').DataTable({
      //paging: false,
      //searching: false,
    });
    //$('#tabela').hide();
} );
 </script>
@endsection