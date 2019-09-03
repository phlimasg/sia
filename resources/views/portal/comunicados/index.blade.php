@extends('adminlte::page')

@section('title', 'Comunicados')


@section('content')
@php
  setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
  date_default_timezone_set('America/Sao_Paulo');
@endphp
<div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Comunicados - La Salle Abel</h3>

          <!--<div class="box-tools">
          <div class="input-group input-group-sm hidden-xs" style="width: 180px;">
              <input type="text" name="table_search" class="form-control pull-right" placeholder="Procurar">
                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>                
                </div>              
                
                
              </div>          
            -->
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          
          @forelse ($comunicado as $i)
          
            <div class="row">
              <div class="col-sm-1 mb-left">
                  <div class="box box-warning box-solid">
                      <div class="box-header with-border text-center">
                        <h3 class="box-title">{{date("d", strtotime($i->created_at))}}</h3>
                      </div>
                      <div class="box-body text-center">
                          {{strftime("%B", strtotime($i->created_at))}}
                          {{date("Y", strtotime($i->created_at))}}                          
                      </div>                      
                  </div>
              </div> 

              <a href="" style="color: #333" data-toggle="modal" data-target="#{{$i->id}}">
                <div class="col-sm-10 comunicado">
                  <div class="row">
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
                </div>
              </a>    
              <div id="{{$i->id}}" class="modal fade" role="dialog">
                  <div class="modal-dialog modal-lg">
                
                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">{{$i->titulo}}</h4>
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
        <!-- /.box-body -->
        <div class="box-footer clearfix">
            {{ $comunicado->links() }}
          </div>
      </div>
      <!-- /.box -->
    </div>
  </div>
    
@stop

@section('js')

    
@endsection