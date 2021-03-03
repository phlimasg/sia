@extends('adminlte::page')

@section('title', 'Extraclasse')



@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Adicione uma nova turma</h3>

                <div class="card-tools">

                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body  ">
                <form action="{{route('turma.store',['id'=>Request::segment(3)])}}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{Request::segment(3)}}">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="descricao_turma">Descrição da Turma:</label>
                                <input name="descricao_turma" autofocus class="form-control"
                                    value="{{old('descricao_turma')}}"
                                    placeholder="Ex: Turma A, Grupo A, Fraldinha I...">
                                @if ($errors->has('descricao_turma'))
                                <div class="alert alert-danger">
                                    {{$errors->first('descricao_turma')}}
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <label for="">Horário de inicio</label>
                            <input type="time" class="form-control" name="hora_ini" placeholder="Ex: 17:40"
                                value="{{old('hora_ini')}}" data-mask="00:00">
                            @if ($errors->has('hora_ini'))
                            <div class="alert alert-danger">
                                {{$errors->first('hora_ini')}}
                            </div>
                            @endif
                        </div>
                        <div class="col-sm-2">
                            <label for="">Horário final</label>
                            <input type="time" class="form-control" name="hora_fim" placeholder="Ex: 18:40"
                                value="{{old('hora_fim')}}" data-mask="00:00">
                            @if ($errors->has('hora_fim'))
                            <div class="alert alert-danger">
                                {{$errors->first('hora_fim')}}
                            </div>
                            @endif
                        </div>
                        <div class="col-sm-2">
                            <label for="">Qtd. de Vagas</label>
                            <input type="number" class="form-control" name="vagas" placeholder="Ex: 20" min="1"
                                value="{{old('vagas')}}">
                            @if ($errors->has('vagas'))
                            <div class="alert alert-danger">
                                {{$errors->first('vagas')}}
                            </div>
                            @endif
                        </div>
                        <div class="col-sm-2">
                            <label for="">Valor</label>
                            <input type="text" class="form-control" name="valor" placeholder="Ex: 130,00"
                                value="{{old('valor')}}" data-mask="#.##0,00" data-mask-reverse="true">
                            @if ($errors->has('valor'))
                            <div class="alert alert-danger">
                                {{$errors->first('valor')}}
                            </div>
                            @endif
                        </div>
                    </div>
                    <h5 for="">Período de Inscrição:</h5>
                    <div class="row">
                        <div class="col-sm-3">
                            <label for="">Data/Hora da Liberação</label>
                            <input type="text" class="form-control" name="dia_libera" placeholder="Data e Hora"
                                value="{{old('dia_libera')}}" data-mask="00/00/0000 00:00">
                            @if ($errors->has('dia_libera'))
                            <div class="alert alert-danger">
                                {{$errors->first('dia_libera')}}
                            </div>
                            @endif
                        </div>
                        <div class="col-sm-3">
                            <label for="">Data/Hora do bloqueio</label>
                            <input type="text" class="form-control" name="dia_bloqueia" placeholder="Data e Hora"
                                value="{{old('dia_bloqueia')}}" data-mask="00/00/0000 00:00">
                            @if ($errors->has('dia_bloqueia'))
                            <div class="alert alert-danger">
                                {{$errors->first('dia_bloqueia')}}
                            </div>
                            @endif
                        </div>
                    </div>
                    <hr>
                    <h5>Dias das Atividades</h5>
                    <div class="row">
                        <div class="col-sm-2">
                            <label class="checkbox-inline">
                                <input type="checkbox" name="dias[]" value="Segunda-feira"> Segunda-feira
                            </label>
                        </div>
                        <div class="col-sm-2">
                            <label class="checkbox-inline">
                                <input type="checkbox" name="dias[]" value="Terça-feira"> Terça-feira
                            </label>
                        </div>
                        <div class="col-sm-2">
                            <label class="checkbox-inline">
                                <input type="checkbox" name="dias[]" value="Quarta-feira"> Quarta-feira
                            </label>
                        </div>
                        <div class="col-sm-2">
                            <label class="checkbox-inline">
                                <input type="checkbox" name="dias[]" value="Quinta-feira"> Quinta-feira
                            </label>
                        </div>
                        <div class="col-sm-2">
                            <label class="checkbox-inline">
                                <input type="checkbox" name="dias[]" value="Sexta-feira"> Sexta-feira
                            </label>
                        </div>
                        <div class="col-sm-2">
                            <label class="checkbox-inline">
                                <input type="checkbox" name="dias[]" value="Sábado"> Sábado
                            </label>
                        </div>
                        @if ($errors->has('dias'))
                        <div class="alert alert-danger">
                            {{$errors->first('dias')}}
                        </div>
                        @endif
                    </div>
                    <hr>
                    <h5>Envio de documentos:</h5>
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="">Documentos para a inscrição:</label>
                            <select class="form-control" name="docs[]" id="docs" multiple="multiple">
                                <option value="identidade">Identidade</option>
                                <option value="CPF">CPF</option>
                                <option value="Certidão de nascimento">Certidão de nascimento</option>
                                <option value="Comprovante de escolaridade">Comprovante de escolaridade</option>
                                <option value="Declaração de batismo">Declaração de batismo</option>                                
                                <option value="Certidão de nascimento ou Identidade">Certidão de nascimento ou identidade</option>
                              </select>
                        </div>
                        <div class="col-sm-2">
                            <label for="">Obrigatótio:</label>
                            <select name="doc_obrigatorio" id="doc_obrigatorio" class="form-control">
                                <option value="s">Sim</option>
                                <option value="n">Não</option>
                            </select>
                        </div>                        
                    </div>
                    <div id="docsadd" style="margin-top: 15px; margin-bottom: 15px">
                        
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-primary" onclick="addDocumentos()"><i class="fa fa-plus"></i> Adicionar</button>
                        </div>
                    </div>
                    <hr>
                    <h5 for="">Disponibilizar para as turmas:</h5>
                    <div class="row">

                        <div class="col-sm-2">
                            <button type="button" class="btn btn-danger" onclick="checkTurma('ei')">Ed.
                                Infantil</button>
                        </div>
                        <div class="col-sm-2">
                            <button type="button" class="btn btn-warning" onclick="checkTurma('ef')">Ens. Fund.
                                I</button>
                        </div>
                        <div class="col-sm-2">
                            <button type="button" class="btn btn-primary" onclick="checkTurma('ef2')">En. Fund.
                                II</button>
                        </div>
                        <div class="col-sm-2">
                            <button type="button" class="btn btn-default" onclick="checkTurma('em')">En. Médio</button>
                        </div>
                        <div class="col-sm-2">
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
                <div class="col-sm-2">
                    <label class="checkbox-inline">
                        <input type="checkbox" value="{{$i->TURMA}}" id="{{$i->TURMA}}" name="turma[]">
                        {{$i->TURMA}}
                    </label>
                </div>
                @else
                <div class="col-sm-2">
                    <label class="checkbox-inline">
                        <input type="checkbox" value="{{$i->TURMA}}" id="{{$i->TURMA}}" name="turma[]">
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
        <!-- /.card-body -->
        <div class="card-footer clearfix">

        </div>
    </div>
    <!-- /.card -->
</div>
</div>

@stop

@section('js')
<script>
    function checkTurma(turma) {
        var ei = [
            @foreach($turma as $i)
            @if(strstr($i->TURMA, 'EIER'))
            '{{$i->TURMA}}',
            @endif
            @endforeach
        ];
        var ef = [
            @foreach($turma as $i)
            @if(strstr($i->TURMA, 'EFER01') or strstr($i->TURMA, 'EFER02') or strstr($i->TURMA,
                'EFER03') or strstr($i->TURMA, 'EFER04') or strstr($i->TURMA, 'EFER05'))
            '{{$i->TURMA}}',
            @endif
            @endforeach
        ];
        var ef2 = [
            @foreach($turma as $i)
            @if(strstr($i->TURMA, 'EFER06') or strstr($i->TURMA, 'EFER07') or strstr($i->TURMA,
                'EFER08') or strstr($i->TURMA, 'EFER09'))
            '{{$i->TURMA}}',
            @endif
            @endforeach
        ];
        var em = [
            @foreach($turma as $i)
            @if(strstr($i->TURMA, 'EMER'))
            '{{$i->TURMA}}',
            @endif
            @endforeach
        ];

        if (turma == 'ei') {
            for (let index = 0; index < ei.length; index++) {
                document.getElementById(ei[index]).checked = true;
            }
        }
        if (turma == 'ef') {
            for (let index = 0; index < ef.length; index++) {
                document.getElementById(ef[index]).checked = true;
            }
        }
        if (turma == 'ef2') {
            for (let index = 0; index < ef2.length; index++) {
                document.getElementById(ef2[index]).checked = true;
            }
        }
        if (turma == 'em') {
            for (let index = 0; index < em.length; index++) {
                document.getElementById(em[index]).checked = true;
            }
        }
        if (turma == 'x') {
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
    $(document).ready(function() {
        $('#select').select2();
    });
</script>

<script>
    function addDocumentos() {
        var select = $('#docs').val()        
        var doc_obrigatorio = $('#doc_obrigatorio').val()
        select.forEach(e => {
            var id = Math.floor(Math.random() * 9999999)
            console.log(doc_obrigatorio, e) 
            if(doc_obrigatorio=='s')
                var doc_o = 'Obrigatório'
            else
                var doc_o = 'Não obrigatório'
            $( "#docsadd" ).append(
                '<div class="row" id="'+id+'"><input type="hidden" name="documentos['+e+']['+doc_obrigatorio+']"><div class="col-md-4">'+e+'</div><div class="col-md-2">' +doc_o+'</div><div class="col-md-2"><button type="button" class="btn btn-danger" onClick="$('+"'#"+id+"'"+').remove()"><i class="fa fa-trash"></i></button></div></div>'
                );

        });
    }
</script>
<script src="{{ asset('/js/jquery.mask.min.js') }}"></script>
@endsection
