<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;

class LeaveRequestNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $leaveRequest;
    public $action; // e.g., created, approved, rejected

    public function __construct($leaveRequest, $action)
    {
        $this->leaveRequest = $leaveRequest;
        $this->action = $action;
    }

    public function via($notifiable)
    {
        return ['database', 'broadcast']; // store + live push
    }

    public function toDatabase($notifiable)
    {
        return [
            'leave_request_id' => $this->leaveRequest->id,
            'type' => $this->action,
            'leave_type' => $this->leaveRequest->leaveType->name,
            'user' => $this->leaveRequest->user->name,
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage($this->toDatabase($notifiable));
    }
}
