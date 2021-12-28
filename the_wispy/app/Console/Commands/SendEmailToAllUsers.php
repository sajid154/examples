<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use Mail;
use App\Mail\SendNewUpdateEmail;


class SendEmailToAllUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:sendmailtoall';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This cammand will notify all users about the new updates and features';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
            $users = User::where('is_email_sent', 0)->get();
                foreach($users as $user){
                    Mail::to($user->email)->queue(new SendNewUpdateEmail());
                    $user->is_email_sent = 1;
                    $user->save();
                    $this->info('Email Sent to '. $user->email);   
               
                }
    }
}

