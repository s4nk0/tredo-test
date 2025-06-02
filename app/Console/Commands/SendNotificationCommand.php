<?php

namespace App\Console\Commands;

use App\Jobs\UserDevicesNotificationJob;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Console\Command;

class SendNotificationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Крон задача для отправки уведомлений';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Notification::active()->get()->each(function ($notification) {
            User::chunk(100, function($users) use ($notification) {
                foreach ($users as $user){
                    UserDevicesNotificationJob::dispatch($user,$notification);
                }
            });

            $notification->update([
                'sent'=>true
            ]);
        });
    }
}
