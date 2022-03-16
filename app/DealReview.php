<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DealReview extends Model
{
	use SoftDeletes;
    protected $table = 'tbl_deal_review';
    protected $primaryKey = "review_id";
    protected $fillable = [
 		"name",
 		"email",
 		"deal_id",
 		"review",
 		"rating",
 		"status"
    ];
    public function getDeal()			 
	{
	    return $this->hasOne('App\Deals', 'deal_id', 'deal_id');
	}
}
