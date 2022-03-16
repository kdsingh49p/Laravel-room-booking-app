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
		 "discount",	
		 "sr_no",	
 		"deal_id",
    ];
	public function getDeal()
	{
	    return $this->belongsTo('App\Deals', 'deal_id', 'deal_id');
	}	

}
