<?php
namespace App\Http\Controllers\Reports;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Payment;
use App\Plan;
use DataTables;
use DB;
use Auth;
use Session;
use App\Events\SendEmailToUsersZEvent;

use App\UserEmails;
class ReportByAllUsersControllers extends Controller
{
    public function index()
    {
        // dd("As");
        $postsQuery = User::all();
        $plans = Plan::all();
        //$posts = $postsQuery->select('*');
        $user_paid = Payment::select('user_id as user')->where('payment_id','!=', 'free')->get();
        return view('superadmin.reports.report_by_all_users', compact('user_paid','postsQuery','plans'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function default(Request $request)
    {
        // dd($request->all());

        // $postsQuery = User::query();
        // // dd($postsQuery);
        $start_date = (!empty($_GET["start_date"])) ? ($_GET["start_date"]) : ('');
        $end_date = (!empty($_GET["end_date"])) ? ($_GET["end_date"]) : ('');
        $user_type = $request->user_type;
        $plan_type = $request->plan_type;
  // dump($user_type);
  // dd($plan_type);
        if($user_type == 'active_paid_user'){
            $status = 'active';
        }
        elseif($user_type == 'inactive_paid_user'){
            $status = 'inactive';
        }else
        $status = '';


        DB::enableQueryLog();



        $reg_users = DB::select("SELECT user_id as user FROM payments group By payments.user_id");
        // dd($reg_users);
        $user_count = array();
          foreach ($reg_users as $reg_user){
                $user_count[] = $reg_user->user;
            }

            // dd($user_count);
        $data = DB::table('users') 
            ->select('users.id','users.name','users.email','users.created_at','users.email_verified_at','users.country_state_city','plans.title','payments.payment_id','users.last_login_at')
        
            ->when($user_type == 'free_user', function ($query, $role)  use($user_count){
                    $query->whereNotIn('users.id', $user_count );

            })
                    
             ->when($user_type == 'active_paid_user' or $user_type == 'inactive_paid_user', function ($query, $role) use ($status) {

                $query->join('clientlist', function($join) use ($status){
                    $join->on('clientlist.user_id','users.id');
                    $join->whereRaw("clientlist.id IN (SELECT Max(clientlist.id) as max_id FROM clientlist group By clientlist.user_id)")
                    ->where('clientlist.device_status',$status)
                    ->where('clientlist.payment_id','<>','null');  
                });
                // ->leftjoin('plans','plans.id','payments.plan_id')
                // $query->join('clientlist','clientlist.user_id','users.id')
                
                 // ->where('payments.payer_id', '!=' ,'trail');

            })  

        ->when($plan_type !='all', function ($query, $role) use ($plan_type) {

                $query->join('clientlist', function($join) use ($plan_type) {
                    $join->on('clientlist.user_id','users.id');
                    $join->whereRaw("clientlist.id IN (SELECT Max(clientlist.id) as max_id FROM clientlist group By clientlist.user_id)")
                    ->where('clientlist.plan_id', $plan_type)
                    ->where('clientlist.payment_id','<>','null');  
                });
                // ->leftjoin('plans','plans.id','payments.plan_id')
                // $query->join('clientlist','clientlist.user_id','users.id')
                
                 // ->where('payments.payer_id', '!=' ,'trail');
            })  

            ->when($user_type == 'paid_user', function ($query, $role) {

                $query->join('payments', function($join){

                    $join->on('payments.user_id','users.id');
                    $join->whereRaw("payments.id IN (SELECT Max(payments.id) as max_id FROM payments group By payments.user_id)");  
                })->leftjoin('plans','plans.id','payments.plan_id')
                 ->where('payments.payer_id', '!=' ,'trail');


            }, function ($query) {
                return     $query->leftjoin('payments', function($join){

                    $join->on('payments.user_id','users.id');
                    $join->whereRaw("payments.id IN (SELECT Max(payments.id) as max_id FROM payments group By payments.user_id)");  
                })->leftjoin('plans','plans.id','payments.plan_id')
                ->groupBy('payments.user_id')
                ->groupBy('users.id');

            })

            ->when($start_date && $end_date, function ($query) use ($start_date ,$end_date){
                $query->whereDate('users.created_at', '>=' ,$start_date )
                ->whereDate('users.created_at', '<=' ,$end_date );
            })

        ->orderBy('users.created_at','desc')
        ->get();

        for ($i=0; $i < count($data); $i++) { 
            
            // $res = UserEmails::where('email',$data[$i]->email)->where('user_id', $data[$i]->id)->get();
            // if(sizeof($res) < 1){
            event(new SendEmailToUsersZEvent($data[$i]));
            UserEmails::create(['email' =>$data[$i]->email, 'template' => 123, 'user_id'=>$data[$i]->id ]);  
            // }

        }
// dd("dfd");
        return datatables()->of($data)
     
        ->escapeColumns([])
            ->make(true);
        // }
    }
    public function datefilter(Request $request){
        $postsQuery = User::query();
        $start_date = (!empty($_GET["start_date"])) ? ($_GET["start_date"]) : ('');
        $end_date = (!empty($_GET["end_date"])) ? ($_GET["end_date"]) : ('');
        if($start_date && $end_date){
            $start_date = date('Y-m-d', strtotime($start_date));
            $end_date = date('Y-m-d', strtotime($end_date));
            $postsQuery->whereRaw("date(users.created_at) >= '" . $start_date . "' AND date(users.created_at) <= '" . $end_date . "'");
        }
        $posts = $postsQuery->select('*');
        return datatables()->of($posts)
            ->make(true);
    }
    public function auto_login_user($id){
            // return $id;

        // dd(Auth::user()->roles);

        Session::put('device_id', $id);
        // Auth::guard('admin')->login($user);
        // $user = User::find($id);
        // $res = Auth::login($user, true);
        // dd($user);
        return response()->json(['success' => true ], 200);
    }

        public function demo_login_user(){

        $user = User::find(19);
        $res = Auth::login($user, true);
        return response()->json(['success' => true ], 200);
    }
    
}