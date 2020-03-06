<div style="margin: 0 auto; width: 100%; max-width: 600px; font-size:1em">
    <div style="width: 100%; background-color: midnightblue">
        <br>
        <img src="https://sia.abel.org.br/portal/img/5af5fc44d4812(BRANCA-HORIZONTAL)_Abel.png" alt="" srcset="" width="180px">
        <br>
        <br>
    </div>
    <div>


<h2>Lista de espera</h2> <br>

Prezado Responsável, <br> <br>

É com grande felicidade que informamos que está disponível a vaga na atividade <b>"{{$autoriza->ExtAtvListaDeEspera->ExtAtvTurma->ExtAtv->atividade}}"</b>
para o aluno <b>{{$autoriza->ExtAtvListaDeEspera->aluno->NOME_ALUNO}}</b> na turma <b> {{$autoriza->ExtAtvListaDeEspera->ExtAtvTurma->descricao_turma}}</b> no horário
das {{date('H:i',strtotime($autoriza->ExtAtvListaDeEspera->ExtAtvTurma->hora_ini))}}. <br> <br>

<a href="{{ route('exibe.espera', ['id'=>$autoriza->token]) }}" style="background-color: green;  color: white;  padding: 14px 25px;  text-align: center;  font-size: 2em;">Clique aqui e garanta sua vaga!</a>





<br><br>*O link expira em 48h. <br><br>
Agradecemos o apoio e a parceria. <br><br>

Atenciosamente, <br>
<b>Colégio La Salle Abel</b><br>
    </div>

</div>