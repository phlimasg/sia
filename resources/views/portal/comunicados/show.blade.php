
@section('title', 'Comunicados')

@extends('adminlte::page')

@section('title', 'Comunicados')

@section('content_header')
    <h1>Visualização de Comunicado</h1>
@stop

@section('content')
<div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">{{$comunicado->titulo}}</h3>

      <div class="box-tools pull-right">
        <a href="{{ route('communicated.index') }}" class="btn btn-box-tool btn-default"><i class="fa fa-chevron-left"></i> Voltar</a>        
      </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body no-padding">           
      <!-- /.mailbox-controls -->
      <div class="mailbox-read-message">
        {!!$comunicado->descricao!!}
      </div>
      <!-- /.mailbox-read-message -->
    </div>
    <!-- /.box-body -->
    <!--
    <div class="box-footer">
      <ul class="mailbox-attachments clearfix">
        <li>
          <span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>

          <div class="mailbox-attachment-info">
            <a href="#" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i> Sep2014-report.pdf</a>
                <span class="mailbox-attachment-size">
                  1,245 KB
                  <a href="#" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>
                </span>
          </div>
        </li>
        <li>
          <span class="mailbox-attachment-icon"><i class="fa fa-file-word-o"></i></span>

          <div class="mailbox-attachment-info">
            <a href="#" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i> App Description.docx</a>
                <span class="mailbox-attachment-size">
                  1,245 KB
                  <a href="#" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>
                </span>
          </div>
        </li>
        <li>
          <span class="mailbox-attachment-icon has-img"><img src="../../dist/img/photo1.png" alt="Attachment"></span>

          <div class="mailbox-attachment-info">
            <a href="#" class="mailbox-attachment-name"><i class="fa fa-camera"></i> photo1.png</a>
                <span class="mailbox-attachment-size">
                  2.67 MB
                  <a href="#" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>
                </span>
          </div>
        </li>
        <li>
          <span class="mailbox-attachment-icon has-img"><img src="../../dist/img/photo2.png" alt="Attachment"></span>

          <div class="mailbox-attachment-info">
            <a href="#" class="mailbox-attachment-name"><i class="fa fa-camera"></i> photo2.png</a>
                <span class="mailbox-attachment-size">
                  1.9 MB
                  <a href="#" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>
                </span>
          </div>
        </li>
      </ul>
    </div>-->
    <!-- /.box-footer 
    <div class="box-footer">
      <div class="pull-right">
        <button type="button" class="btn btn-default"><i class="fa fa-reply"></i> Reply</button>
        <button type="button" class="btn btn-default"><i class="fa fa-share"></i> Forward</button>
      </div>      
      <button type="button" class="btn btn-default"><i class="fa fa-print"></i> Print</button>
    </div>-->
    <!-- /.box-footer -->
  </div>
    
@stop

@section('js')

    
@endsection