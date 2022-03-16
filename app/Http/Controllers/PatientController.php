<?php
namespace App\Http\Controllers;
use App\tbl_patient;
use App\tbl_room;
use App\tbl_booking;
use App\tbl_company;
use App\tbl_mode_of_payment;
use App\tbl_room_booking_detail;
use App\tbl_daily_collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PatientController extends Controller
{
   

 
    public function index()
    {
        $patient = tbl_patient::orderBy("created_at", "DESC")->paginate(10);
        return view("patient.patient_list", compact("patient"));
    }
    public function checkvalidation(Request $request){
         $requestData = $request->all();
         $patientModel = tbl_patient::where("patient_reg_no", $requestData["patient_reg_no"])->first();

        if($patientModel){
            return ["status" => false];
        } else{
            return ["status" => true];
        }
     }
  	 public function search(Request $request){
        $search =  $request->all();
        if(is_array($search) && sizeof($search)){
            $query = tbl_patient::orderBy("created_at", "DESC");
            foreach($search as $key => $attr){
                if($key=="search" && $key!="" && $attr!=""){
                  $query->where(function ($query) use ($attr, $search) {
                    $query->orWhere("patient_reg_no", "like" , "%".$attr."%");
                    $query->orWhere("patient_name", "like" , "%".$attr."%");
                    $query->orWhere("patient_phone", "like" , "%".$attr."%");
                    $query->orWhere("patient_email", "like" , "%".$attr."%");
                    $query->orWhere("patient_address", "like" , "%".$attr."%");
                    $query->orWhere("checkin", "like" , "%".$attr."%");
                    $query->orWhere("checkout", "like" , "%".$attr."%");
                    $query->orWhere("room_id", "like" , "%".$attr."%");
			 			      });
                }
            }
          $patient =   $query->paginate(10);
            return view("patient.patient_row", compact("patient"))->render();
        }
    }

    public function create(Request $request)
    {
        $requestData = $request->all();
        $mode_of_payment = tbl_mode_of_payment::get();
        $companies = tbl_company::get();

        $lastAdmRecord = tbl_booking::orderBy('booking_id', 'DESC')->first();
        $new_receipt_id = "";
        if($lastAdmRecord){
            $booking_id = explode("-",$lastAdmRecord->receipt_no);
            if(isset($booking_id[1])){

            }else{
              $booking_id[1] = "001";
            }
            $new_receipt_id = "DSEH-".str_pad($booking_id[1]+1, 3, '0', STR_PAD_LEFT);
          }else{
            $new_receipt_id = "DSEH-"."001"; 
          }
         return view("patient.patient_create", compact('mode_of_payment', 'new_receipt_id', 'companies'));
    }
    public function store(Request $request)
    {
       
        $requestData = $request->all();
         
	    //code start for validation
        // $patientModel = tbl_booking::where("patient_reg_no", $requestData["patient_reg_no"])
        //                          ->first();
        // if($patientModel){
        //     return [
        //         "status" => "validate",
        //         "message" => "This entry already exists "
        //        ];
        //     exit;
        // }
       

      $patient  = new tbl_patient();
      $patient->patient_name      = $requestData['patient_name'];
      $patient->patient_phone     = $requestData['patient_phone'];
      $patient->patient_age       = $requestData['patient_age'];
      $patient->patient_gender    = $requestData['patient_gender'];
      $patient->ipd_no            = $requestData['ipd_no'];
      $patient->admission_date    = $requestData['admission_date'];
      $patient->adhar_no          = $requestData['adhar_no'];
      $patient->checkin           = $requestData['checkin'];
      $patient->checkout          = $requestData['checkout'];

      $patient->save();
    	
        if($patient){
   
            //save booking
             $bookingArr = [
              "patient_reg_no" => $requestData['patient_reg_no'],
              "patient_id" => $patient->patient_id,
              "total_amt" => $requestData['total_amt'],
              "payable_amt" => $requestData['payable_amt'],
              "mode_of_payment_id" => $requestData['mode_of_payment_id'],
              "company_id" => $requestData['company_id'],
              "complimentory_reason" => $requestData['complimentory_reason'],
              "advance_paid" => $requestData['advance_paid'],
              "discount" => $requestData['discount'],
              "balance_amount" => $requestData['balance_amount'],
              "receipt_no" => $requestData['receipt_no'],
            ];
            $bookingSave = tbl_booking::create($bookingArr); 
            if($requestData['advance_paid']!=0 && $requestData['advance_paid']!=""){
              //store in daily collection
              $daily_collection_model             = new tbl_daily_collection();
              $daily_collection_model->booking_id = $bookingSave->booking_id;
              $daily_collection_model->amount     = $requestData['advance_paid'];
              $daily_collection_model->collection_date     = date('Y-m-d');
              $daily_collection_model->save();
              //store in daily collection
              
            }

            //save room
            if (is_array($requestData['room_number']) && sizeof($requestData['room_number']) ) {
                foreach ($requestData['room_number'] as $key => $room_number) {
                    $book_date_ = explode('/', $requestData['book_date'][$key]);
                    // $book_date2 = $book_date_[2].'-'.$book_date_[1].'-'.$book_date_[0];

                    $room_id_detail = tbl_room::where('room_number', $requestData['room_number'][$key])->first();
                     $roonArr = 
                    [
                        "room_id" => $room_id_detail->room_id,
                        "room_number" => $requestData['room_number'][$key], 
                        "book_date" => $requestData['book_date'][$key],
                        "book_date2" => $requestData['book_date'][$key],
                         "room_price" => $requestData['room_price'][$key],
                         // "break_fast" => $requestData['break_fast'][$key],
                         "patient_id" => $patient->patient_id,
                         "booking_id" => $bookingSave->booking_id,

                         "extra_bed" => $requestData['extra_bed'][$key] ?? 'off',
                         "extra_bed_price" => $requestData['extra_bed_price'][$key],
                         "extra_bed_qty" => $requestData['extra_bed_qty'][$key],
                 ];
                 tbl_room_booking_detail::create($roonArr);
                }                
            }
            
            

            






            return [
            "status" => "success",
            "save_data" => $patient
           ];
        }
    }
    public function show($id)
    {
        $patient = tbl_patient::find($id);
        return view("patient.patient_show", compact("patient"))->render();
    }

    
    public function activeinactive($id){
        $patient = tbl_patient::where("patient_id",$id)
                     ->first();
        if($patient->status==1){
            $patient->status=0;
        }else{
            $patient->status=1;
        }
        $patient->save();
    }
    public function update(Request $request, $id)
    {   
        $patient = tbl_patient::where("patient_id", $id)
                                    ->first();
        if($request->ajax()){
            return [
                "status" => "found",
                "data" => $patient
            ];
        }
        return view("patient.patient_update", compact("patient"))->render();
 
     }

    public function edit(Request $request, $id)
    {
       $requestData = $request->all();
  	   //code start for validation
  	   $patientModel = tbl_patient::where("patient_reg_no", $requestData["patient_reg_no"])
	                                 ->where("patient_id", "!=", $id)
	                                ->first();
       if($patientModel){
	        return [
	            "status" => "validate",
	            "message" => "This entry already exists "
	           ];
	        exit;
       }
       //code end for validation
	       $patient = tbl_patient::where("patient_id",$id)->first();
        $patient->patient_reg_no = $requestData["patient_reg_no"];
 		     $patient->patient_name = $requestData["patient_name"];
 		     $patient->patient_phone = $requestData["patient_phone"];
 		     $patient->patient_age = $requestData["patient_age"];
 		     $patient->patient_gender = $requestData["patient_gender"];
 		     $patient->ipd_no = $requestData["ipd_no"];
         $patient->adhar_no = $requestData["adhar_no"];
  		 
        if($patient->save()){
            return [
            "status" => "success",
            "save_data" => $patient,
           ];
        }
    }
    public function destroy($id, Request $request)
    {
        
            $delete = tbl_patient::find($id);
            $delete->delete();
            if($delete->trashed()){
                return ["status" => "success"];
           }
    }
}