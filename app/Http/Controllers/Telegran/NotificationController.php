<?php

namespace App\Http\Controllers\Telegran;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Comunicados\comunicado;
use App\Notifications\telegram as NotificationsTelegram;
use App\Notifications\TelegramRegister;
use NotificationChannels\Telegram\Telegram;
use NotificationChannels\Telegram\TelegramMessage;

class NotificationController extends Controller
{
    public function toTelegram()
    {
        $comunicado = new comunicado([
            'titulo'=> 'Boas vindas ao canal', 
            'descricao'=>'Sejam bem vindos ao nosso canal de envio de comunicados no Telegram. Entre e fique por dentro!',
            'user_id'=>2
        ]);
        $comunicado->save();
        //dd($comunicado);
        //$notification = new NotificationsTelegram(1428741749);
        $comunicado->notify(new TelegramRegister());
        //dd($notification);
    }
}
