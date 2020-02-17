@extends('adminlte::master')



@section('body_class', 'login-page')

@section('body')
<style>
        .login-page{
            background-attachment: fixed;
            background-size: cover;
            background-image: url('{{asset('portal/img/fundo.jpg')}}');            
        }
        .login-form{
            background-color: rgb(255, 255, 255, 50%); height: 100vh;
        }
        @media screen and (max-width: 730px) {
            .login-form{
                background-color: rgb(255, 255, 255, 50%); 
                height: 60vh;
            }
        }
        </style>
        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-4 text-center login-form">
                    <br>
                    <div align="center">
                        <img src="{{ asset('portal/img/5af5fc44d4812(BRANCA-HORIZONTAL)_Abel.png') }}" alt="" srcset="" class="img-responsive " >
                        {{date('Y-m-d H:i:s')}}
                    </div>
                    <div class="text-center" style="padding-top: 10%">                        
                            <form action="{{ route('portal.auth') }}" method="post">
                                @csrf
                                <div class="row text-center">
                                    <div class="col-sm-offset-1 col-sm-10">
                                        <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                <input type="text" class="form-control" name="usuario" placeholder="12345678999">
                                        </div>
                                    </div>
                                </div>                                
                                <div class="row text-center">
                                        <div class="col-sm-offset-1 col-sm-10">
                                            <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                                    <input type="password" class="form-control" name="senha" placeholder="09071991">
                                            </div>
                                        </div>
                                    </div>                                
                                    
                                    @if ($errors->any())
                                    
                                    <div class="row">                                            
                                        <div class="col-sm-offset-1 col-sm-10">
                                            <div class="alert alert-danger alert-dismissible text-left">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                    <h4><i class="icon fa fa-ban"></i> Erro!</h4>
                                                    @foreach ($errors->all() as $i)
                                                    <li>{{$i}}</li>                                                        
                                                    @endforeach
                                            </div>
                                        </div>
                                    </div>                                        
                                    @endif
                                    
                                    <div class="row"> 
                                    <div class="col-sm-offset-1 col-sm-10">
                                            <hr>
                                        <button type="submit" class="btn btn-block btn-primary"><i class="fa fa-key"></i> Entrar</button>
                                        <a type="submit" href="{{ route('gLogin') }}" class="btn btn-block btn-danger"><i class="fa fa-google"></i> Alunos e Colaboradores</a>
                                    </div>
                                </div>                                
                            </form>
                           
                    </div>
                </div>
                
                <div class="col-sm-8 text-justify" style="margin-top: 1%">                    
                    <ul class="timeline">
                         <!-- timeline time label -->
                         <li class="time-label">
                                <span class="bg-blue">
                                    05 set. 2019
                                </span>
                            </li>
                            <!-- /.timeline-label -->
    
                            <!-- timeline item -->
                            <li>
                                <!-- timeline icon -->
                                <i class="fa fa-exclamation bg-blue"></i>
                                <div class="timeline-item">
                                    <span class="time"><i class="fa fa-clock-o"></i> 14:19</span>
    
                                    <h3 class="timeline-header">Visualização dos acessos dos alunos</h3>
    
                                    <div class="timeline-body">
                                        <p>Agora, todos os responsáveis podem visualizar a listagem com os acessos dos alunos nos últimos 30 dias</p>
                                        <p>Faça o login e no menu lateral clique em <b>Controle de acesso</b></p>
                                    </div>
    
                                    <div class="timeline-footer">
                                        <!--<a class="btn btn-primary btn-xs"></a>-->
                                    </div>
                                </div>
                            </li>
                        <!-- timeline time label -->
                        <li class="time-label">
                            <span class="bg-red">
                                21 ago. 2019
                            </span>
                        </li>
                        <!-- /.timeline-label -->

                        <!-- timeline item -->
                        <li>
                            <!-- timeline icon -->
                            <i class="fa fa-exclamation bg-red"></i>
                            <div class="timeline-item">
                                <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                                <h3 class="timeline-header">La Salle Abel</h3>

                                <div class="timeline-body">
                                    <p>Para a maior segurança de nossos alunos, os comunicados só podem ser vistos após autenticação.</p>
                                    <p>Utilize os dados do Portal do Aluno(CPF e data de nascimento), do responsável acadêmico ou financeiro.</p>
                                </div>

                                <div class="timeline-footer">
                                    <!--<a class="btn btn-primary btn-xs"></a>-->
                                </div>
                            </div>
                        </li>
                        <!-- END timeline item -->
                    </ul>

                    
                </div>
            </div>
        </div>
@stop


