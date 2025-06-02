<?php

namespace App\Notifications;

use App\Models\FirebaseNotificationLog;
use App\Services\FirebaseService;
use Illuminate\Notifications\Notification;

class FirebaseChannel
{


    public function send(object $notifiable, Notification $notification): void
    {
        $service = app(FirebaseService::class);
        $message = $notification->toFirebase($notifiable);

        // Send notification to the $notifiable instance...
        $data = [
            'token'=>@$message['device_id'],
            'title'=>@$message['title'],
            'body'=>@$message['text'],
        ];


        $response = $service->send(...$data);

        FirebaseNotificationLog::create([
            'status_code'=>$response->getStatusCode(),
            'user_id'=>$notifiable->id,
            'request_body'=>$data,
            'sent'=>$response->getStatusCode() == 200,
            'response_body'=>json_decode($response->getBody()->getContents(),true),
        ]);
    }
}
