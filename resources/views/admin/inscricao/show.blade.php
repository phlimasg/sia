@extends('adminlte::page')

@section('title', 'Inscrições')

@section('content_header')
    
@stop

@section('content')
@if (Session::has('message'))
<div class="alert alert-success alert-dismissible">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  <h4><i class="fa fa-check"></i> Aviso!</h4>
  {{Session::get('message')}}
</div>
@endif
@can('secretaria',Auth::user())
<form action="{{ route('alunos_novos.update', ['candidato'=>$candidato->id]) }}" method="POST">
  @csrf
  @method('PUT')
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Alterar Status</h3>
      <div class="card-tools pull-right">
        <a href="{{ route('alunos_novos.listar') }}" class="btn btn-primary">
          <i class="fa fa-undo"></i> Voltar
        </a>
      </div>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-6">  
          <label for="">Status</label>      
          <select name="status" id="" class="form-control" required>
            <option value=""></option>
            <option value="Falta Documento" {{ $candidato->status == "Falta Documento"? 'selected' : ''}}>Falta Documento</option>
            <option value="Aprovado" {{ $candidato->status == "Aprovado"? 'selected' : ''}}>Aprovado</option>
          </select>
        </div>        
      </div>
      <div class="row">
        <div class="col-sm-8">
          <label for="">Digite abaixo uma mensagem para o responsável financeiro:</label>
          <textarea name="mensagem" id="mensagem" cols="30" rows="10" class="form-control"></textarea>
        </div>
      </div>      
      <br>
      <div class="row">
        <div class="col-md-12">
          <button type="submit" class="btn btn-warning btn-lg btn-block"><i class="fa fa-save"></i> Alterar Status</button>
        </div>
      </div>
    </div>
  </div>
</form>  
@endcan
<div class="card card-primary card-outline">
  <div class="card-header">
    <h3 class="card-title">Dados de {{$candidato->NOME}}</h3>
    @if ($candidato->ESPERA == 1)
      <div class="card-tools pull-right">
        <form action="{{ route('alunos_novos.habilitarEspera', ['candidato'=>$candidato->id]) }}" method="post" id="formEspera">
          @csrf
          <button id="btnEspera" type="submit" target="_blank" class="btn btn-warning"><i class="fa fa-usd">
          </i> Habilitar para Inscrição
        </button>
        </form>
      </div>        
      @else
      <div class="card-tools pull-right"><a href="http://inscricao.abel.org.br/inscricao/candidato/infos/{{$candidato->RESPFIN_CPF}}/{{$candidato->Inscricao->id}}" target="_blank" class="btn btn-primary"><i class="fa fa-print"></i> Imprimir ficha</a></div>    
    @endif
  </div>
  <div class="card-body">

    <div class="row">
      <div class="col-sm-3">
        <label for="">Escolaridade:</label>
        <p>{{$candidato->Escolaridade->ESCOLARIDADE}}</p>
      </div>
      <div class="col-sm-2">
        <label for="">Ano:</label>
        <p>{{$candidato->Escolaridade->ANO}}</p>
      </div>
      <div class="col-sm-2">
        <label for="">Turno:</label>
        <p>{{$candidato->Escolaridade->TURNO}}</p>
      </div>
      <div class="col-sm-2">
        <label for="">Integral?</label>
        <p>{{$candidato->INTEGRAL_ID ? 'SIM' : 'NÃO'}}</p>
      </div>
      @if ($candidato->Inscricao)
      <div class="col-sm-2">
        <label for="">Avaliação</label>
        <p>{{ date('d/m/Y', strtotime($candidato->Inscricao->Avaliacao->DTPROVA)) }} - {{$candidato->Inscricao->Avaliacao->HORAPROVA }}</p>
      </div>          
      @endif
    </div>
    <hr>


    <div class="row">
      <div class="col-sm-4">
        <label for="">Nome:</label>
        <p>{{$candidato->NOME}}</p>
      </div>
      <div class="col-sm-3">
        <label for="">Data de Nascimento:</label>
        <p>{{date('d/m/Y', strtotime($candidato->DTNASC))}}</p>
      </div>
      <div class="col-sm-3">
        <label for="">Data de Nascimento:</label>
        <p>{{$candidato->NAT}}</p>
      </div>
      <div class="col-sm-2">
        <label for="">Telefone:</label>
        <p>{{$candidato->TEL}}</p>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-md-3">
        <label for="">Resp. Fin.</label>
        <p>{{$candidato->RespFin->NOME}}</p>
      </div>
      <div class="col-md-3">
        <label for="">Resp. Fin. Email</label>
        <p>{{$candidato->RespFin->EMAIL}}</p>
      </div>
      <div class="col-md-3">
        <label for="">Resp. Fin. Telefone</label>
        <p>{{$candidato->RespFin->TEL}}</p>
      </div>
    </div>
    <div class="row">
      <div class="col-md-3">
        <label for="">Resp. Acad.</label>
        <p>{{$candidato->RespAcad->NOME}}</p>
      </div>
      <div class="col-md-3">
        <label for="">Resp. Acad. Email</label>
        <p>{{$candidato->RespAcad->EMAIL}}</p>
      </div>
      <div class="col-md-3">
        <label for="">Resp. Acad. Telefone</label>
        <p>{{$candidato->RespAcad->TEL}}</p>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-sm-2">
        <label for="">Ex-Aluno?</label>
        <p>{{$candidato->EXALUNO==0 ? 'NÃO' : 'SIM'}}</p>
      </div>
      <div class="col-sm-3">
        <label for="">Necessidade especiais?</label>
        <p>{{$candidato->NEC_ESP ? $candidato->NEC_ESP : 'NÃO'}}</p>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-sm-4">
        <label for="">Endereço:</label>
        <p>{{$candidato->ENDERECO}} - {{$candidato->BAIRRO}}</p>
      </div>
      <div class="col-sm-3">
        <label for="">Cidade/UF</label>
        <p> {{$candidato->CIDADE}} - {{$candidato->ESTADO}}</p>
      </div>
      <div class="col-sm-2">
        <label for="">CEP:</label>
        <p>{{$candidato->CEP}}</p>
      </div>
    </div>
  </div>
</div>
<div class="card card-warning card-outline">
  <div class="card-header">
    <h3 class="card-title">Documentos</h3>
  </div>
  <div class="card-body">
    <div class="row">
      @forelse ($candidato->Documentos as $i)
        <div class="col-sm-2">
          @if (strpos($i->nome,'.pdf'))
            <a href="http://inscricao.abel.org.br{{Storage::url($i->url)}}" target="_blank">
              <img src="{{asset('https://www.iconfinder.com/data/icons/file-extension-names-vol-8/512/24-512.png')}}" alt="" width="100%">
            </a>
          @else
            <a href="http://inscricao.abel.org.br{{Storage::url($i->url)}}" target="_blank">
              <img src="http://inscricao.abel.org.br{{Storage::url($i->url)}}" alt="" style="max-height: 136px; max-width: 100%;">
            </a>
          @endif    
        </div>      
      @empty
          <div class="col-sm-12">Nenhum documento enviado</div>
      @endforelse
    </div>
  </div>
</div>
@stop

@section('css')
 <style>
   .card-body{
     font-size: 20px;
   }
 </style>
@endsection
@section('js')
<script>
  $('#formEspera').submit(function(){
    $('#btnEspera').text('Enviando e-mail, aguarde...');
    $('#btnEspera').prop('disabled', true);
  });
</script>
<script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('vendor/unisharp/laravel-ckeditor/adapters/jquery.js') }}"></script>

 <script>   
   CKEDITOR.replace( 'mensagem', {
        filebrowserUploadUrl: "http://sia2.abel.org.br/ckeditor/image_upload?_token=dgYDyCCDQP9MS6A2Ygi722wurvXsmThAYt0CIk0N",
        filebrowserUploadMethod: 'form',
    extraPlugins: 'embed,autoembed,image2',
      height: 250,

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
      //filebrowserUploadUrl: "http://sia2.abel.org.br/ckeditor/image_upload?_token=dgYDyCCDQP9MS6A2Ygi722wurvXsmThAYt0CIk0N",
      //filebrowserImageUploadUrl: "http://sia2.abel.org.br/ckeditor/image_upload?_token=dgYDyCCDQP9MS6A2Ygi722wurvXsmThAYt0CIk0N",
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
      height: 250,
      

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