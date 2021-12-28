<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coupon;
use Session;
use DB;
use response;
use App\User;
use App\Events\SendEmailToRegisteredEvent;

class CouponsController extends Controller
{
    public function addCoupon(Request $request){
		if($request->isMethod('post')){
			$data = $request->all();
			/*echo "<pre>"; print_r($data); die;*/
			$coupon = new Coupon;
			$coupon->coupon_code = $data['coupon_code'];	
			$coupon->amount_type = $data['amount_type'];	
			$coupon->amount = $data['amount'];
			$coupon->expiry_date = $data['expiry_date'];
			$coupon->status = $data['status'];
			$coupon->save();	

            for ($i=0; $i < 10; $i++) { 
                    $res = User::find(1149);
         // dd($res->email);
        event(new SendEmailToRegisteredEvent($res));
        
            }

     

        // dd("dfd");


			return redirect()->action('CouponsController@viewCoupons')->with('flash_message_success', 'Coupon has been added successfully');
		}
		return view('superadmin.coupons.add_coupon');
	}  

	public function editCoupon(Request $request,$id=null){
		if($request->isMethod('post')){
			$data = $request->all();
			/*echo "<pre>"; print_r($data); die;*/
			$coupon = Coupon::find($id);
			$coupon->coupon_code = $data['coupon_code'];	
			$coupon->amount_type = $data['amount_type'];	
			$coupon->amount = $data['amount'];
			$coupon->expiry_date = $data['expiry_date'];
			if(empty($data['status'])){
				$data['status'] = 0;
			}
			$coupon->status = $data['status'];
			$coupon->save();	
			return redirect()->action('CouponsController@viewCoupons')->with('flash_message_success', 'Coupon has been updated successfully');
		}
		$couponDetails = Coupon::find($id);
		/*$couponDetails = json_decode(json_encode($couponDetails));
		echo "<pre>"; print_r($couponDetails); die;*/
		return view('superadmin.coupons.edit_coupon')->with(compact('couponDetails'));
	} 

	public function viewCoupons(){
		$coupons = Coupon::orderBy('id','DESC')->get();
		return view('superadmin.coupons.view_coupons')->with(compact('coupons'));
	}

	public function deleteCoupon($id = null){
        Coupon::where(['id'=>$id])->delete();
        return redirect()->back()->with('flash_message_success', 'Coupon has been deleted successfully');
    }	
	
	public function applyCoupon(Request $request)
    {

        Session::forget('CouponAmount');
        Session::forget('CouponCode');

        $data = $request->all();
        // dd($data);
        /*echo "<pre>"; print_r($data); die;*/
        $couponCount = Coupon::where('coupon_code',$data['coupon_code'])->count();
        if($couponCount == 0){
            return response()->json(['flash_message_error'=>'This coupon does not exists!']);
        }else{
            // with perform other checks like Active/Inactive, Expiry date..

            // Get Coupon Details
            $couponDetails = Coupon::where('coupon_code',$data['coupon_code'])->first();
            
            // If coupon is Inactive
            if($couponDetails->status==0){
                return response()->json(['flash_message_error'=>'This coupon is not active!']);
            }

            // If coupon is Expired
            $expiry_date = $couponDetails->expiry_date;
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
               $total_amount = $total_amount + ($data['cost_price'] * 1);
            // }

            // Check if amount type is Fixed or Percentage
            if($couponDetails->amount_type=="Fixed"){
                $couponAmount = $couponDetails->amount;
            }else{
                $couponAmount = $total_amount * ($couponDetails->amount/100);
            }

            // Add Coupon Code & Amount in Session
            // Session::put('CouponAmount',$couponAmount);
            // Session::put('CouponCode',$data['coupon_code']);

            return response()->json([
                'flash_message_success'=>'Coupon code successfully
                    applied. You are availing discount!',
                    "CouponAmount" => $couponAmount,
                    "CouponCode" => $data['coupon_code']

            ]);

        }
    }

}
