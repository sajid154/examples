<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;

class UpdateUserMailStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:update_user_mail_status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will reset all user mail status';

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
        $users = User::where('is_email_sent', 1)->get();
        foreach($users as $user){
             $user->is_email_sent = 0;
             $user->save();

        }
        $this->info('All Users email status reset successfully..');


    }
}
