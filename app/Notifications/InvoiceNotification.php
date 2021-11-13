<?php

namespace App\Notifications;

use App\Repo\InvoiceRepository;
use App\Service\Contracts\StoreServiceInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramFile;
use NotificationChannels\Telegram\TelegramMessage;

class InvoiceNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($url)
    {
        $this->url = $url;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['telegram'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        set_time_limit(300);
        return (new MailMessage)
            ->line('Your Invoice.')
            ->attachData($this->url,  'invoice.pdf', ['mime' => 'application/pdf'])
            ->line('Thank you for using our application!');
    }

    public function toTelegram($notifiable)
    {
        $aws = app(StoreServiceInterface::class);
        $invoice = InvoiceRepository::create($notifiable)->save('s3');
        $doc = $aws->get($invoice->filename);

        return TelegramFile::create()
            ->to($notifiable->user->telegram_id)
            ->content('Order# '. $notifiable->id . ' invoice' . "\r\n")
            ->options(['parse_mode' => ''])
            ->document($doc, $invoice->filename)
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
