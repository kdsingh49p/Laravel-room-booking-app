<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BusinessType extends Model
{
	use SoftDeletes;
    protected $table = 'tbl_business_types';
    protected $primaryKey = 'business_type_id';
    protected $fillable = [
						"title",
				    ];
				    
}
