<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Deals extends Model
{
	use SoftDeletes;
    protected $table = 'tbl_deals';
    protected $primaryKey = "deal_id";
    protected $fillable = [
 		
 		"title",
 		"min_actual_price",
 		"description",
 		"meta_description",
 		"total_deals",
 		"pending_deals",
 		"is_featured",
 		"discount",
 		"min_price",
 		"tags",
 		"img_1",
 		"img_2",
 		"img_3",
 		"img_4",
 		"address",
 		"merchant_id",
 		"city_id",
 		"category_id",
 		"slug",
 		"user_id",
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
	    return $this->belongsTo('App\City', 'city_id', 'id');
	}   
	public function getDealOptions()			 
	{
	    return $this->hasMany('App\DealOptions', 'deal_id', 'deal_id');
	}   
	public function purchase(){
		return $this->hasMany('App\DealOptions', 'deal_id', 'deal_id');
	}
// 	public static function rules()
// {
//     return [
//         'sub_contractors_name' => 'required',
//         'sub_contractors_email_1' => 'required',
//     ];
// }
}
