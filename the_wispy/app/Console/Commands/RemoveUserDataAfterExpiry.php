<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\ClientList;
use DB;
use Storage;

class RemoveUserDataAfterExpiry extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:remove_users_data_after_expiry';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will delete all users data which is expired and dosent subscribe new plan within 5 days..';

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

        $tab = [
            'smses',
            'record_audio',
            'record_screen',
            'record_video',
            'take_pictures',
            'user_applications',
            'user_calendars',
            'user_galleries',
            'user_location_details',
            'user_locations',
            'user_videos',
            'user_voices',
            'wifi_loggers',
            'calllog',
            'capture_screenshots',
            'contacts',
            // 'call_recordings',
            // 'instagram_sms',
            // 'whatsapp_sms',
            // 'gmail_emails',
            // 'user_keywords',
            // 'snapchat_sms',
            // 'geo_fences',
            'searched_keywords',
            // 'browser_histories',
            // 'incoming_user_call_blocks',
            // 'user_call_blocks',
            'take_pictures',
             

        ];


        $count =0;
        $devices = ClientList::select('id', 'device_end_date')->where('device_status','active')->where('deleted', null)->where('device_end_date', '<=', now()->subWeek())
        ->get();
        foreach($devices as $device){
            
            foreach ($tab as $key => $row) {
              
                $count =  DB::table($row)->where('device_id',$device->id)->count();
                
                if($count > 0){
                
                    DB::table($row)->where('device_id',$device->id)->delete();
                
                Storage::deleteDirectory('public/'.$row.'/'.$device->id);
                
                dump("Records Deleted of this Device($device->id) from $row .");
              
                }
            }   
            
            $device->deleted = "Yes";
            
            $device->save();
            
            $this->info('Device '. $device->id . '. Data removed successfully...');
            
       

        }
    }
}
