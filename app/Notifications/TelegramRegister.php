<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;

class TelegramRegister extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {         
        return [TelegramChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toTelegram($notifiable)
    {
        //dd($notifiable);
        $url = url('telegram/comunicados/'.$notifiable->id);

        return TelegramMessage::create()
            // Optional recipient user id.
            ->to(env('TELEGRAM_CHANNEL'))
            // Markdown supported.
            ->content("*Título:* $notifiable->titulo\n\n".
            mb_substr(html_entity_decode(strip_tags($notifiable->descricao)), 0, 350,'UTF-8').'...')
            
            // (Optional) Blade template for the content.
            // ->view('notification', ['url' => $url])
            
            // (Optional) Inline Buttons
            ->button('Ver comunicado completo', $url);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
