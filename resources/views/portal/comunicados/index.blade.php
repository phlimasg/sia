@extends('adminlte::page')

@section('title', 'Comunicados')


@section('content')
@php
  setlocale(LC_TIME, 'pt-BR', 'pt-BR.utf-8', 'pt-BR.utf-8', 'portuguese');
  date_default_timezone_set('America/Sao_Paulo');
@endphp
<div class="row">
    <div class="col-md-10" style="margin: 0 auto">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Comunicados - La Salle Abel</h3>          
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          
          @forelse ($comunicado as $i)
          
            <div class="row">
              <div class="col-md-1 mb-left">
                  <div class="card card-warning card-solid">
                      <div class="card-header with-border text-center">
                        <h3 class="card-title">{{date("d", strtotime($i->created_at))}}</h3>
                      </div>
                      <div class="card-body text-center">
                          {{strftime("%B", strtotime($i->created_at))}}
                          {{date("Y", strtotime($i->created_at))}}                          
                      </div>                      
                  </div>
              </div> 
              <a href="#" style="color: #333" data-toggle="modal" data-target="#{{$i->id}}">

                <div class="col-md-10 comunicado">
                  
                    <div class="row">
                      <div class="col-sm-11">
                        <h1 class="mb-h1">{{$i->titulo}}</h1>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-11 text-justify previa">                          
                        {!!mb_substr(strip_tags($i->descricao), 0, 350,'UTF-8')!!}...
                      </div>                      
                    </div>
                  
                </div>
              </a>    
              <div id="{{$i->id}}" class="modal fade" role="dialog">
                  <div class="modal-dialog modal-xl">
                
                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">{{$i->titulo}}</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                      </div>
                      <div class="modal-body">
                        {!!$i->descricao!!}
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                      </div>
                    </div>
                
                  </div>
                </div>        
              
            </div>  
            <hr>        
            @empty
            Nenhum comunicado para exibir    
            @endforelse
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
            {{ $comunicado->links() }}
          </div>
      </div>
      <!-- /.card -->
    </div>
  </div>
    
@stop

@section('js')

    
@endsection