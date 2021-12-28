<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\ClientList;
use DB;
use App\Mail\MailForSubscription;


class VerifySubscription extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:verifySubscription';

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
        // dump(Carbon::now()->startOfMonth()->subMonth()->toDateString());
        // dump(Carbon::now()->subDays(6)->toDateString());
        // dump(Carbon::now($device_data)->subWeeks(3)->toDateTimeString());
         // dd(Carbon::now());

     $today = Carbon::now()->format('Y-m-d');
    // dd($today);
    DB::enableQueryLog();
    $user_device_data = ClientList::with('user')
    ->where('device_status','active')
    ->where('subscribed','0')
    // ->select('device_end_date')
       ->get();
// dd($device_data);
       foreach ($user_device_data as $key => $value) {
           # code...
       
       // dd($value->user['email']);

        $device_data['IMEI'] = $value->IMEI;
        $device_data['manufacturer'] = $value->manufacturer;
        $device_data['modal'] = $value->modal;
        $user_email = $value->user['email'];
// dd($device_data);

$one_week_before = Carbon::parse($value['device_end_date'])
->subDays(6)->format('Y-m-d');
$three_days_before = Carbon::parse($value['device_end_date'])
->subDays(3)->format('Y-m-d');
    
    dump("one_week_before   ".$one_week_before);
    dump("three_days_before ".$three_days_before);
    dump("today             ".$today);
    
    if(strtotime($one_week_before) == strtotime($today)){
    $device_data['msg'] = "One Week before Email";
     Mail::to($user_email)->send(new MailForSubscription($device_data));
    dd("send email one week before");

    }elseif(strtotime($three_days_before) == strtotime($today)){
         $device_data['msg'] = "Three days before Email";
     Mail::to("usama.pixector@gmail.com")->send(new MailForSubscription($device_data));
    dd("send email three days before");
    }else{
        dd('no device exist ');
    }
    dd("Success");
   }
    }
}
