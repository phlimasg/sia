@extends('adminlte::page')
@section('css')
  <meta name="csrf-token" content="{{ Session::token() }}">
@stop

@section('title', 'Solicitação de Flexibilização de Parcelas')
@section('content_header')
    <h1><i class="fa fa-money"></i> Solicitação de Flexibilização de Parcelas</h1>
@stop

@section('content')

<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">Dados do solicitante</h3>
  </div>
  <div class="box-body">


<!-- Modal -->
<div id="msgPub" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Mensagens enviadas para o usuário</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">

            <!-- The time line -->
            <ul class="timeline">
              @forelse ($isencao->mensagemPubAll as $i)
                <li class="time-label">
                  <span class="bg-red">
                    {{date('d/m/Y', strtotime($i->created_at))}}
                  </span>
                </li>
                <li>
                  <i class="fa fa-envelope bg-blue"></i>
    
                  <div class="timeline-item bg-gray">
                    <span class="time"><i class="fa fa-clock-o"></i> {{date('H:i', strtotime($i->created_at))}}</span>
    
                    <h3 class="timeline-header"><strong>{{$i->user->name}}</strong> enviou:</h3>
    
                    <div class="timeline-body">
                      {!!$i->msg_usuario!!}
                    </div>                    
                  </div>
                </li>
                <!-- END timeline item -->
              @empty
                  Nenhuma mensagem para mostar
              @endforelse                            
            </ul>
          </div>
          <!-- /.col -->
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<div id="msgInt" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Anotações internas</h4>
      </div>
      <div class="modal-body">
        <!-- The time line -->
        <ul class="timeline">
          @forelse ($isencao->mensagemInternaAll as $i)
            <li class="time-label">
              <span class="bg-red">
                {{date('d/m/Y', strtotime($i->created_at))}}
              </span>
            </li>
            <li>
              <i class="fa fa-envelope bg-blue"></i>

              <div class="timeline-item bg-gray">
                <span class="time"><i class="fa fa-clock-o"></i> {{date('H:i', strtotime($i->created_at))}}</span>

                <h3 class="timeline-header"><strong>{{$i->user->name}}</strong> salvou:</h3>

                <div class="timeline-body">
                  {{$i->msg_interna}}
                </div>                    
              </div>
            </li>
            <!-- END timeline item -->
          @empty
              Nenhuma mensagem para mostar
          @endforelse                            
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


    <div class="row">
      <div class="col-md-6">
        <p><label for="">Nome:</label> {{$isencao->totvs->RESPFIN}}</p>
        <p><label for="">CPF:</label> {{$isencao->totvs->RESPFINCPF}}</p>
        <p><label for="">email:</label> {{$isencao->totvs->RESPFINEMAIL}}</p>
        <div class="row">
          <div class="col-sm-3">
            <a class="btn btn-app btn-primary bg-blue " data-toggle="modal" data-target="#msgPub">
              <span class="badge bg-red">{{$isencao->mensagemPubAll()->count()}}</span>
              <i class="fa fa-user"></i> Mensagens para o usuário
            </a>    
          </div>          
          <div class="col-sm-3">
            <a class="btn btn-app bg-red" data-toggle="modal" data-target="#msgInt">
              <span class="badge bg-blue">{{$isencao->mensagemInternaAll()->count()}}</span>
              <i class="fa fa-envelope"></i> Anotações internas
            </a>    
          </div> 
        </div>
      </div>
      <div class="col-sm-push-3 col-sm-3">        
        <div class="row">
          <div class="col-md-12">
            <div class="info-box bg-aqua">
              <span class="info-box-icon"><i class="fa fa-envelope-o"></i></span>    
              <div class="info-box-content">
                <small>Status</small>
              <h3>{{$isencao->status}}</h3>           
              </div>          
            </div> 
          </div>      
        </div>
        <div class="row">
          <div class="col-md-12">
          <form action="{{ route('covid.update',['id'=> $isencao->id]) }}" method="post">
              @csrf            
              @method('put')
              <button type="button" class="btn btn-success btn-lg btn-block" data-toggle="modal" data-target="#status"> <span class="fa fa-exchange"></span> Alterar Status</button>
              
              <!-- Trigger the modal with a button -->

              <!-- Modal -->
              <div id="status" class="modal fade" role="dialog">
                <div class="modal-dialog modal-lg">

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Alterar status</h4>
                    </div>
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-sm-5">
                          <label for="">Selecione o status</label>
                          <select name="status" id="" class="form-control">
                            <option value="Em Análise">Em Análise</option>
                            <option value="Indeferido">Indeferido</option>
                            @can('supervisao_adm')
                              <option value="Deferido">Deferido</option>
                            @endcan
                            <option value="Falta Documento">Falta Documento</option>
                            <option value="Supervisão Administrativa">Supervisão Administrativa</option>
                          </select>
                          <br>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-12">
                          <label for="">Parecer da comissão/administração(Mensagem para controle interno):</label>
                          <textarea name="msg_interna" id="msg_interna" cols="30" rows="5" class="form-control"></textarea>
                        </div>
                        <div class="col-sm-12">
                          <label for="">Mensagem para o usuário(Vai no corpo do e-mail):</label>
                          <textarea name="msg_usuario" id="msg_usuario" cols="30" rows="5" class="form-control"></textarea>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" id="alterarStatus" class="btn btn-primary btn-lg btn-block">Alterar status</button>
                    </div>
                  </div>

                </div>
              </div>
            </form>
          </div>
        </div>   
      </div>
    </div>   
  </div>
</div>

<h3 class="box-title"> <span class="fa fa-user"></span> Alunos Matriculados</h3>

<div class="box-body">
  <div class="row">
    @forelse ($isencao->alunos as $i)
      <div class="col-md-3">
      <div class="box-profile panel">
        <div class="panel-body">
          <img class="profile-user-img img-responsive img-circle" src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" alt="User profile picture">

          <h3 class="profile-username text-center">{{$i->NOME_ALUNO}}</h3>

          <p class="text-muted text-center">{{$i->CPF}}</p>         

          <ul class="list-group list-group-unbordered">
            <li class="list-group-item">
              <b>Matrícula</b> <span class="pull-right">{{$i->RA}}</span>
            </li>
            <li class="list-group-item">
              <b>Ano</b> <span class="pull-right">{{$i->ANO}}</span>
            </li>
            <li class="list-group-item">
              <b>Turma</b> <span class="pull-right">{{$i->TURMA}}</span>
            </li>
            <li class="list-group-item">
              <b>Turno</b> <span class="pull-right">{{$i->TURNO_ALUNO}}</span>
            </li>  
            @foreach ($i->desconto as $j)
            <li class="list-group-item">
              <b>Bolsa</b> <span class="pull-right">{{$j->Bolsa}}</span>
            </li>  
            <li class="list-group-item">
              <b>Serviço</b> <span class="pull-right">{{$j->Servico}}</span>
            </li> 
            <li class="list-group-item">
              <b>Tipo</b> <span class="pull-right">{{$j->TipoDesconto}}</span>
            </li>  
            <li class="list-group-item">
              <b>Percentual que possui</b> <span class="pull-right">{{intval($j->VLDesconto)}}%</span>
            </li>                
            @endforeach
            @php($sug = $isencao->descontoSugerido($i->RA)->orderBy('created_at','desc')->first('percentual'))
            @if ($sug)
            <li class="list-group-item bg-blue">
              <b>Desconto sugerido</b> <span class="pull-right">{{ $sug->percentual }}%</span>
            </li>                
            @endif
          </ul>
        <a  data-toggle="modal" data-target="#modal{{$i->RA}}" class="btn btn-primary btn-block">Sugerir desconto</a>
        <hr>
        @php($aut = $isencao->descontoAutorizado($i->RA)->orderBy('created_at','desc')->first('percentual'))
        @if ($aut)
          <ul class="list-group list-group-unbordered">
            <li class="list-group-item bg-green">
              <b>Desconto Autorizado</b> <span class="pull-right">{{ $aut->percentual }}%</span>
            </li>                
          </ul>
        @endif
        @can('supervisao_adm')
          <a  data-toggle="modal" data-target="#deferir{{$i->RA}}" class="btn btn-success btn-block"><span class="fa fa-money"></span> Deferir desconto</a>

          <!-- Modal -->
          <div id="deferir{{$i->RA}}" class="modal fade" role="dialog">
            <div class="modal-dialog">

              <!-- Modal content-->
              <form action="{{ route('covid.storeAutorizado') }}" method="post">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Deferir desconto para: {{$i->NOME_ALUNO}}</h4>
                </div>
                <div class="modal-body">

                  @foreach ($i->desconto as $j)
                    <li class="list-group-item">
                      <b>Bolsa</b> <span class="pull-right">{{$j->Bolsa}}</span>
                    </li>  
                    <li class="list-group-item">
                      <b>Serviço</b> <span class="pull-right">{{$j->Servico}}</span>
                    </li> 
                    <li class="list-group-item">
                      <b>Tipo</b> <span class="pull-right">{{$j->TipoDesconto}}</span>
                    </li>  
                    <li class="list-group-item">
                      <b>Percentual que possui</b> <span class="pull-right">{{intval($j->VLDesconto)}}%</span>
                    </li>
                    @if ($sug)
                    <li class="list-group-item bg-yellow">
                      <b>Desconto sugerido</b> <span class="pull-right">{{ $sug->percentual }}%</span>
                    </li>                
                    @endif                
                  @endforeach                  
                    @csrf
                    <hr>
                    <div class="row">
                      <div class="col-sm-4">
                        <label for="">Deferir precentual de:</label> 
                      <input type="hidden" name="ra" value="{{$i->RA}}">
                      <input type="hidden" name="portal_isencao_id" value="{{$isencao->id}}">
                        <input type="text" name="percentual" id="" class="form-control" value="" placeholder="00.0">
                        <small class="text-danger">*apenas números</small><br>
                        <small class="text-danger">*utilize ponto e não vírgula</small>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" > <i class="fa fa-save"></i> Salvar</button>
                  </div>
                </div>
              </form>

            </div>
          </div>

        @endcan

          <!-- Modal -->
          <div id="modal{{$i->RA}}" class="modal fade" role="dialog">
            <div class="modal-dialog">

              <!-- Modal content-->
              <form action="{{ route('covid.store') }}" method="post">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Sugerir desconto para: {{$i->NOME_ALUNO}}</h4>
                </div>
                <div class="modal-body">

                  @foreach ($i->desconto as $j)
                    <li class="list-group-item">
                      <b>Bolsa</b> <span class="pull-right">{{$j->Bolsa}}</span>
                    </li>  
                    <li class="list-group-item">
                      <b>Serviço</b> <span class="pull-right">{{$j->Servico}}</span>
                    </li> 
                    <li class="list-group-item">
                      <b>Tipo</b> <span class="pull-right">{{$j->TipoDesconto}}</span>
                    </li>  
                    <li class="list-group-item">
                      <b>Percentual que possui</b> <span class="pull-right">{{intval($j->VLDesconto)}}%</span>
                    </li>                
                  @endforeach                  
                    @csrf
                    <hr>
                    <div class="row">
                      <div class="col-sm-4">
                        <label for="">Sugerir precentual de:</label> 
                      <input type="hidden" name="ra" value="{{$i->RA}}">
                      <input type="hidden" name="portal_isencao_id" value="{{$isencao->id}}">
                        <input type="text" name="percentual" id="" class="form-control" value="" placeholder="00.0">
                        <small class="text-danger">*apenas números</small><br>
                        <small class="text-danger">*utilize ponto e não vírgula</small>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" > <i class="fa fa-save"></i> Salvar</button>
                  </div>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div> 
    </div>
      @empty
          Nenhum aluno para mostar
      @endforelse      
    </div>
</div>


<div class="box box-primary">
  <div class="box-header with-border">Descrição da solicitação</div>  
    <div class="box-body">      
      <div class="row">                     
        <div class="col-md-3">
        <label for="">Motivo da solicitação: </label> {{$isencao->motivo->motivo}}
          
        </div>
      </div>            
      <div class="row">
        <div class="col-md-6" >
          <label for="">Solicitação:</label>
          <p>{{$isencao->apelacao}}</p>
        </div>
      </div>      
      <hr>
      <div class="panel panel-default">
        <div class="panel-heading">
          Documentos anexados
        </div>
        <div class="panel-body">
          <div class="row">
            @forelse ($isencao->documentos as $i)
            <div class="col-sm-1 text-center">
              @if (substr($i->url, -4) == '.pdf')
              <a href="{{Storage::url($i->url)}}" target="_blank">
                <img src="{{ asset('portal/img/pdf-icon.png') }}" alt="Fazer download" class="img-responsive">              
                {{mb_strimwidth( $i->nome, 0, 15, "..." )}} 
              </a>              
              @else
              <a href="{{Storage::url($i->url)}}" target="_blank">
                <img src="{{Storage::url($i->url)}}" alt="Fazer download" class="img-responsive">              
                  {{mb_strimwidth( $i->nome, 0, 15, "..." )}}  
              </a>              
              @endif
            </div>
            @empty
            <h1>Nenhum arquivo adicionado</h1>
                
            @endforelse
          </div>
          
        </div>
        
      </div>
    </div>     
  </div>
  
  
@stop

@section('js')
<script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
<script>
  $("#alterarStatus").click(function() {
    setTimeout(function(){
      $("#alterarStatus").html("Aguarde, salvando dados e notificando usuário..."); 
      $("#alterarStatus").prop('disabled','true');
      $("#alterarStatus").css("background-color", "red");        
    }, 200);
  })
</script>
<script>
  CKEDITOR.replace( 'msg_usuario', {
      //filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
      //filebrowserUploadMethod: 'form',
  extraPlugins: 'embed,autoembed,image2',
    height: 200,

    // Load the default contents.css file plus customizations for this sample.
    contentsCss: [
      'http://cdn.ckeditor.com/4.12.1/full-all/contents.css',
      'https://ckeditor.com/docs/vendors/4.12.1/ckeditor/assets/css/widgetstyles.css'
    ],
    // Setup content provider. See https://ckeditor.com/docs/ckeditor4/latest/features/media_embed
    embed_provider: '//ckeditor.iframe.ly/api/oembed?url={url}&callback={callback}',

    // Configure the Enhanced Image plugin to use classes instead of styles and to disable the
    // resizer (because image size is controlled by widget styles or the image takes maximum
    // 100% of the editor width).
    image2_alignClasses: ['image-align-left', 'image-align-center', 'image-align-right'],
    image2_disableResizer: true,
    toolbar: [        
  { name: 'clipboard', items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
  { name: 'editing', items: [ 'Find', 'Replace', '-', 'SelectAll', '-', 'Scayt' ] },
  { name: 'forms', items: [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField' ] },
  { name: 'document', items: [ 'Source', '-', 'Save', 'NewPage', 'Preview', 'Print', '-', 'Templates' ] },
  '/',
  { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'CopyFormatting', 'RemoveFormat' ] },
  { name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language' ] },
  { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
  { name: 'insert', items: [ 'Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe' ] },
  '/',
  { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
  { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
  { name: 'tools', items: [ 'Maximize', 'ShowBlocks' ] },
  { name: 'about', items: [ 'About' ] }
    ],

    // Since we define all configuration options here, let's instruct CKEditor to not load config.js which it does by default.
    // One HTTP request less will result in a faster startup time.
    // For more information check https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_config.html#cfg-customConfig
    customConfig: '',

    // Upload images to a CKFinder connector (note that the response type is set to JSON).
    //uploadUrl: '/apps/ckfinder/3.4.5/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json',

    // Configure your file manager integration. This example uses CKFinder 3 for PHP.
    //filebrowserBrowseUrl: '/apps/ckfinder/3.4.5/ckfinder.html',
    //filebrowserImageBrowseUrl: '/apps/ckfinder/3.4.5/ckfinder.html?type=Images',
    //filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
    //filebrowserImageUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
    //filebrowserUploadMethod: 'form',    

    // Sometimes applications that convert HTML to PDF prefer setting image width through attributes instead of CSS styles.
    // For more information check:
    //  - About Advanced Content Filter: https://ckeditor.com/docs/ckeditor4/latest/guide/dev_advanced_content_filter
    //  - About Disallowed Content: https://ckeditor.com/docs/ckeditor4/latest/guide/dev_disallowed_content
    //  - About Allowed Content: https://ckeditor.com/docs/ckeditor4/latest/guide/dev_allowed_content_rules
    disallowedContent: 'img{width,height,float}',
    extraAllowedContent: 'img[width,height,align];span{background}',

    // Enabling extra plugins, available in the full-all preset: https://ckeditor.com/cke4/presets
    extraPlugins: 'colorbutton,font,justify,print,tableresize,uploadimage,uploadfile,pastefromword,liststyle,pagebreak',

    /*********************** File management support ***********************/
    // In order to turn on support for file uploads, CKEditor has to be configured to use some server side
    // solution with file upload/management capabilities, like for example CKFinder.
    // For more information see https://ckeditor.com/docs/ckeditor4/latest/guide/dev_ckfinder_integration

    // Uncomment and correct these lines after you setup your local CKFinder instance.
    // filebrowserBrowseUrl: 'http://example.com/ckfinder/ckfinder.html',
    // filebrowserUploadUrl: 'http://example.com/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
    /*********************** File management support ***********************/

    // Make the editing area bigger than default.
    height: 200,
    

    // An array of stylesheets to style the WYSIWYG area.
    // Note: it is recommended to keep your own styles in a separate file in order to make future updates painless.
    contentsCss: [
      'http://cdn.ckeditor.com/4.12.1/full-all/contents.css',
      'assets/css/pastefromword.css'
    ],

    // This is optional, but will let us define multiple different styles for multiple editors using the same CSS file.
    bodyClass: 'document-editor',

    // Reduce the list of block elements listed in the Format dropdown to the most commonly used.
    format_tags: 'p;h1;h2;h3;pre',

    // Simplify the Image and Link dialog windows. The "Advanced" tab is not needed in most cases.
    removeDialogTabs: 'image:advanced;link:advanced',

    // Define the list of styles which should be available in the Styles dropdown list.
    // If the "class" attribute is used to style an element, make sure to define the style for the class in "mystyles.css"
    // (and on your website so that it rendered in the same way).
    // Note: by default CKEditor looks for styles.js file. Defining stylesSet inline (as below) stops CKEditor from loading
    // that file, which means one HTTP request less (and a faster startup).
    // For more information see https://ckeditor.com/docs/ckeditor4/latest/features/styles
    stylesSet: [
      /* Inline Styles */
      {
        name: 'Marker',
        element: 'span',
        attributes: {
          'class': 'marker'
        }
      },
      {
        name: 'Cited Work',
        element: 'cite'
      },
      {
        name: 'Inline Quotation',
        element: 'q'
      },

      /* Object Styles */
      {
        name: 'Special Container',
        element: 'div',
        styles: {
          padding: '5px 10px',
          background: '#eee',
          border: '1px solid #ccc'
        }
      },
      {
        name: 'Compact table',
        element: 'table',
        attributes: {
          cellpadding: '5',
          cellspacing: '0',
          border: '1',
          bordercolor: '#ccc'
        },
        styles: {
          'border-collapse': 'collapse'
        }
      },
      {
        name: 'Borderless Table',
        element: 'table',
        styles: {
          'border-style': 'hidden',
          'background-color': '#E6E6FA'
        }
      },
      {
        name: 'Square Bulleted List',
        element: 'ul',
        styles: {
          'list-style-type': 'square'
        }
      }
    ]
  });
  </script>
@endsection