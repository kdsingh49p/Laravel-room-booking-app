<?php

namespace App;
use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class tbl_daily_collection extends Authenticatable
{
	use Notifiable;
    protected $table = 'tbl_daily_collection';
    protected $primaryKey = 'id';
    public function get_booking()
	{
	    return $this->belongsTo('App\tbl_booking', 'booking_id', 'booking_id');
	}	
}
