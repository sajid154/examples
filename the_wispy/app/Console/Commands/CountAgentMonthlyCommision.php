<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Role;
use App\User;
use Carbon\Carbon;
use App\AgentCommision;
use App\AgentDetails;

class CountAgentMonthlyCommision extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:count_agent_monthly_commission';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will count the user monthly commission';

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
        
        $role = Role::where('name', 'Agent')->first();

         $users = $role->users;

            foreach($users as $user){

                 $customers = User::where('ref_code', $user->agent_details->reference_code)
                 ->whereBetween('created_at', 
                    [
                        Carbon::now()->startOfMonth()->subMonth()->toDateTimeString(),
                        Carbon::now()->endOfMonth()->subMonth()->toDateTimeString()])
                 ->get();
                 
                        $totalCustomers = count($customers); 
                        $ratio = null;
                         $lastMonthCommision = 0;


                        if($totalCustomers > 0 && $totalCustomers < 100) {
                                    $ratio = 40;

                        }else if($totalCustomers >= 100 && $totalCustomers < 200){
                                    $ratio = 45;
                        }else if($totalCustomers >= 200){
                                    $ratio = 50;
                        }

                    foreach($customers as $customer){

                            $countComision = ($ratio/100) * $customer->plans()->first()->cost_price;
                            $lastMonthCommision += (float)$countComision;

                    }
 
                   
                    AgentCommision::create([
                            "agent_id" => $user->id,
                            "amount" => $lastMonthCommision,
                            "customers" => $totalCustomers,
                            "percentage_ratio" => $ratio,
                            "month" => date('M-Y', strtotime(Carbon::now()->startOfMonth()->subMonth()->toDateTimeString())),
                            "status" => 0
                    ]);


                    $this->info("Agent ". $user->name . " you have earn ". $lastMonthCommision . " commission in " . date('M-Y', strtotime(Carbon::now()->startOfMonth()->subMonth()->toDateTimeString())));

   
            }

        }
}


