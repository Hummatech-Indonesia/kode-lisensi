<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class DashboardNotification extends Notification
{
    use Queueable;

    public array $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(array $user)
    {
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array
     */
    public function via(): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array
     */

    public function toArray(): array
    {
        return [
            'name' => $this->user['name'] ?? null,
            'url' => $this->user['url'] ?? null
        ];
    }
}
