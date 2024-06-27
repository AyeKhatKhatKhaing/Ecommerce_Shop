<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderEmailNotification extends Notification
{
    use Queueable;

    public $order;
    public $member;
    public $file_path;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($order, $member, $file_path)
    {
        $this->order           = $order;
        $this->member          = $member;
        $this->file_path       = $file_path;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->from('info@remfly.com', 'Remfly Wines & Limited')
            ->subject('Thanks For Ordering')
            ->view('mails.email-orderplaced', ['order' => $this->order, 'member' => $this->member])
            ->attach($this->file_path);
            // ->attachData($this->file_path->output(), "OrderReport.pdf");
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
