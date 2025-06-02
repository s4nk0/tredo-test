<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DeviceNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public string $device_id,public string $title,public string $text)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return [FirebaseChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toFirebase(object $notifiable): array
    {

        return [
            'device_id' => $this->device_id,
            'title'=>$this->title,
            'text'=>$this->text,
        ];
    }
}
