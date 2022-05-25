<?php

namespace App\Listeners;

use App\Event\FeedbackCreated;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendEmail implements ShouldQueue
{
    public $delay = 3;

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
     * @param  \App\Event\FeedbackCreated  $event
     * @return void
     */
    public function handle(FeedbackCreated $event)
    {
        $manager = User::whereHas('roles', function($q){
            $q->where('slug', 'manager');
        })->first();

        Mail::send('mail.feedback_create', ['data' => $event->feedback], function($message) use ($manager) {
            $message->to($manager->email, $manager->name);
            $message->from('admin@gmail.com', 'Admin');
            $message->subject(__('Feedback'));
        });

    }
}
