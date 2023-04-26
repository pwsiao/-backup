<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class DeclineJoinNotice extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    protected $poster, $cptitle;
    public function __construct($poster, $cptitle)
    {
        $this->poster = $poster;
        $this->cptitle = $cptitle;
    }

    /**
     * Get the notification's delivery channels.
     * @param  mixed  $notifiable
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
        // return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    // public function toMail(object $notifiable): MailMessage
    // {
    //     return (new MailMessage)
    //                 ->line('The introduction to the notification.')
    //                 ->action('Notification Action', url('/'))
    //                 ->line('Thank you for using our application!');
    // }

    /**
     * Get the array representation of the notification.
     * @param  mixed  $notifiable
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            
            'poster'=> $this->poster,
            'message'=> '已拒絕你的共乘加入',
            'cptitle' => $this->cptitle,
            'message2'=>'，有緣再見!'
        ];
    }
}
