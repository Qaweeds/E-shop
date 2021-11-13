<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\View\View;
use NotificationChannels\Telegram\TelegramMessage;

class TelegramOrderNotification extends Notification
{
    use Queueable;

    /**
     * @var View
     */
    private $message;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        if($notifiable->user->telegram_id) {
            return ['telegram'];
        }
    }

    public function toTelegram($notifiable)
    {
       return TelegramMessage::create()
            ->to($notifiable->user->telegram_id)
            ->content('Заказ №' . $notifiable->id . "\r\n" .
                ' Успешно создан' . "\r\n" .
                'Сумма: ' . $notifiable->total . '$' . "\r\n" .
                'Статус: ' . $notifiable->status->name . '.' . "\r\n" .
                'Спасибо за заказ!'. "\r\n")
            ->options(['parse_mode' => ''])
            ->button('К заказу', route('account.orders.show', $notifiable->id));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
