<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Merchant extends Model
{
	use SoftDeletes;
    protected $table = 'tbl_merchant';
    protected $primaryKey = 'merchant_id';
    protected $fillable = [
 					    "user_id",
					    "business_name",
					    "owner_name",
					    "address",
					    "company_type",
					    "pan_number",
					    "number_of_employee",
					    "email",
					    "mobile",
					    "owner_mobile",
					    "status",
					    "description",
				    ];
	public function user()
	{
	    return $this->belongsTo('App\User', 'user_id', 'id');
	}			    
// 	public static function rules()
// {
//     return [
//         'sub_contractors_name' => 'required',
//         'sub_contractors_email_1' => 'required',
//     ];
// }
}
