<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\ClientList;
use Auth;
use Carbon\Carbon;
use DB;

use Morrislaptop\Firestore\Factory;
use Kreait\Firebase\ServiceAccount;

class CheckExpiredUsersScheduler extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:CheckExpiredUsersScheduler';

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
     $today = Carbon::now()->format('Y-m-d');
        $user_device_data = ClientList::wheredate('device_end_date','<=', $today)->where('deleted',null)
        ->update(['expired'=>'Yes']);
            if($user_device_data == 1){
                    dump("Success");
            }dump("No Data Found");

    $expired_users = ClientList::wheredate('device_end_date','<=', $today)->where('deleted',null)->get();

    // dd(count($expired_users));

    foreach ($expired_users as $key => $value) {

        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__ . '/thewispy-6b883-ad4d94865c93.json');

        $firestore = (new Factory)
            ->withServiceAccount($serviceAccount)
            ->createFirestore();

            $collection = $firestore->collection('users');
            $user = $collection->document((!empty($value->uniqueid)?$value->uniqueid:"no"));

             $user->set([
                'expired' => 'Yes' ]);
             dump($value->id);
    }



    }
}
