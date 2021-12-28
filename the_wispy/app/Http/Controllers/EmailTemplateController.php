<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EmailTemplate;
use Session;
use DB;
use response;
use App\User;
use App\Events\SendEmailToRegisteredEvent;

class EmailTemplateController extends Controller
{
    public function addTemplate(Request $request){

        // dd(stripslashes($request->content));

		if($request->isMethod('post')){
			$data = $request->all();
			/*echo "<pre>"; print_r($data); die;*/
			$etemplates = new EmailTemplate;
			$etemplates->title = $data['title'];	
			$etemplates->content = $data['content'];	
			$etemplates->save();	

			return redirect()->action('EmailTemplateController@viewTemplates')->with('flash_message_success', 'Etemplate has been added successfully');
		}
		return view('superadmin.etemplates.add_etemplates');
	}  

	public function editTemplate(Request $request,$id=null){

        // dd(stripslashes($request->content));


        // dd($request->all());
		if($request->isMethod('post')){
			$data = $request->all();
			/*echo "<pre>"; print_r($data); die;*/
			$etemplates = EmailTemplate::find($id);
			$etemplates->title = $data['title'];	
			$etemplates->content =stripslashes($request->content);	

			
			$etemplates->save();	
			return redirect()->action('EmailTemplateController@viewTemplates')->with('flash_message_success', 'Etemplate has been updated successfully');
		}
		$templateDetails = EmailTemplate::find($id);
		/*$etemplatesDetails = json_decode(json_encode($etemplatesDetails));
		echo "<pre>"; print_r($etemplatesDetails); die;*/
		return view('superadmin.etemplates.edit_etemplates')->with(compact('templateDetails'));
	} 

	public function viewTemplates(){
		$etemplates = EmailTemplate::orderBy('id','DESC')->get();
		return view('superadmin.etemplates.view_etemplates')->with(compact('etemplates'));
	}

	public function deleteTemplate($id = null){
        EmailTemplate::where(['id'=>$id])->delete();
        return redirect()->back()->with('flash_message_success', 'Etemplate has been deleted successfully');
    }	
	
	public function applyTemplate(Request $request)
    {

        Session::forget('CouponAmount');
        Session::forget('CouponCode');

        $data = $request->all();
        /*echo "<pre>"; print_r($data); die;*/
        $etemplatesCount = EmailTemplate::where('coupon_code',$data['coupon_code'])->count();
        if($etemplatesCount == 0){
            return response()->json(['flash_message_error'=>'This coupon does not exists!']);
        }else{
            // with perform other checks like Active/Inactive, Expiry date..

            // Get Coupon Details
            $etemplatesDetails = EmailTemplate::where('coupon_code',$data['coupon_code'])->first();
            
            // If coupon is Inactive
            if($etemplatesDetails->status==0){
                return response()->json(['flash_message_error'=>'This coupon is not active!']);
            }

            // If coupon is Expired
            $expiry_date = $etemplatesDetails->expiry_date;
            $current_date = date('Y-m-d');
            if($expiry_date < $current_date){
                return response()->json(['flash_message_error'=>'This coupon is expired!']);
            }

            // Coupon is Valid for Discount

            // Get Cart Total Amount
            $session_id = Session::get('session_id');
            // $userCart = DB::table('cart')->where(['session_id' => $session_id])->get();
            $total_amount = 0;
            // foreach($userCart as $item){
               $total_amount = $total_amount + (20 * 2);
            // }

            // Check if amount type is Fixed or Percentage
            if($etemplatesDetails->amount_type=="Fixed"){
                $etemplatesAmount = $etemplatesDetails->amount;
            }else{
                $etemplatesAmount = $total_amount * ($etemplatesDetails->amount/100);
            }

            // Add Coupon Code & Amount in Session
            // Session::put('CouponAmount',$etemplatesAmount);
            // Session::put('CouponCode',$data['coupon_code']);

            return response()->json([
                'flash_message_success'=>'Coupon code successfully
                    applied. You are availing discount!',
                    "CouponAmount" => $etemplatesAmount,
                    "CouponCode" => $data['coupon_code']

            ]);

        }
    }

}
