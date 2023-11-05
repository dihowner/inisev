<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\SubscribedUserNotify;
use Illuminate\Support\Facades\Mail;
use App\Notifications\NotifySubscribers;
use App\Jobs\SendSubscribersNotification;
use Illuminate\Support\Facades\Notification;

class SubscribedUserNotifyController extends Controller
{
    public function notifyUnnotifiedUser() {
        $unNotifiedUsers = SubscribedUserNotify::with(['user', 'post', 'website'])->where(['status' => 'new'])->take(5)->get();

        if($unNotifiedUsers != NULL) {
            foreach($unNotifiedUsers as $notifyUser) {
                $user = $notifyUser->user;
                $post = $notifyUser->post;
                $user->notify(new NotifySubscribers($user, $notifyUser->website, $post));
                self::updateNotifier($user->id, $post->id);
            }
        }

        return 'Notification sent';
        
    }

    private function updateNotifier($userId, $postId) {
        return SubscribedUserNotify::where(['subscriber_id' => $userId, 'post_id' => $postId])->update(['status' => 'sent']);
    }
}
