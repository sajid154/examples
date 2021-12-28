<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\ClientList;
use App\Calllog;
use App\Contact;
use App\Location;
use App\LocationDetail;
use App\SMS;
use App\UserApplication;
use App\UserCalendars;
use App\WifiLogger;
use App\UserGallery;
use Auth;
use Carbon\Carbon;
use DB;

use Morrislaptop\Firestore\Factory;
use Kreait\Firebase\ServiceAccount;
use Storage;
class RemoveExpiredFilesScheduler extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:RemoveExpiredFilesScheduler {device_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
    
    $device_id = $this->argument('device_id');
        // dd($device_id);
     $today = Carbon::now()->subMonth()->format('Y-m-d');


// dd(DB::getQueryLog());
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
        'call_recordings'
    ];
   
    if($device_id == "{device_id}"){
         dd("Commands");
        $expired_users = 
    ClientList::select('id','device_end_date')->where('device_status','active')->where('deleted',null)->where('device_end_date', '<=', now()->subMonth())
        ->get();
    // dd($expired_users);
        $bar = $this->output->createProgressBar(count($expired_users));

        for ($i=0; $i < count($expired_users) ; $i++) { 
                $bar->advance();
                dump($expired_users[$i]->id.'|'.$expired_users[$i]->device_end_date);

                foreach ($tab as $key => $row) {

                    DB::table($row)->where('device_id',$expired_users[$i]->id)->delete();
              
                    ClientList::where('id',$expired_users[$i]->id)->where('deleted',null)
                   
                    ->update(['deleted'=>'Yes']);

                    Storage::deleteDirectory('public/'.$row.'/'.$expired_users[$i]->id);
                }
            }

        $bar->finish();
        }

        else{
            //echo $device_id;
            //dd("else");
           foreach ($tab as $key => $row) {

                DB::table($row)->where('device_id',$device_id)->delete();
                Storage::deleteDirectory('public/'.$row.'/'.$device_id);
                dump("Records Deleted of this Device($device_id) from $row .");
            }   
    }


    }
}
