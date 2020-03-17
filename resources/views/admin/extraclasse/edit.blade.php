@extends('adminlte::page')

@section('title', 'Extraclasse')

@section('content_header')
    <h1>Editar Atividade Extraclasse</h1>
@stop

@section('content')
<div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header">
        <h3 class="box-title">Editar - {{$atv->atividade}}</h3>

          <div class="box-tools">
              <a href="{{ route('extclasse.index') }}"><i></i>Voltar</a>
          </div>          
        </div>
        <!-- /.box-header -->
        <div class="box-body  ">   
            <form action="{{route('extclasse.update', ['id'=>$atv->id])}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="atividade">Nome da Atividade:</label>
                      <input type="text" name="atividade" autofocus class="form-control" placeholder="Ex: Catequese, Escolinha, etc..." value="{{$atv->atividade}}">
                      @if ($errors->has('atividade'))
                          <span class="text-danger">*{{$errors->first('atividade')}}</span>                      
                      @endif                
                    </div>
                  </div> 
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="terceirizada">Terceirizada?</label>
                      <select name="terceirizada" id="" class="form-control">
                      <option value=""></option>  
                      <option value="1" @if ($atv->terceirizada==1) selected @endif>Sim</option>  
                      <option value="0" @if ($atv->terceirizada==0) selected @endif>Não</option>  
                      </select>                 
                      @if ($errors->has('terceirizada'))
                          <span class="text-danger">*{{$errors->first('terceirizada')}}</span>                      
                      @endif                
                    </div>
                  </div>                                  
                </div>
                <div class="row">
                  <div class="col-sm-6">
                      <div class="form-group">
                        <label for="cod_totvs">Imagem em miniatura:</label>
                        <input type="file" class="form-control" placeholder="Descrição da Atividade" name="imagem_mini" accept="image/png, image/jpeg, image/jpg, image/gif">
                        <div class="col-sm-6">
                            <img src="{{$atv->imagem_mini}}" class="img-responsive" style="max-height: 100px">
                        </div>
                        @if ($errors->has('imagem_mini'))
                      <span class="text-danger">*{{$errors->first('imagem_mini')}}</span>                      
                  @endif
                      </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                          <label for="cod_totvs">Imagem de fundo:</label>
                          <input type="file" class="form-control" placeholder="Descrição da Atividade" name="imagem_fundo" accept="image/png, image/jpeg, image/jpg, image/gif">
                          <div class="col-sm-6">
                              <img src="{{$atv->imagem_fundo}}" class="img-responsive" style="max-height: 100px">
                          </div>
                          @if ($errors->has('imagem_fundo'))
                          <span class="text-danger">*{{$errors->first('imagem_fundo')}}</span>                      
                      @endif
                        </div>
                      </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                          <label for="descricao_atv">Descrição da atividade:</label>
                          <textarea name="descricao_atv" id="" cols="30" rows="7" class="form-control">{{$atv->descricao}}</textarea>
                          @if ($errors->has('descricao_atv'))
                          <span class="text-danger">*{{$errors->first('descricao_atv')}}</span>                      
                      @endif              
                        </div>
                    </div> 
                </div>

                <button type="submit" class="btn btn-primary">Salvar</button>        
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
<script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
<script>
    CKEDITOR.replace( 'descricao_atv', {
        filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form',
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