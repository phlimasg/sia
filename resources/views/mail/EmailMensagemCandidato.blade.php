<div style="width: 100%; max-width: 600px; margin: 0 auto">
    <div style="background-color: #005BAC; padding: 10px">
        <img src="http://lasalle.edu.br/public/uploads/images/abel/5af5fc44d4812(BRANCA-HORIZONTAL)_Abel.png" alt="" width="220px">
    </div>
    <div style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif ; text-align: justify">
        <h3>Prezado(a) {{$candidato->RespFin->NOME}},</h3>
        <p>
            Informamos que precisamos de alguns documentos para darmos continuidade ao processo do candidato {{$candidato->NOME}}.
        </p>
        <p>Segue abaixo a mensagem da secretaria:</p>
        {!!$candidato->Mensagens()->latest()->first()->mensagem!!}
        <br>
    <a href="http://inscricao.abel.org.br/inscricao/candidato/falta_documento/{{$candidato->RESPFIN_CPF}}/{{$candidato->id}}" style="background-color: #4CAF50; /* Green */
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;">Enviar Documentos Faltantes</a>        
    </div>
</div>