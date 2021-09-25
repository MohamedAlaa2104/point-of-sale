<?php

namespace App\Notifications;

use App\Models\Category;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CategoryNotification extends Notification
{
    use Queueable;

    /**
     * @var User
     */
    private $user;
    /**
     * @var Category
     */
    private $category;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, Category $category)
    {
        //
        $this->user = $user;

        $this->category = $category;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'userName'=>$this->user->name,
            'categoryId'=>$this->category->id,
            'categoryName'=>$this->category->translate('en')->name,
        ];
    }
}
