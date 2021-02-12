<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--<meta http-equiv="refresh" content="3" />-->
    <title>Comunicado</title>
</head>
<body style="background-color: lightgray; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif"">
    <div style="margin: 0 auto; width: 580px; background-color: white">
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
            <p>Disponibilizamos através do botão abaixo, o comunicado sobre <b>{{$comunicado->titulo}}</b> para o(a) aluno(a) <b>{{$totvs->NOME_ALUNO}}</b> - Turma <b>{{$totvs->TURMA}}</b>.</p>                        
        </div>
        <div style="text-align: center; padding: 10px;">
            <a href="" 
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
    </div>
</body>
</html>