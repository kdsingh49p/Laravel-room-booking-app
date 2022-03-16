<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Purchase extends Model
{
	// use SoftDeletes;
    protected $table = 'tbl_purchase';
    protected $primaryKey = "purchase_id";
    protected $fillable = [
 		 "deal_id",
 		 "deal_option_id",
 		 "customer_id",
 		 "deal_status",
  		 "invoice_url",
 		 "price",
 		 "redeem_code",
 		 "is_redeem",
 		 "bill_person_name",
		  "bill_address",
		  "bill_email",
 		 "bill_mobile",
 		 "payment_method",
 		 "bill_city_id",
		  "transaction_id",
		  "event_id",
		  "event_qty",
		  "event_price",
		  "product_type",
		  "merchant_id",
    ];
	public function user()
	{
	    return $this->belongsTo('App\User', 'customer_id', 'id');
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
	public function getDealOption()			 
	{
	    return $this->belongsTo('App\DealOptions', 'deal_option_id', 'option_id');
	}   
	public function getDeal()			 
	{
	    return $this->hasOne('App\Deals', 'deal_id', 'deal_id');
	}
	public function getEvent()			 
	{
	    return $this->hasOne('App\tbl_event', 'event_id', 'event_id');
	}
	
	public function getTransactionDetail()			 
	{
	    return $this->belongsTo('App\TransactionMaster', 'transaction_id', 'txnid');
	}   
// 	public static function rules()
// {
//     return [
//         'sub_contractors_name' => 'required',
//         'sub_contractors_email_1' => 'required',
//     ];
// }
}
