<?php
		namespace App;
		use Illuminate\Database\Eloquent\Model;
		use Illuminate\Database\Eloquent\SoftDeletes;
		class tbl_room extends Model
		{
			use SoftDeletes;
		    protected $table = "tbl_room";
		    protected $primaryKey = "room_id";
		        // protected $dateFormat = 'Y-m-d';
		    protected $fillable = [
		 		 "room_number","room_price","status"
		    ];
		 
		}