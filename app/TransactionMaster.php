<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionMaster extends Model
{
	// use SoftDeletes;
    protected $table = 'transaction_master';
    protected $primaryKey = "txnid";
    protected $fillable = [
  		 
  		 'amount',
  		 'productinfo',
  		 'firstname',
  		 'email',
  		 'phone',
  		 'hash',
  		 'payuMoneyId',
  		 'mode',
  		 'status',
   		 'user_id'
    ];
	public function user()
	{
	    return $this->belongsTo('App\User', 'user_id', 'id');
	}
	public function getMerchant()			 
	{
	    return $this->belongsTo('App\Merchant', 'merchant_id', 'merchant_id');
	}   
	public function getCategory()			 
	{
	    return $this->belongsTo('App\Category', 'category_id', 'category_id');
	} 
	public function getCity()			 
	{
	    return $this->belongsTo('App\City', 'bill_city_id', 'id');
	}   
	public function getDealOptions()			 
	{
	    return $this->hasMany('App\DealOptions', 'deal_option_id', 'deal_id');
	}   
	public function getDeal()			 
	{
	    return $this->hasMany('App\Deals', 'deal_id', 'deal_id');
	}
	public function getPurchase()			 
	{
	    return $this->belongsTo('App\Purchase', 'txnid', 'transaction_id');
	}   
// 	public static function rules()
// {
//     return [
//         'sub_contractors_name' => 'required',
//         'sub_contractors_email_1' => 'required',
//     ];
// }
}
