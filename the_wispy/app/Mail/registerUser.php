<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class registerUser extends Mailable
{
    use Queueable, SerializesModels;
    public $data_user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data_user)
    {
        $this->data_user = $data_user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // mail is the view..
        return $this->view('user.register_user_mail')->subject('New User Registration  - TheWiSpy');
    }
}
