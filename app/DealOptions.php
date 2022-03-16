<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DealOptions extends Model
{
	use SoftDeletes;
    protected $table = 'tbl_deals_options';
    protected $primaryKey = "option_id";
    protected $fillable = [
 		"title",
 		"price",
 		"actual_price",
 		"discount",
 		"sr_no",	
 		"deal_id",
    ];
	public function getDeal()
	{
	    return $this->belongsTo('App\Deals', 'deal_id', 'deal_id');
	}
	public function getMerchant()			 
	{
	    return $this->belongsTo('App\Merchant', 'merchant_id', 'merchant_id');
	}   
	public function getCategory()			 
	{
	    return $this->belongsTo('App\Category', 'category_id', 'category_id');
	}   
}
