<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\DB;

class NotifikasiPengajuan extends Notification
{
    use Queueable;

    private $data;
    private $url;
    private $title;
    private $message;
    public function __construct($data, $url, $title, $message)
    {
        $this->data = $data;
        $this->url = $url;
        $this->title = $title;
        $this->message = $message;
    }


    public function via($notifiable)
    {
        return ['database'];
    }


    public function toArray($notifiable)
    {
        return [
            'kode_form' => $this->data->kode_form,
            'title' => $this->title,
            'message' => $this->message,
            'url' => $this->url
        ];
    }
}
