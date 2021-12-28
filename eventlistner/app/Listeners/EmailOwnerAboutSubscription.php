<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\UserSubscribedEmail;
use App\Mail\UserSub;
use DB;
use Mail;
class EmailOwnerAboutSubscription
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
     * @param  object  $event
     * @return void
     */
    public function handle(UserSubscribedEmail $event)
    {
        DB::table('newsletter')->insert(['email'=>$event->email]);
        Mail::to($event->email)->send(new UserSub());
    }
}
