<?php

namespace App\Jobs;

use App\Models\Notification;
use App\Models\User;
use App\Notifications\DeviceNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class UserDevicesNotificationJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public User $user,public Notification $notification)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->user->devices->each(function ($device) {
            $this->user->notify(new DeviceNotification(
                $device->device_id,
                'Новое сообщение',
                $this->notification->text
            ));
        });
    }
}
