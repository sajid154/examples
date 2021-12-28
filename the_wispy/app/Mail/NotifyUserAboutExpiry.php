<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyUserAboutExpiry extends Mailable
{
    use Queueable, SerializesModels;

    public $user = null;
    public $device = null;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $device)
    {
        $this->user = $user;
        $this->device = $device;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.expiry_notify', ['user'=>$this->user, 'expiry_date' => $this->device->device_end_date])->subject('Notification about plan expiry');
    }
}
