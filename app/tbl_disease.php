<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class tbl_disease extends Model
{
	use SoftDeletes;
    protected $table = 'tbl_disease';
    protected $primaryKey = "disease_id";
    protected $fillable = [
 		"title",
 	 	"status",
    ];
 //    public function parent_category()
	// {
	//     return $this->belongsTo('App\Category', 'parent_id', 'category_id');
	// }	

// 	public static function rules()
// {
//     return [
//         'sub_contractors_name' => 'required',
//         'sub_contractors_email_1' => 'required',
//     ];
// }
}
