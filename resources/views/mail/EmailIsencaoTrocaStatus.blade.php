<div style="margin: 0 auto; max-width: 600px; font-size: 1.5em; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">
    <div style="background-color: navy">
        <img src="https://sia.abel.org.br/portal/img/5af5fc44d4812(BRANCA-HORIZONTAL)_Abel.png" alt="Logo Abel" width="150px">
        <img src="https://sia.abel.org.br/storage/uploads/top_email_desconto_1588023757.png" alt="" width="100%">
    </div>
    <div style="text-align: justify">
        <h3>Atualizamos sua solicitação!</h3>
        <p>Sua solicitação teve alteração de status.</p>
        <p> <b>Novo status:</b> {{$isencao->status}}</p>

        @if (!is_null($msg))
            <h4>Mensagem da comissão de descontos:</h4>
            <div style="background-color: lightgray; padding: 15px;">                
                {!! $isencao->mensagem->msg_usuario !!}
            </div>
        @endif

        <p>Você pode acompanhar a sua solicitação pelo link abaixo.</p>



        <div style="text-align: center">
            <a href="{{  route('solicita_flex.edit', ['id' => $isencao->cpf, 'token' => $isencao->user_token]) }}" style="
            background-color: green;
            border: none;
         color: white;
         padding: 20px 34px;
         text-align: center;
         text-decoration: none;
         display: inline-block;
         font-size: 20px;
         margin: 4px 2px;
         cursor: pointer;">
                Acompanhe sua solicitação clicando aqui.
            </a>
        </div>

    </div>
</div>