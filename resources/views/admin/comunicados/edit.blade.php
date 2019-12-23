@extends('adminlte::page')

@section('title', 'Add Comunicado')

@section('content_header')
    <h1>Editar Comunicado</h1>
@stop

@section('content')
<form action="{{ route('comunicados.update',['id' => $comunicado->id]) }}" method="post">
    @method('put')        
@csrf
   <div class="row">
       <div class="col-sm-6">
           <label for="title">Título</label>
           <input type="text" id="" class="form-control" placeholder="Título do comunicado" name="titulo" 
           @if(!empty(old('titulo')))
           value="{{old('titulo')}}"
           @else
           value="{{$comunicado->titulo}}"
           @endif>
       </div>       
    </div>
    <div class="row">
        <div class="col-sm-12">
            <label for="title">Conteúdo</label>
            <textarea name="descricao" id="descricao" rows="25" cols="80" class="form-control">@if(!empty(old('titulo'))){{old('descricao')}}@else{{$comunicado->descricao}}@endif</textarea>
        </div>
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
        @php
            $ano = null;
        @endphp
        @forelse ($totvs_alunos as $i)
            @if ($i->ano != $ano)
                @if ( $ano != null && $i->ano != $ano)
                    </div>  
                @endif
            <div class="row">
                <div class="col-sm-3">
                    <label for="">{{$i->ano}} - {{$i->turma}}</label><br>
                </div>
            </div>                        
            <div class="row">
                <div class="col-sm-1">
                    <label class="checkbox-inline">
                        <input type="checkbox" value="{{$i->turma}}" id="{{$i->turma}}" name="turma[]"
                        @foreach ($comunicado->turmas as $turma)
                            @if ($turma->turma == $i->turma)
                                checked
                            @endif
                        @endforeach
                        >
                        {{$i->turma}}                        
                    </label>
                </div>                
            @else
            <div class="col-sm-1">
                <label class="checkbox-inline">
                    <input type="checkbox" value="{{$i->turma}}" id="{{$i->turma}}" name="turma[]"
                        @foreach ($comunicado->turmas as $turma)
                            @if ($turma->turma == $i->turma)
                                checked
                            @endif
                        @endforeach
                        >
                    {{$i->turma}}
                </label>
            </div> 
            @endif
            @php
                $ano=$i->ano;     
            @endphp
        @empty
            Nenhuma turma disponível
        @endforelse
    </div> 
    <hr>
    <div class="row">
        <div class="col-sm-2">
            <button type="submit" class="btn btn-primary btn-block"><span class="fa fa-save"></span> Salvar</button>
        </div>
    </div>
</form>   
    <script> 
        function checkTurma(turma) {
            var ei = [
                @foreach ($totvs_alunos as $i)
                    @if (strstr($i->turma,'EIER'))
                    '{{$i->turma}}',
                    @endif
                @endforeach
            ];
            var ef = [
                @foreach ($totvs_alunos as $i)
                    @if (strstr($i->turma,'EFER01') or strstr($i->turma,'EFER02') or strstr($i->turma,'EFER03') or strstr($i->turma,'EFER04') or strstr($i->turma,'EFER05'))
                    '{{$i->turma}}',
                    @endif
                @endforeach
            ];
            var ef2 = [
                @foreach ($totvs_alunos as $i)
                    @if (strstr($i->turma,'EFER06') or strstr($i->turma,'EFER07') or strstr($i->turma,'EFER08') or strstr($i->turma,'EFER09'))
                    '{{$i->turma}}',
                    @endif
                @endforeach
            ];
            var em = [
                @foreach ($totvs_alunos as $i)
                    @if (strstr($i->turma,'EMER'))
                    '{{$i->turma}}',
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
    
    
@stop

@section('js')
<script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
<script>
    CKEDITOR.replace( 'descricao', {
        filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form',
    extraPlugins: 'embed,autoembed,image2',
      height: 500,

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
      toolbar: [{
          name: 'clipboard',
          items: ['PasteFromWord', '-', 'Undo', 'Redo']
        },
        {
          name: 'basicstyles',
          items: ['Bold', 'Italic', 'Underline', 'Strike', 'RemoveFormat', 'Subscript', 'Superscript']
        },
        {
          name: 'links',
          items: ['Link', 'Unlink']
        },
        {
          name: 'paragraph',
          items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote']
        },
        {
          name: 'insert',
          items: ['Image', 'Table']
        },
        {
          name: 'editing',
          items: ['Scayt']
        },
        '/',

        {
          name: 'styles',
          items: ['Format', 'Font', 'FontSize']
        },
        {
          name: 'colors',
          items: ['TextColor', 'BGColor', 'CopyFormatting']
        },
        {
          name: 'align',
          items: ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock']
        },
        {
          name: 'document',
          items: ['Print', 'PageBreak', 'Source']
        }
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
      height: 500,
      

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