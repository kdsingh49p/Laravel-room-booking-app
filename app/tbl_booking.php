<?php

namespace App;
 
use Illuminate\Database\Eloquent\Model;
 
class tbl_booking extends Model
{
 
    protected $table = 'tbl_booking';
    protected $primaryKey = 'booking_id';
    protected $fillable = [
        "patient_id",
        "total_amt",
        "refund_amount",
            "payable_amt",
            "mode_of_payment_id",
            "company_id",
            "advance_paid",
            "discount",
            "balance_amount",
            "receipt_no",
            "is_discharged",
            "complimentory_reason",
            "final_payment",
            "patient_reg_no"
 				    ];
 	public function get_patient()
	{
	    return $this->belongsTo('App\tbl_patient', 'patient_id', 'patient_id');
	}
    public function get_company()
    {
        return $this->belongsTo('App\tbl_company', 'company_id', 'company_id');
    }	
    public function get_mode_of_payment()
    {
        return $this->belongsTo('App\tbl_mode_of_payment', 'mode_of_payment_id', 'mode_of_payment_id');
    }   

	public function get_rooms()
	{
	    return $this->hasMany('App\tbl_room_booking_detail', 'booking_id', 'booking_id');
	}	

}
