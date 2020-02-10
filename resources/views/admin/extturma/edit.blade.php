@extends('adminlte::page')

@section('title', 'Extraclasse')

@section('content_header')
    <h1>Adicionar Atividade Extraclasse</h1>
@stop

@section('content')
<div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">Adicione uma nova atividade</h3>

          <div class="box-tools">
              
          </div>          
        </div>
        <!-- /.box-header -->
        <div class="box-body  ">   
            <form action="{{route('turma.update',['id'=>Request::segment(3), 'turma'=> $atv->id])}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
            <input type="hidden" name="id" value="{{Request::segment(3)}}">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="descricao_turma">Descrição da Turma:</label>
                        <input name="descricao_turma" autofocus class="form-control" @if(old('descricao_turma')) value="{{old('descricao_turma')}}" @else value="{{$atv->descricao_turma}}" @endif placeholder="Ex: Turma A, Grupo A, Fraldinha I..." >
                            @if ($errors->has('descricao_turma'))
                                <div class="alert alert-danger">
                                    {{$errors->first('descricao_turma')}}
                                </div>
                            @endif                
                        </div>
                    </div>                    
                    <div class="col-sm-2">
                        <label for="">Horário de inicio</label>
                        <input type="time" class="form-control" name="hora_ini" placeholder="Ex: 17:40" @if(old('hora_ini')) value="{{old('hora_ini')}}" @else value="{{$atv->hora_ini}}" @endif  data-mask="00:00">
                        @if ($errors->has('hora_ini'))
                            <div class="alert alert-danger">
                                {{$errors->first('hora_ini')}}
                            </div>
                        @endif
                    </div>
                    <div class="col-sm-2">
                        <label for="">Horário final</label>
                        <input type="text" class="form-control" name="hora_fim" placeholder="Ex: 18:40" @if(old('hora_fim')) value="{{old('hora_fim')}}" @else value="{{$atv->hora_fim}}" @endif  data-mask="00:00">
                        @if ($errors->has('hora_fim'))
                            <div class="alert alert-danger">
                                {{$errors->first('hora_fim')}}
                            </div>
                        @endif
                    </div>
                    <div class="col-sm-2">
                        <label for="">Qtd. de Vagas</label>
                        <input type="number" class="form-control" name="vagas" placeholder="Ex: 20" min="1" @if(old('vagas')) value="{{old('vagas')}}" @else value="{{$atv->vagas}}" @endif >
                        @if ($errors->has('vagas'))
                            <div class="alert alert-danger">
                                {{$errors->first('vagas')}}
                            </div>
                        @endif
                    </div>
                    <div class="col-sm-2">
                            <label for="">Valor</label>
                            <input type="text" class="form-control" name="valor" placeholder="Ex: 130,00" @if(old('valor')) value="{{old('valor')}}" @else value="{{$atv->valor}}" @endif data-mask="#.##0,00" data-mask-reverse="true">
                            @if ($errors->has('valor'))
                                <div class="alert alert-danger">
                                    {{$errors->first('valor')}}
                                </div>
                            @endif
                        </div>
                </div>                
                <h4 for="">Período de Inscrição:</h4>
                <div class="row">
                        <div class="col-sm-3">
                                <label for="">Data/Hora da Liberação</label>
                                <input type="text" class="form-control" name="dia_libera" placeholder="Data e Hora" @if(old('dia_libera')) value="{{old('dia_libera')}}" @else value="{{date('d/m/Y H:i', strtotime($atv->dia_libera))}}" @endif data-mask="00/00/0000 00:00">
                                @if ($errors->has('dia_libera'))
                                    <div class="alert alert-danger">
                                        {{$errors->first('dia_libera')}}
                                    </div>
                                @endif
                            </div>
                            <div class="col-sm-3">
                                    <label for="">Data/Hora do bloqueio</label>
                                    <input type="text" class="form-control" name="dia_bloqueia" placeholder="Data e Hora" @if(old('dia_bloqueia')) value="{{old('dia_bloqueia')}}" @else value="{{date('d-m-Y H:i', strtotime($atv->dia_bloqueia))}}" @endif data-mask="00/00/0000 00:00">
                                    @if ($errors->has('dia_bloqueia'))
                                        <div class="alert alert-danger">
                                            {{$errors->first('dia_bloqueia')}}
                                        </div>
                                    @endif
                                </div>
                </div>
                <hr>
                <h4>Dias das Atividades</h4>
                <div class="row">
                    <div class="col-sm-2">
                        <label class="checkbox-inline">
                            <input type="checkbox" name="dias[]" value="Segunda-feira" @if(preg_match('/'.'Segunda-feira'.'/',$atv->dia)) checked @endif >Segunda-feira
                        </label>
                    </div>    
                    <div class="col-sm-2">
                            <label class="checkbox-inline">
                                <input type="checkbox" name="dias[]" value="Terça-feira" @if(preg_match('/'.'Terça-feira'.'/',$atv->dia)) checked @endif >Terça-feira
                            </label>
                        </div>
                        <div class="col-sm-2">
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="dias[]" value="Quarta-feira" @if(preg_match('/'.'Quarta-feira'.'/',$atv->dia)) checked @endif >Quarta-feira
                                </label>
                        </div>
                        <div class="col-sm-2">
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="dias[]" value="Quinta-feira" @if(preg_match('/'.'Quinta-feira'.'/',$atv->dia)) checked @endif >Quinta-feira
                                </label>
                        </div>
                        <div class="col-sm-2">
                            <label class="checkbox-inline">
                                <input type="checkbox" name="dias[]" value="Sexta-feira" @if(preg_match('/'.'Sexta-feira'.'/',$atv->dia)) checked @endif >Sexta-feira
                            </label>
                        </div>
                        <div class="col-sm-2">
                            <label class="checkbox-inline">
                                <input type="checkbox" name="dias[]" value="Sábado" @if(preg_match('/'.'Sábado'.'/',$atv->dia)) checked @endif >Sábado
                            </label>
                        </div>
                        @if ($errors->has('dias'))
                            <div class="alert alert-danger">
                                {{$errors->first('dias')}}
                            </div>
                        @endif
                </div>    
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <label for="">Disponibilizar para as turmas:</label>
                    </div>        
                    <div class="col-sm-1">
                        <button type="button" class="btn btn-danger" onclick="checkTurma('ei')">Ed. Infantil</button>
                    </div>
                    <div class="col-sm-1">
                        <button type="button" class="btn btn-warning" onclick="checkTurma('ef')">Ens. Fund. I</button>
                    </div>
                    <div class="col-sm-1">
                        <button type="button" class="btn btn-primary" onclick="checkTurma('ef2')">En. Fund. II</button>
                    </div>
                    <div class="col-sm-1">
                        <button type="button" class="btn btn-default" onclick="checkTurma('em')">En. Médio</button>
                    </div>
                    <div class="col-sm-1">
                            <button type="button" class="btn btn-success" onclick="checkTurma('x')">Limpar</button>
                        </div>
                </div>
                @if ($errors->has('turma'))
                <div class="alert alert-danger">
                    {{$errors->first('turma')}}
                </div>
            @endif
                    @php
                        $ano = null;
                    @endphp
                    @forelse ($turma as $i)
                        @if ($i->ANO != $ano)
                            @if ( $ano != null && $i->ANO != $ano)
                                </div>  
                            @endif
                        <div class="row">
                            <div class="col-sm-3">
                                <label for="">{{$i->ANO}} - {{$i->TURMA}}</label><br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-1">
                                <label class="checkbox-inline">
                                    <input type="checkbox" value="{{$i->TURMA}}" id="{{$i->TURMA}}" name="turma[]" 
                                    @foreach ($atv->turmasAut as $j)
                                        @if($j->turma == $i->TURMA)
                                        checked
                                        @endif
                                    @endforeach >
                                    {{$i->TURMA}}
                                </label>
                            </div>                
                        @else
                        <div class="col-sm-1">
                            <label class="checkbox-inline">
                                <input type="checkbox" value="{{$i->TURMA}}" id="{{$i->TURMA}}" name="turma[]"
                                @foreach ($atv->turmasAut as $j)
                                        @if($j->turma == $i->TURMA)
                                        checked
                                        @endif
                                    @endforeach
                                     >
                                {{$i->TURMA}}
                            </label>
                        </div> 
                        @endif
                        @php
                            $ano=$i->ANO;     
                        @endphp
                    @empty
                        Nenhuma turma disponível
                    @endforelse
                </div> 
                
                <br>
                <div class="row">
                    <div class="col-sm-6">            
                        <button type="submit" class="btn btn-primary">
                            <span class="glyphicon glyphicon-floppy-disk"></span> Adicionar
                        </button>        
                    </div>
                </div>
            </form>
        
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
            
        </div>
      </div>
      <!-- /.box -->
    </div>
  </div>
    
@stop

@section('js')
<script> 
    function checkTurma(turma) {
        var ei = [
            @foreach ($turma as $i)
                @if (strstr($i->TURMA,'EIER'))
                '{{$i->TURMA}}',
                @endif
            @endforeach
        ];
        var ef = [
            @foreach ($turma as $i)
                @if (strstr($i->TURMA,'EFER01') or strstr($i->TURMA,'EFER02') or strstr($i->TURMA,'EFER03') or strstr($i->TURMA,'EFER04') or strstr($i->TURMA,'EFER05'))
                '{{$i->TURMA}}',
                @endif
            @endforeach
        ];
        var ef2 = [
            @foreach ($turma as $i)
                @if (strstr($i->TURMA,'EFER06') or strstr($i->TURMA,'EFER07') or strstr($i->TURMA,'EFER08') or strstr($i->TURMA,'EFER09'))
                '{{$i->TURMA}}',
                @endif
            @endforeach
        ];
        var em = [
            @foreach ($turma as $i)
                @if (strstr($i->TURMA,'EMER'))
                '{{$i->TURMA}}',
                @endif
            @endforeach
        ];
        
        if(turma == 'ei'){
            for (let index = 0; index < ei.length; index++) {
                document.getElementById(ei[index]).checked = true;            
            }       
        }
        if(turma == 'ef'){
            for (let index = 0; index < ef.length; index++) {
                document.getElementById(ef[index]).checked = true;            
            }       
        }
        if(turma == 'ef2'){
            for (let index = 0; index < ef2.length; index++) {
                document.getElementById(ef2[index]).checked = true;            
            }       
        }
        if(turma == 'em'){
            for (let index = 0; index < em.length; index++) {
                document.getElementById(em[index]).checked = true;            
            }       
        }
        if(turma == 'x'){
            for (let index = 0; index < ei.length; index++) {
                document.getElementById(ei[index]).checked = false;            
            }       
            for (let index = 0; index < ef.length; index++) {
                document.getElementById(ef[index]).checked = false;            
            } 
            for (let index = 0; index < ef2.length; index++) {
                document.getElementById(ef2[index]).checked = false;            
            } 
            for (let index = 0; index < em.length; index++) {
                document.getElementById(em[index]).checked = false;            
            } 
        }
    }
</script>   
@endsection
@section('js')

@endsection