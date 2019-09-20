@extends('adminlte::page')

@section('title', 'SOD')

@section('content_header')
    <h1>Relatório</h1>
@stop

@section('content')

<div class="box box-primary" >
        <div class="box-header with-border">
          <h3 class="box-title">Selecione os campos</h3>
        </div>
        <!-- /.box-header -->
        <form action="" method="post">

        
        <div class="box-body" data-select2-id="15">
          <div class="row">
            <div class="col-md-6" data-select2-id="14">
              <div class="form-group" data-select2-id="13">
                <label>Dia inícial</label>
                <input type="date" name="dt_ini" id="" class="form-control">
              </div>
              <!-- /.form-group -->
              <div class="form-group">                
                <label>Dia final</label>
                <input type="date" name="dt_fim" id="" class="form-control">
              </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
              <div class="form-group">
                    <label>Hora de início</label>
                    <input type="time" name="hr_ini" id="" class="form-control">
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                    <label>Hora final</label>
                    <input type="time" name="hr_fim" id="" class="form-control">
              </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
          <div class="row">
              <div class="col-md-6">
                    <label>Escolaridade</label>                    
                    <select multiple class="form-control" name="escolaridade">
                        <option value="EMER">EM</option>
                        <option value="EFER">EF I</option>
                        <option value="EFERII">EF II</option>
                        <option value="EI">EI</option>
                    </select>
              </div>
          </div>
          <br>
          <div class="row">
                  <div class="col-sm-3">
                      <button type="submit" class="btn btn-primary"><i class="fa fa-file-excel-o"></i> Gerar excel</button>
                  </div>
              </div>     
        </div>
        <!-- /.box-body -->   
      </div>
      @csrf
    </form>
    </div>
@stop

@section('js')
 
@endsection