<?php

namespace App;
use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class tbl_event extends Authenticatable
{
	    use Notifiable;

    protected $table = 'tbl_event';
    protected $primaryKey = 'event_id';
    protected $fillable = [
        "event_photo",
        "event_start",
        "event_start_time",
        "event_end",
        "event_end_time",
        "fb",
        "phone",
        "event_title",
        "event_details",
        "artist_name",
        "place_name",
        "place_address",
        "map",
        "slug",
        "price",
        "actual_price",
        "person_type",
 				    ];

}
