<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use Omnipay\Omnipay;
use App\DeviceSlots;
use Carbon\Carbon;


class AutoPayment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:autopayment';

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
     public $gateway;
    public function __construct()
    { 
        parent::__construct();
        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId(env('PAYPAL_CLIENT_ID'));
        $this->gateway->setSecret(env('PAYPAL_CLIENT_SECRET'));
        $this->gateway->setTestMode(true);  //set it to 'false' when go live
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
       dump("Process Starts");

      $today = Carbon::now()->format('Y-m-d');
  
  /* Update old slots*/ 

      DeviceSlots::
      whereDate( 'device_end_date','<', $today)
      ->where('payment_id',0)->update([
            'payment_id' => 2
        ]);

  /*get devices for payments*/

      $device_slots =  DeviceSlots::groupBy('device_id_d')
      ->where('payment_id',0)
      ->get();
      // dd($device_slots);
      
  /*send slots to setting devices*/
      payment_process($device_slots, $this->gateway);

    }


}
