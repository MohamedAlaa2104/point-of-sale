<?php

namespace App\Listeners;

use App\Events\CategoryCreated;
use App\Models\User;
use App\Notifications\CategoryNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class NotifyAdminAboutCategory
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CategoryCreated  $event
     * @return void
     */
    public function handle(CategoryCreated $event)
    {
        $users = User::role('Super Admin')->get();

        Notification::send($users, new CategoryNotification($event->user, $event->category));
    }
}
