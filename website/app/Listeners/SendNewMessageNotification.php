<?php

namespace App\Listeners;

use App\Events\MessageSent;
use App\Models\Notification;
use App\Models\User;
use App\Notifications\NewMessageNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;

class SendNewMessageNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(MessageSent $event): void
    {
        $user = $event->user;
//        if($user->id !== Auth::id()){
//
//            $user->notify(new NewMessageNotification($event->message, $event->user, $event->roomId));
//        }
        $notificationCount = $this->getNotificationCount($user);

        $this->sendNotification($user, $notificationCount);
    }

    /**
     * Lấy số lượng thông báo chưa đọc của người dùng
     *
     * @param  User  $user
     * @return int
     */
    private function getNotificationCount(User $user): int
    {
        return Notification::where('user_id', $user->id)
            ->whereNull('read_at')
            ->count();
    }

    /**
     * Gửi thông báo đến người dùng
     *
     * @param  User  $user
     * @param  int  $notificationCount
     * @return void
     */
    private function sendNotification(User $user,int $notificationCount) : void
    {
         $user->notify(new NewMessageNotification($notificationCount));
    }
}
