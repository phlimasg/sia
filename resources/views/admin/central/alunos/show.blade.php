@extends('adminlte::page')

@section('title', 'Dados do Aluno')

@section('content')

<div class="row">
  <div class="col-md-3">
    <div class="box box-primary">
      <div class="box-body box-profile">
        <img class="profile-user-img img-responsive img-circle" 
          @if (Storage::disk('public')->exists('alunos/00000'.$totvs->RA.'.JPG'))
            src="{{Storage::url('alunos/00000'.$totvs->RA.'.JPG')}}"
            @else
            src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" 
          @endif           alt="User profile picture">

      <h3 class="profile-username text-center">{{$totvs->NOME_ALUNO}}</h3>

        <p class="text-muted text-center"><strong>CPF:</strong> {{$totvs->CPF}}</p>

        <ul class="list-group list-group-unbordered">
          <li class="list-group-item">
          <b>Matrícula</b> <a class="pull-right">{{$totvs->RA}}</a>
          </li>
          <li class="list-group-item">
            <b>Ano</b> <a class="pull-right">{{$totvs->ANO}}</a>
          </li>
          <li class="list-group-item">
            <b>Turma</b> <a class="pull-right">{{$totvs->TURMA}}</a>
          </li>
        </ul>
        <form action="https://portal1.lasalle.org.br/corpore.net//Source/EDU-EDUCACIONAL/Public/EduPortalAlunoLogin.aspx?AutoLoginType=ExternalLogin&undefined" method="POST" target="_blank">
          <input type="hidden" name="User" value="{{str_replace('-','',str_replace('.','',$totvs->RESPFINCPF))}}">
          <input type="hidden" name="Pass" value="{{str_replace('/','',$totvs->RESPFINDTNASCIMENTO)}}">
          <input type="hidden" name="Alias" value="_Oficial_Escola">
          <button type="submit" class="btn btn-primary btn-block">Entrar no TOTVS</button>
        </form>        
      </div>            
    </div>
  </div>
  <div class="col-md-9">
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#aluno" data-toggle="tab"><i class="fa fa-user"></i> Aluno</a></li>
        <li><a href="#resp_acad" data-toggle="tab"><i class="fa fa-graduation-cap"></i> Resp. Acadêmico</a></li>
        <li><a href="#resp_fin" data-toggle="tab"><i class="fa fa-money"></i> Resp. Financeiro</a></li>
        <li><a href="#pai" data-toggle="tab"><i class="fa fa-male"></i><i class="fa fa-female"></i> Pais</a></li>        
      </ul>
      <div class="tab-content">
        <div class="active tab-pane" id="aluno">

          <h3><i class="fa fa-user"></i> Dados do Aluno</h3>
          <div class="row">
            <div class="col-md-6">
              <label for="">Nome:</label>
              <p>{{$totvs->NOME_ALUNO}}</p>
            </div>
            <div class="col-md-3">
              <label for="">CPF:</label>
              <p>{{$totvs->CPF}}</p>
            </div>
            <div class="col-md-3">
              <label for="">E-mail do aluno:</label>
              <p>{{$totvs->EMAIL_ALUNO}}</p>
            </div>
          </div>
          <div class="row">
            <div class="col-md-1">
              <label for="">Sexo:</label>
              <p>{{$totvs->SEXO}}</p>
            </div>
            <div class="col-md-2">
              <label for="">Ano:</label>
              <p>{{$totvs->ANO}}</p>
            </div>
            <div class="col-md-1">
              <label for="">Turma:</label>
              <p>{{$totvs->TURMA[strlen($totvs->TURMA)-1]}}</p>
            </div>
            <div class="col-md-1">
              <label for="">Turno:</label>
              <p>{{$totvs->TURNO_ALUNO}}</p>
            </div>
            <div class="col-md-2">
              <label for="">Nº Cham.:</label>
              <p>{{$totvs->NUM_ALUNO}}</p>
            </div>
            <div class="col-md-1">
              <label for="">Matriculado:</label>
              <p>{{$totvs->MATRICULA}}</p>
            </div>
          </div>
          <hr>
          <h4><i class="fa fa-map"></i> Endereço</h4>
          <div class="row">
            <div class="col-md-12">
              <label for="">Rua:</label>
              <p>{{str_replace('Nº',' Nº',$totvs->ENDERECO)}}, {{$totvs->COMPLEMENTO}}</p>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <iframe
              width="100%"
              height="350"
              frameborder="0" style="border:0"
              src="https://www.google.com/maps/embed/v1/place?key={{env('MAPS_EMBED_API_KEY')}}&q={{str_replace('Nº','+Nº',str_replace(' ','+',$totvs->ENDERECO))}},{{str_replace(' ','+',$totvs->COMPLEMENTO)}}&maptype=satellite" 
              allowfullscreen>
            </iframe>            
            </div>
          </div>
          
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="resp_acad">
          <!-- The timeline -->
          <h3><i class="fa fa-user"></i> Dados do Responsável Acadêmico</h3>
          <div class="row">
            <div class="col-md-6">
              <label for="">Nome:</label>
              <p>{{$totvs->RESPACAD}}</p>
            </div>
            <div class="col-md-3">
              <label for="">CPF:</label>
              <p>{{$totvs->RESPACADCPF}}</p>
            </div>
            <div class="col-md-3">
              <label for="">E-mail do resp.:</label>
              <p>{{$totvs->RESPACADEMAIL}} <a href="mailto:{{$totvs->RESPACADEMAIL}}" target="_blank"><i class="fa fa-envelope-o"></i></a></p>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <label for="">Telefones:</label>
              <p>{{$totvs->RESPACADTEL1}} <a class="text-green" href="http://wa.me/55{{$totvs->RESPACADTEL1}}" target="_blank"><i class="fa fa-whatsapp"></i></a></p>
              @if (!empty($totvs->RESPACADTEL2))
                <p>{{$totvs->RESPACADTEL2}} <a class="text-green" href="http://wa.me/55{{$totvs->RESPACADTEL2}}" target="_blank"><i class="fa fa-whatsapp"></i></a></p>
              @endif
              @if (!empty($totvs->RESPACADTEL3))
                <p>{{$totvs->RESPACADTEL3}} <a class="text-green" href="http://wa.me/55{{$totvs->RESPACADTEL3}}" target="_blank"><i class="fa fa-whatsapp"></i></a></p>                  
              @endif
            </div>
            <div class="col-md-3">
              <label for="">Dt. Nascimento:</label>
              <p>{{$totvs->RESPACADDTNASCIMENTO}}</p>
            </div>
          </div>

        </div>
        <!-- /.tab-pane -->

        <div class="tab-pane" id="resp_fin">
          <h3><i class="fa fa-user"></i> Dados do Responsável Financeiro</h3>
          <div class="row">
            <div class="col-md-6">
              <label for="">Nome:</label>
              <p>{{$totvs->RESPFIN}}</p>
            </div>
            <div class="col-md-3">
              <label for="">CPF:</label>
              <p>{{$totvs->RESPFINCPF}}</p>
            </div>
            <div class="col-md-3">
              <label for="">E-mail do resp.:</label>
              <p>{{$totvs->RESPFINDEMAIL}} <a href="mailto:{{$totvs->RESPFINEMAIL}}" target="_blank"><i class="fa fa-envelope-o"></i></a></p>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <label for="">Telefones:</label>
              <p>{{$totvs->RESPFINTEL1}} <a class="text-green" href="http://wa.me/55{{$totvs->RESPFINTEL1}}" target="_blank"><i class="fa fa-whatsapp"></i></a></p>
              @if (!empty($totvs->RESPFINCEL))
                <p>{{$totvs->RESPFINCEL}} <a class="text-green" href="http://wa.me/55{{$totvs->RESPFINCEL}}" target="_blank"><i class="fa fa-whatsapp"></i></a></p>
              @endif              
            </div>
            <div class="col-md-3">
              <label for="">Dt. Nascimento:</label>
              <p>{{$totvs->RESPFINDTNASCIMENTO}}</p>
            </div>
          </div>
        </div>
        <div class="tab-pane" id="pai">
          
          <h3><i class="fa fa-male"></i> Dados do Pai</h3>
          <div class="row">
            <div class="col-md-6">
              <label for="">Nome:</label>
              <p>{{$totvs->Pai}}</p>
            </div>
            <div class="col-md-3">
              <label for="">CPF:</label>
              <p>{{$totvs->PaiCPF}}</p>
            </div>            
          </div>

          <div class="row">
            <div class="col-md-6">
              <label for="">Telefones:</label>
                 <p>{{str_replace('Tel1: ','',str_replace('Tel2: ','',$totvs->PaiTel))}}</p>          
            </div>
            <div class="col-md-3">
              <label for="">Dt. Nascimento:</label>
              <p>{{$totvs->PaiDtNasc}}</p>
            </div>
          </div>

          <h3><i class="fa fa-female"></i> Dados da Mãe</h3>
          <div class="row">
            <div class="col-md-6">
              <label for="">Nome:</label>
              <p>{{$totvs->Mae}}</p>
            </div>
            <div class="col-md-3">
              <label for="">CPF:</label>
              <p>{{$totvs->MaeCPF}}</p>
            </div>            
          </div>

          <div class="row">
            <div class="col-md-6">
              <label for="">Telefones:</label>
                 <p>{{str_replace('Tel1: ','',str_replace('Tel2: ','',$totvs->MaeTel))}}</p>          
            </div>
            <div class="col-md-3">
              <label for="">Dt. Nascimento:</label>
              <p>{{$totvs->MaeDtNasc}}</p>
            </div>
          </div>

        </div>
        <!-- /.tab-pane -->
      </div>
      <!-- /.tab-content -->
    </div>
    <!-- /.nav-tabs-custom -->
  </div>

  

</div>
    
@stop

@section('js')
<script>
  $(document).ready( function () {    
   $('#tabela').DataTable({
     //paging: false,
     searching: false,
   });
   //$('#tabela').hide();
} );
</script>
@endsection