<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class NotificationService
{
    public function sendToUser(int $userId, string $type, string $title, $notifiable): void
    {
        $notification = Notification::create([
            'user_id' => $userId,
            'type' => $type,
            'notifiable_type' => get_class($notifiable),
            'notifiable_id' => $notifiable->id,
            'data' => [
                'title' => $title,
                'body' => $title,
                'url' => $this->getNotificationUrl($type, $notifiable),
            ],
        ]);

        $this->sendWebPush($userId, $title, $notification->data);

        $this->sendSms($userId, $title);
    }

    protected function getNotificationUrl(string $type, $notifiable): string
    {
        return match ($type) {
            'intervention_accepted' => '/client/intervention/' . $notifiable->id,
            'intervention_status_updated' => '/client/intervention/' . $notifiable->id,
            default => '/notifications',
        };
    }

    protected function sendWebPush(int $userId, string $title, array $data): void
    {
        Log::info("Web push notification", ['user_id' => $userId, 'title' => $title, 'data' => $data]);
    }

    protected function sendSms(int $userId, string $message): void
    {
        Log::info("SMS notification", ['user_id' => $userId, 'message' => $message]);
    }
}
