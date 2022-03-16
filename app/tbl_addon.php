<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class tbl_addon extends Model
{
	use SoftDeletes;
    protected $table = "tbl_addon";
    protected $primaryKey = "addon_id";
    protected $fillable = [
 		 "title","price"
    ];
 
}