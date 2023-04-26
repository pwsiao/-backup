<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class CpcommentNotice extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    protected $someone, $cptitle, $comment, $cpid;
    public function __construct($someone, $cptitle, $comment, $cpid)
    {
        $this->someone = $someone;
        $this->cptitle = $cptitle;
        $this->comment = $comment;
        $this->cpid = $cpid;
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
            
            'someone'=> $this->someone, 
            'message'=> '在你的共乘貼文',
            'cptitle' => $this->cptitle,
            'message2' =>'中留言',
            'comment' => $this->comment,
            'cpid' => $this->cpid,
        ];
    }
}
