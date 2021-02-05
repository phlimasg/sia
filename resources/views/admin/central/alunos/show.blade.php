@extends('adminlte::page')

@section('title', 'Download de Leads')

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