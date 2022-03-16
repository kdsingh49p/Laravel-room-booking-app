<?php

namespace App;
 
use Illuminate\Database\Eloquent\Model;
        use Illuminate\Database\Eloquent\SoftDeletes;

class tbl_room_booking_detail extends Model
{
    use SoftDeletes;
 
    protected $table = 'tbl_room_booking_detail';
    protected $primaryKey = 'room_booking_id';
    protected $fillable = [
         "room_number",	
         "room_id",
         "book_date",
         "room_price",
         "patient_id",
         "booking_id",
         "book_date2",
         "extra_bed",
         "extra_bed_price",
         "extra_bed_qty",
 				    ];

public function get_patient()
    {
        return $this->belongsTo('App\tbl_patient', 'patient_id', 'patient_id');
    }   


public function get_booking()
    {
        return $this->belongsTo('App\tbl_booking', 'booking_id', 'booking_id');
    }   

      


}
