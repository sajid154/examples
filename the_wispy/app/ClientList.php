<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientList extends Model
{
	// public $timestamps = false;
    protected $table = "clientlist";
	protected $fillable = [
        'number','id', 'IMEI','manufacturer','user_id','modal','uniqueid','lastseen','last_sync','plan_id','payment_id','device_status','battery_level','network_carrier','device_start_date','device_end_date','device_expiration_date','subscribed','card_number_I','card_number_II','card_number_III','cvv','current_wifi','card_expire_month','card_expire_year','device_token','child_age','child_name','android_os','apk_version','plug_status','is_done','payer_name','card_details','expired','device_location_status','isAccessibilityServiceOn'
    ];
	public function user()
	{
		return $this->belongsTo('App\User');
	}
	public function calllog()
	{
		return $this->belongsTo('\App\Calllog','device_id');
	}
	
	public function sms()
	{
		return $this->belongsTo('\App\SMS','device_id');
	}
	public function clientlist_plans()
	{
		return $this->hasMany('App\ClientListPlans','clientlist_id');
	}
		public function plans(){
		return $this->belongsTo(Plan::class,'plan_id');
	}

	public function payments(){
		return $this->belongsTo(Payment::class,'payment_id');
	}

	public function call_blocks()
	{
		return $this->hasMany('App\UserCallBlock','device_id');
	}

	public function whatsapp_sms()
	{
		return $this->hasMany('App\WhatsappSms','device_id');
	}


    public function incoming_call_blocks()
    {
    	return $this->hasMany('App\IncomingUserCallBlock', 'device_id');
    }

    public function data_status()
    {
    	return $this->hasOne('App\ClientDataStatus', 'device_id');
    }

    public function keywords()
    {
    	return $this->hasMany('App\UserKeyword', 'device_id');
    }

    public function searched_keywords()
    {
    	return $this->hasMany('App\SearchedKeyword', 'device_id');
    }

	public function viber_sms()
	{
		return $this->hasMany('App\ViberSms','device_id');
	}

	public function instagram_sms()
	{
		return $this->hasMany('App\InstagramSms','device_id');
	}

	public function geo_fences()
	{
		return $this->hasMany('App\GeoFence','device_id');
	}


	public function geo_fences_breach()
	{
		return $this->hasMany('App\UserGeoFenceStatus','device_id');
	}
	public function gmail_emails()
	{
		return $this->hasMany('App\GmailEmail','device_id');
	}
	public function messanger_messages()
	{
		return $this->hasMany('App\FacebookMessage','device_id');
	}
	public function snapchat_messages()
	{
		return $this->hasMany('App\SnapchatSms','device_id');
	}

	public function imo_sms()
	{
		return $this->hasMany('App\ImoSms','device_id');
	}
	public function tender_sms()
	{
		return $this->hasMany('App\TenderSms','device_id');
	}



}
