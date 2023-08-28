<?php

namespace App\Notifications;

use Spatie\Backup\Notifications\Notifications\BackupHasFailedNotification as BaseNotification;
use NotificationChannels\PusherPushNotifications\Message;



class BackupHasFailedNotification extends BaseNotification
{
    public function toPushNotification($notifiable)
    {
        return Message::create()
            ->iOS()
            ->badge(1)
            ->sound('fail')
            ->body("The backup of {$this->applicationName()} to disk {$this->diskName()} has failed");
    }
}

