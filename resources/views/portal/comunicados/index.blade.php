@extends('adminlte::page')

@section('title', 'Comunicados')


@section('content')
<div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Comunicados - La Salle Abel</h3>

          <div class="box-tools">
                <div class="input-group input-group-sm hidden-xs" style="width: 180px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Procurar">
                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>                
              </div>              
                
            
          </div>          
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          
          @forelse ($comunicado as $i)
          <div class="">
            <div class="row">
              <div class="col-sm-1">
                  <div class="box box-warning box-solid">
                      <div class="box-header with-border text-center">
                        <h3 class="box-title">{{date("d", strtotime($i->created_at))}}</h3>                                  
                        <!-- /.box-tools -->
                      </div>
                      <!-- /.box-header -->                      
                      <div class="box-body text-center" style="">
                          {{date("M", strtotime($i->created_at))}}
                          {{date("Y", strtotime($i->created_at))}}                          
                      </div>
                      <!-- /.box-body -->
                    </div>
              </div>  
              <a href="{{ route('communicated.show', ['id'=>$i->id]) }}" class="" style="color: #333">
                <div class="col-sm-11 comunicado">
                  <div class="row">
                    <div class="col-sm-12">
                      <h1>{{$i->titulo}}</h1>
                    </div>
                    <div class="row">
                      <div class="col-sm-12">
                          <div class="col-sm-8">
                              {!!mb_strimwidth($i->descricao, 0, 60,"...")!!}            
                          </div>
                      </div>
                    </div>
                  </div>
                </div>

              </a>            
              
            </div>
          </div>
            @empty
            Nenhum comunicado para exibir    
            @endforelse
                
          </tbody></table>
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