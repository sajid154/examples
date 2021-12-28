<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\ClientList;
use DateTime;
use Carbon\Carbon;
use Mail;
use App\Mail\NotifyUserAboutExpiry;

class NotifyUserAboutPlanExpiry extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:notify_users_about_expiry';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will notify all the users about the expiry';

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
        $devices = ClientList::where('device_end_date', '>', now())->get();
        
        
        foreach($devices as $device){
            if($device->user != null){
                
                

            $start_date = strtotime($device->device_end_date);
            $end_date = strtotime(date('y-m-d h:i:s'));
            $interval = ($start_date - $end_date)/60/60/24;
            $interval = number_format((float)$interval, 0,'.', '');

                if($interval <= 8 && $interval >= 7){

                Mail::to($device->user->email)->send(new NotifyUserAboutExpiry($device->user, $device));  

                Mail::to('x.imran96@gmail.com')->send(new NotifyUserAboutExpiry($device->user, $device));   
                
                $this->info('Device id '. $device->id .' '. $device->user->email);
            
            }
          }
        }
    }
}
