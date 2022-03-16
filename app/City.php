<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
	use SoftDeletes;
    protected $table = 'city';
    protected $primaryKey = "id";
    protected $fillable = [
 		
 		"id",
 		"title",
 		"slug",
    ];


}
