<?php

namespace App\Listeners;

use App\Mail\SendEmailToUsersEmail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use App\EmailTemplate;
class SendEmailToUsersListener implements ShouldQueue
{


    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $data = EmailTemplate::find(1);
        Mail::to($event->data->email)->send(new SendEmailToUsersEmail($data));
    }
}
