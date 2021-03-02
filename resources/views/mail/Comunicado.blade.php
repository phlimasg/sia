<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--<meta http-equiv="refresh" content="3" />-->
    <title>Comunicado</title>
</head>
@php
    $comunicado = \App\Model\Comunicados\comunicado::find(32);
    $totvs = \App\Model\Totvs_alunos::where('RA',58556)->first()
@endphp
<body style="background-color: lightgray; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">
    <div style="margin: 0 auto; width: 580px; background-color: white;">
        <div style="width: 100%;">
            <img src="{{ asset('/portal/img/logo_azul.png') }}" alt="" style="padding: 8px" srcset="" height="45px" >
        </div>
        <div>
            <img src="{{ asset('/portal/img/topo_email.jpg') }}" alt="" style="" srcset="" width="100%">
        </div>
        
        <div style="padding: 10px;" >
            <h2 style="text-align: center">COMUNICADO</h2>
            <b>Assunto: </b> {{$comunicado->titulo}}
            <b><p>Prezados pais e/ou responsáveis, saudações Lassalistas! </p></b>
            <p></p>
            <p></p>
            <p>Disponibilizamos através do botão abaixo, o comunicado sobre <b>{{$comunicado->titulo}}</b> para o(a) aluno(a) <b>{{$totvs->NOME_ALUNO}}</b> - Turma <b>{{$totvs->TURMA[strlen($totvs->TURMA)-1]}}</b>.</p>                        
        </div>
        <div style="text-align: center; padding: 10px;">
            <a href="{{ route('comunicadosTelegram', ['id'=>$comunicado->id]) }}" 
            style="padding: 15px; 
            background-color: darkgreen; 
            color: white;             
            text-decoration: none;
            display: block;
            
            margin: 0 auto;
            "
            >
            👉 Acesse aqui o Comunicado 👈</a>
        </div>
        <div style="text-align: center; padding: 10px;">
            <b>
                <p>Viva Jesus em nossos corações! <br>Para sempre!</p>
            </b>
        </div>
        <div style="text-align: right; padding: 10px;">
            
            <p>Atenciosamente, <br>
                <b>Colégio La Salle Abel</b></p>
                <img src="{{ asset('/portal/img/logo_azul.png') }}" alt="" style="" srcset="" height="45px" >
                
            </div>
        <div style="background-color: #006F9E; color: white; padding: 5px">
            <h4 style="text-align: center">
                Fique por dentro!
            </h4>
            <table style="width: 80%; font-size: 12px; margin: 0 auto" border="0">            
                <tr>
                    <td style="width: 33%; text-align: center">
                        <a href="https://sia.abel.org.br" style="text-decoration: none">
                            <img src="{{ asset('/img/brasao.png') }}" alt="sia.abel.org.br" width="50%">  <br>
                            Clique para ver os comunicados anteriores.
                        </a>
                    </td>
                    <td style="width: 33%; text-align: center">
                        <a href="https://t.me/joinchat/AAAAAFVSI9t2MZcPDfWUTA" style="text-decoration: none">
                            <img src="{{ asset('img/telegram.png') }}" alt="Receba também no Telegram!" width="50%"><br>
                            Receba também no Telegram!
                        </a>
                    </td>
                    <td style="width: 33%; text-align: center">
                        <a href="http://educonnect.abel.org.br/"  style="text-decoration: none">
                            <img src="{{ asset('img/educ.png') }}" alt="Educonnect, baixe o app!" width="50%"> <br>
                            Educonnect, baixe o app! <br>
                            Saiba mais.
                        </a>
                    </td>
                </tr>            
            </table>
            <br>
        </div>
        <div style="text-align: center; font-size: 10px; padding: 10px">
            Enviado automaticamente pelo<br>
            SIA - Sistema Integrado Abel
        </div>
    </div>
</body>
</html>