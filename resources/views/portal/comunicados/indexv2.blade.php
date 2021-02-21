@extends('adminlte::page')

@section('title', 'Comunicados')


@section('content')
@php
  setlocale(LC_TIME, 'pt-BR', 'pt-BR.utf-8', 'pt-BR.utf-8', 'portuguese');
  date_default_timezone_set('America/Sao_Paulo');
@endphp

          
          @forelse ($comunicado as $i)
          <div class="row">
    <div class="col-md-6" style="margin: 0 auto">
      <div class="card">
        <!-- /.card-header -->
        <div class="card-header">
          <h3 class="card-title">
            {{$i->titulo}}
          </h3>
          <div class="card-tools"> <small class="text-gray"><i class="fas fa-clock"></i> {{date("d/m/Y H:i", strtotime($i->created_at))}}</small>   </div>
        </div>
        <div class="card-body">
            <div class="row">
              <!--<div class="col-md-1 mb-left">
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
            -->
              <!--<a href="#" style="color: #333" data-toggle="modal" data-target="#{{$i->id}}">-->

                <div class="col-md-12 ">                  
                    
                    <div class="row">
                      <div class="col-md-12 text-justify ">                          
                        {!!$i->descricao!!}
                      </div>                      
                    </div>
                  
                </div>
              <!--</a> -->   
              <!--<div id="{{$i->id}}" class="modal fade" role="dialog">

                  <div class="modal-dialog modal-xl">
                
                    <!-- Modal content
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
                </div> -->       
              
            </div> 
          </div>
        <!-- /.card-body -->
        <!--
          <div class="card-footer clearfix">
          <div class="row">
            <div class="col-md-4"><a href="#" class="link-black text-center btn btn-sm btn-gray btn-block"><i class="far fa-thumbs-up mr-1"></i> Gostei</a></div>
            <div class="col-md-4"><a href="#" class="link-black text-center btn btn-sm btn-gray btn-block"><i class="far fa-thumbs-down mr-1"></i> Não Gostei</a></div>
            <div class="col-md-4"><a href="#" class="link-black text-center btn btn-sm btn-gray btn-block"><i class="far fa-comments mr-1"></i> Comentar</a></div>            
          </div>
        </div>
      -->
      </div>
      <!-- /.card -->
    </div>
  </div> 
                
            @empty
            Nenhum comunicado para exibir    
            @endforelse
    <div class="card-footer clearfix">
            {{ $comunicado->links() }}
          </div>    
    
@stop

@section('js')

    
@endsection