<?php
namespace App\Http\Controllers;
use App\tbl_patient;
use App\tbl_room;
use App\tbl_booking;
use App\tbl_room_booking_detail;
use App\tbl_mode_of_payment;
use App\tbl_company;
use App\tbl_daily_collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use PDF;
use DOMPDF;
class BookingController extends Controller
{
    public function getDetails(Request $request){
      $requestData = $request->all();
      $phone = $requestData['phone'];
      $bookingDetails = tbl_patient::where('patient_phone', $phone)->orderBy("created_at", "DESC")->first();
      if($bookingDetails){
        return ['status' => 'success', 'data' => $bookingDetails];
      }else{
        return ['status' => 'no_data'];
      }
    }
    public function checkvalidation(Request $request){
         $requestData = $request->all();
         $guestModel = tbl_patient::where("patient_reg_no", $requestData["patient_reg_no"])->first();

        if($guestModel){
            return ["status" => false];
        } else{
            return ["status" => true];
        }
     }
    public function index()
    {
        $booking = tbl_booking::orderBy("created_at", "DESC")->paginate(5000);
        return view("booking.booking_list", compact("booking"));
    }

    public function room_report()
    {
        // $booking = tbl_room_booking_detail::orderBy("created_at", "DESC")->where('status', '1')->paginate(5000);
        $daily_collection  = tbl_daily_collection::orderBy("created_at", "DESC")->paginate(5000);
        return view("booking.room_report", compact("daily_collection"));
    }
    public function room_report_search(Request $request){
        $search =  $request->all();
        if(is_array($search) && sizeof($search)){
            $query = tbl_daily_collection::orderBy("created_at", "DESC");
       
           if( $search['from_date']!="" && $search['to_date']=="" ){
               $query = $query->where('collection_date', "=", date('Y-m-d', strtotime($search['from_date'])));
            }
          if($search['from_date']!="" && $search['to_date']!=""){
              $query = $query->where('collection_date','>=', date('Y-m-d', strtotime($search['from_date'])))
                ->where('collection_date','<=', date('Y-m-d', strtotime($search['to_date'])));
          }
          $daily_collection =   $query->paginate(5000);
            return view("booking.room_report_row", compact("daily_collection"))->render();
        }
    }
    // public function room_report_search(Request $request){
    //     $search =  $request->all();
    //     if(is_array($search) && sizeof($search)){
    //         $query = tbl_room_booking_detail::orderBy("tbl_room_booking_detail.created_at", "DESC")
    //         ->where('status', '1')
    //         ->join('tbl_patient', 'tbl_patient.patient_id', 'tbl_room_booking_detail.patient_id');
       
    //        if( $search['from_date']!="" && $search['to_date']=="" ){
    //            $query = $query->where('tbl_room_booking_detail.book_date2', "=", date('Y-m-d', strtotime($search['from_date'])));
    //         }
    //       if($search['from_date']!="" && $search['to_date']!=""){
    //           $query = $query->where('tbl_room_booking_detail.book_date2','>=', date('Y-m-d', strtotime($search['from_date'])))
    //             ->where('tbl_room_booking_detail.book_date2','<=', date('Y-m-d', strtotime($search['to_date'])));
    //       }

    //       $booking =   $query->paginate(5000);
    //         return view("booking.room_report_row", compact("booking"))->render();
    //     }
    // }

 public function room_report_export(Request $request){
        $search =  $request->all();
        if(is_array($search) && sizeof($search)){
            $query = tbl_daily_collection::orderBy("created_at", "DESC");

           if( $search['from_date']!="" && $search['to_date']=="" ){
               $query = $query->where('collection_date', "=", date('Y-m-d', strtotime($search['from_date'])));
            }
          if($search['from_date']!="" && $search['to_date']!=""){
              $query = $query->where('collection_date','>=', date('Y-m-d', strtotime($search['from_date'])))
                ->where('collection_date','<=', date('Y-m-d', strtotime($search['to_date'])));
          }

          $booking =   $query->get();

        $filename = "roomSaleList.csv";
          $fp = fopen('php://output', 'w');
          header('Content-type: application/csv');
          header('Content-Disposition: attachment; filename='.$filename);
          
          $header[] = 'Receipt No.';
          $header[] = 'Received Date';
          $header[] = 'Patient Name';
          $header[] = 'Amount';
            fputcsv($fp, $header);
           if(count($booking) > 0){

            $total_amount  = 0;
            foreach ($booking as $key => $item) {
              $total_price = $item->amount;
              $total_amount += $total_price;

               $row = [
                $item->get_booking->receipt_no,
                date('d/m/Y', strtotime($item->collection_date)),
                $item->get_booking->get_patient['patient_name'],
                $item->amount,
            ];  
           fputcsv($fp, $row);
 
            }
              $footer[] = '';
              $footer[] = '';
              $footer[] = '';
              $footer[] = $total_amount;
              fputcsv($fp, $footer);
          }


         }
    }

    // public function room_report_export(Request $request){
    //     $search =  $request->all();
    //     if(is_array($search) && sizeof($search)){
    //         $query = tbl_room_booking_detail::orderBy("tbl_room_booking_detail.created_at", "DESC")
    //         ->where('status', '1')
    //         ->join('tbl_patient', 'tbl_patient.patient_id', 'tbl_room_booking_detail.patient_id');
    //         // foreach($search as $key => $attr){
    //         //     if($key=="search" && $key!="" && $attr!=""){
    //         //         $query->where(function ($query) use ($attr, $search) {
    //         //           $query->orWhere("tbl_patient.patient_reg_no", "like" , "%".$attr."%");
    //         //             $query->orWhere("tbl_patient.patient_name", "like" , "%".$attr."%");
                      
    //         //    });
    //         //     }
    //         // }

    //        if( $search['from_date']!="" && $search['to_date']=="" ){
    //            $query = $query->where('tbl_room_booking_detail.book_date2', "=", date('Y-m-d', strtotime($search['from_date'])));
    //         }
    //       if($search['from_date']!="" && $search['to_date']!=""){
    //           $query = $query->where('tbl_room_booking_detail.book_date2','>=', date('Y-m-d', strtotime($search['from_date'])))
    //             ->where('tbl_room_booking_detail.book_date2','<=', date('Y-m-d', strtotime($search['to_date'])));
    //       }

    //       $booking =   $query->get();

    //     $filename = "roomSaleList.csv";
    //       $fp = fopen('php://output', 'w');
    //       header('Content-type: application/csv');
    //       header('Content-Disposition: attachment; filename='.$filename);
          
    //       $header[] = 'Booking Id';
    //       $header[] = 'Booking Date';
    //       $header[] = 'Guest Reg. Id';
    //       $header[] = 'Guest name';
    //       $header[] = 'Room No.';
    //       $header[] = 'Room Price';
    //       $header[] = 'Break fast';
    //       $header[] = 'Lunch';
    //       $header[] = 'Dinner';
    //       $header[] = 'Total';
    //       $header[] = 'GST';
    //       $header[] = 'Grand Total';
    //         fputcsv($fp, $header);
    //        if(count($booking) > 0){

    //          $total_break_fast = 0;
    //         $total_lunch = 0;
    //         $total_dinner  = 0;
    //         $total_amount  = 0;
    //         $total_gst  = 0;
    //         $total_payable_amt = 0; 
    //         $total_room_price = 0; 
    //         foreach ($booking as $key => $item) {
    //           $total_room_price += $item->room_price;
    //           $total_break_fast += $item->break_fast;
    //           $total_lunch += $item->lunch;
    //           $total_dinner += $item->dinner;
    //           $total_price = $item->room_price+$item->dinner+$item->lunch+$item->break_fast;
    //           $total_amount += $total_price;
    //           $gst = (($item->room_price + $item->dinner + $item->lunch + $item->break_fast) * 12 / 100);
    //           $total_gst += $gst;
    //           $total_payable_amt += ($gst+$total_price);

    //            $row = [
    //              "HAVIT-".$item->booking_id,
    //             $item->book_date,
    //             $item->get_guest['patient_reg_no'],
    //             $item->get_guest['patient_name'],
    //             (string) $item->room_number,
    //              $item->room_price,
    //              $item->break_fast,
    //              $item->lunch,
    //              $item->dinner,
    //              ($item->room_price+$item->dinner+$item->lunch+$item->break_fast),
    //              (($item->room_price + $item->dinner + $item->lunch + $item->break_fast) * 12 / 100),
    //              ($gst+$total_price),
    //         ];  
    //        fputcsv($fp, $row);
 
    //         }
    //           $footer[] = '';
    //           $footer[] = '';
    //           $footer[] = '';
    //           $footer[] = '';
    //           $footer[] = '';
    //           $footer[] = $total_room_price;
    //           $footer[] = $total_break_fast;
    //           $footer[] = $total_lunch;
    //           $footer[] = $total_dinner;
    //           $footer[] = $total_amount;
    //           $footer[] = $total_gst;
    //           $footer[] = $total_payable_amt;


    //             fputcsv($fp, $footer);
    //       }


    //      }
    // }

    public function booking_report()
    {
        $booking = tbl_booking::orderBy("created_at", "DESC")
                                ->where('status', '1')
                                ->where('is_discharged', '1')
                                ->paginate(5000);
        return view("booking.reports", compact("booking"));
    }
    public function booking_report_search(Request $request){
        $search =  $request->all();
        if(is_array($search) && sizeof($search)){
            $query = tbl_booking::orderBy("tbl_booking.created_at", "ASC")->where('status', '1')
                  ->where('is_discharged', '1')
                    ->join('tbl_patient', 'tbl_patient.patient_id', 'tbl_booking.patient_id');
            foreach($search as $key => $attr){
                if($key=="search" && $key!="" && $attr!=""){
                    $query->where(function ($query) use ($attr, $search) {
                      $query->orWhere("tbl_patient.patient_reg_no", "like" , "%".$attr."%");
                        $query->orWhere("tbl_patient.patient_name", "like" , "%".$attr."%");
                      
               });
                }
            }

           if( $search['from_date']!="" && $search['to_date']=="" ){
               $query =   $query->where(DB::raw("(STR_TO_DATE(tbl_booking.created_at,'%Y-%m-%d'))"), "=", date('Y-m-d', strtotime($search['from_date'])));
            }
          if($search['from_date']!="" && $search['to_date']!=""){
           $query = $query->where(DB::raw("(STR_TO_DATE(tbl_booking.created_at,'%Y-%m-%d'))"),'>=', date('Y-m-d', strtotime($search['from_date'])))

            ->where(DB::raw("(STR_TO_DATE(tbl_booking.created_at,'%Y-%m-%d'))"),'<=', date('Y-m-d', strtotime($search['to_date'])));
          }

          $booking =   $query->paginate(5000);
            return view("booking.booking_report_row", compact("booking"))->render();
        }
    }

    public function booking_report_export(Request $request){
        $search =  $request->all();
        if(is_array($search) && sizeof($search)){
            $query = tbl_booking::orderBy("tbl_booking.created_at", "ASC")->where('tbl_booking.status', '1')->where('tbl_booking.is_discharged', '1')
                    ->join('tbl_patient', 'tbl_patient.patient_id', 'tbl_booking.patient_id');
            foreach($search as $key => $attr){
                if($key=="search" && $key!="" && $attr!=""){
                    $query->where(function ($query) use ($attr, $search) {
                      $query->orWhere("tbl_patient.patient_reg_no", "like" , "%".$attr."%");
                        $query->orWhere("tbl_patient.patient_name", "like" , "%".$attr."%");
                      
               });
                }
            }

           if( $search['from_date']!="" && $search['to_date']=="" ){
               $query =   $query->where(DB::raw("(STR_TO_DATE(tbl_booking.created_at,'%Y-%m-%d'))"), "=", date('Y-m-d', strtotime($search['from_date'])));
            }
          if($search['from_date']!="" && $search['to_date']!=""){
           $query = $query->where(DB::raw("(STR_TO_DATE(tbl_booking.created_at,'%Y-%m-%d'))"),'>=', date('Y-m-d', strtotime($search['from_date'])))

            ->where(DB::raw("(STR_TO_DATE(tbl_booking.created_at,'%Y-%m-%d'))"),'<=', date('Y-m-d', strtotime($search['to_date'])));
          }

          $booking =   $query->get();


          $filename = "bookingList.csv";
          $fp = fopen('php://output', 'w');
          header('Content-type: application/csv');
          header('Content-Disposition: attachment; filename='.$filename);
          
          $header[] = 'Date';
          $header[] = 'Receipt No';
          $header[] = 'Patient Name';
          $header[] = 'Cash';
          $header[] = 'Credit';
            fputcsv($fp, $header);
            $total_payable_amt = 0;
          if(count($booking) > 0){
            foreach ($booking as $key => $item) {
                
              $payable_amt = 0;
              $credit_remark = "";
              if($item->mode_of_payment_id!=16){
                $payable_amt = $item->payable_amt;
                $total_payable_amt += $payable_amt;
              }else{
                $credit_remark = $item->complimentory_reason;
              }
               $row = [
                 date_format($item->created_at, 'd/m/Y'),
                $item->receipt_no,
                $item->get_patient['patient_name'],
                $payable_amt,
                $credit_remark,
            ];  
           fputcsv($fp, $row);

            }
              $footer[] = '';
              $footer[] = '';
              $footer[] = '';
              $footer[] = $total_payable_amt;
              $footer[] = '';
              fputcsv($fp, $footer);
          }
         }
    }

  	 public function search(Request $request){
        $search =  $request->all();
        if(is_array($search) && sizeof($search)){
            $query = tbl_booking::orderBy("tbl_booking.created_at", "DESC")
                    ->join('tbl_patient', 'tbl_patient.patient_id', 'tbl_booking.patient_id');
            foreach($search as $key => $attr){
                if($key=="search" && $key!="" && $attr!=""){
                    $query->where(function ($query) use ($attr, $search) {
                    	$query->orWhere("tbl_patient.patient_reg_no", "like" , "%".$attr."%");
        			 			   $query->orWhere("tbl_patient.patient_phone", "like" , "%".$attr."%");
                       $query->orWhere("tbl_patient.patient_name", "like" , "%".$attr."%");
        			 			  
			 			   });
                }
            }
          $booking =   $query->paginate(5000);
            return view("booking.booking_row", compact("booking"))->render();
        }
    }

    public function create(Request $request)
    {
        $requestData = $request->all();
        $mode_of_payment = tbl_mode_of_payment::get();    
         return view("guest.patient_create", compact('mode_of_payment'));
    }
    public function store(Request $request)
    {
       
        $requestData = $request->all();
         
	    //code start for validation
        $guestModel = tbl_patient::where("patient_reg_no", $requestData["patient_reg_no"])
                                 ->first();
        if($guestModel){
            return [
                "status" => "validate",
                "message" => "This entry already exists "
               ];
            exit;
        }
       

    	//code end for validation
    	$save = tbl_patient::create($requestData);
        if($save){

            //save booking
             $bookingArr = [

              "patient_id" => $save->patient_id,
              "total_amt" => $requestData['total_amt'],
              "gst" => $requestData['gst'],
              "payable_amt" => $requestData['payable_amt'],
            ];
            $bookingSave = tbl_booking::create($bookingArr); 


            //save room
            if (is_array($requestData['room_number']) && sizeof($requestData['room_number']) ) {
                foreach ($requestData['room_number'] as $key => $room_number) {
                    // $book_date_ = explode('/', $requestData['book_date'][$key]);
                    // $book_date2 = $book_date_[2].'-'.$book_date_[1].'-'.$book_date_[0];

                    $room_id_detail = tbl_room::where('room_number', $requestData['room_number'][$key])->first();
                    $roonArr = 
                    [
                        "room_id" => $room_id_detail->room_id,
                        "room_number" => $requestData['room_number'][$key], 
                        "book_date" => $requestData['book_date'][$key],
                        "book_date2" => $requestData['book_date'][$key],
                         "room_price" => $requestData['room_price'][$key],
                         "break_fast" => $requestData['break_fast'][$key],
                         "lunch" => $requestData['lunch'][$key],
                         "dinner" => $requestData['dinner'][$key],
                         "patient_id" => $save->patient_id,
                         "booking_id" => $bookingSave->booking_id,
                 ];
                 tbl_room_booking_detail::create($roonArr);
                }                
            }
            
            

            






            return [
            "status" => "success",
            "save_data" => $save
           ];
        }
    }
    public function show($id)
    {
        $guest = tbl_patient::find($id);
        return view("guest.patient_show", compact("guest"))->render();
    }

    
    public function activeinactive($id){
        $guest = tbl_patient::where("patient_id",$id)
                     ->first();
        if($guest->status==1){
            $guest->status=0;
        }else{
            $guest->status=1;
        }
        $guest->save();
    }
    public function print_invoice($id){
      $booking = tbl_booking::find($id);
      if($booking->is_discharged==1){
        // return view("booking.booking_invoice", compact("booking"))->render();
        $pdf = PDF::loadView('booking.booking_invoice', compact('booking'));
        return $pdf->stream();
      }else{
        echo '404';
      }

    }
    public function update(Request $request, $id)
    {   
        $booking = tbl_booking::where("booking_id", $id)
                                    ->first();
        if($booking->is_discharged==1){
          return redirect('/booking/index');
        }
        $mode_of_payment = tbl_mode_of_payment::get();  
        $companies = tbl_company::get();
     
        if($request->ajax()){
            return [
                "status" => "found",
                "data" => $booking
            ];
        }
        return view("booking.booking_update", compact("booking", "mode_of_payment", "companies"))->render();
 
     }
     public function delete_room(Request $request){
      $requestData = $request->all();

      $find = tbl_room_booking_detail::where('room_booking_id', $requestData['room_booking_id'])->first();
      $bookingModel = tbl_booking::where('booking_id', $find->booking_id)->first();



      if($bookingModel){
        $changeDateFOrmat = explode('/', $bookingModel->get_patient->checkout);
        $changeDateFOrmat = $changeDateFOrmat[2]."-".$changeDateFOrmat[1]."-".$changeDateFOrmat[0];

        $minus_day = date("d/m/Y", strtotime('-1 day', strtotime($changeDateFOrmat)));
        $bookingModel->get_patient->checkout = $minus_day;
        $bookingModel->get_patient->save();
      }
        $delete = tbl_room_booking_detail::where('room_booking_id', $requestData['room_booking_id']);
       $delete->delete();
      return [
        'checkout' => $minus_day,
      ];
     }

    public function edit(Request $request, $id)
    {
      $requestData = $request->all();
      $bookingModel = tbl_booking::where('booking_id', $id)->first();
	    $guest = tbl_patient::where("patient_id",$bookingModel->patient_id)->first();
       
     	// $guest->checkin = $requestData["checkin"];
      if($requestData["extent_checkout"]!=""){
        $guest->checkout = $requestData["extent_checkout"];
      }
  		 
      if($guest->save()){
        //save booking
        $bookingArr = [
          "patient_id" => $bookingModel->patient_id,
          "total_amt" => $requestData['total_amt'],
          "payable_amt" => $requestData['payable_amt'],
          "mode_of_payment_id" => $requestData['mode_of_payment_id'],
          "complimentory_reason" => $requestData['complimentory_reason'],
          "advance_paid" => $requestData['advance_paid'],
          "discount" => $requestData['discount'],
          "balance_amount" => $requestData['balance_amount'],
          "final_payment" => $requestData['final_payment'],
          "refund_amount" => $requestData['refund_amount'],
          "receipt_no" => $requestData['receipt_no'],
          "is_discharged" => 1,
        ];
        $bookingSave = tbl_booking::where('booking_id',$bookingModel->booking_id )->update($bookingArr); 

          if($requestData['final_payment']!="" && $requestData['final_payment']!="0"){
            //store in daily collection
            $daily_collection_model             = new tbl_daily_collection();
            $daily_collection_model->booking_id = $bookingModel->booking_id;
            $daily_collection_model->amount     = $requestData['final_payment'];
            $daily_collection_model->collection_date     = date('Y-m-d');
            $daily_collection_model->save();
            //store in daily collection            
          }

          if($requestData['refund_amount']!="" && $requestData['refund_amount']!="0"){
            //store in daily collection
            $daily_collection_model             = new tbl_daily_collection();
            $daily_collection_model->booking_id = $bookingModel->booking_id;
            $daily_collection_model->amount         = $requestData['refund_amount'];
            $daily_collection_model->collection_date     = date('Y-m-d');
            $daily_collection_model->remark     = 'refund';

            $daily_collection_model->save();
            //store in daily collection   



          }


            if (is_array($requestData['room_number']) && sizeof($requestData['room_number']) ) {
              tbl_room_booking_detail::where('booking_id', $bookingModel->booking_id)->delete();
                foreach ($requestData['room_number'] as $key => $room_number) {
                    // $book_date_ = explode('-', $requestData['book_date'][$key]);
                    // $book_date2 = $book_date_[2].'-'.$book_date_[1].'-'.$book_date_[0];

                    $room_id_detail = tbl_room::where('room_number', $requestData['room_number'][$key])->first();
                    $roonArr = 
                        [
                        "room_id" => $room_id_detail->room_id,
                        "room_number" => $requestData['room_number'][$key], 
                        "book_date" => $requestData['book_date'][$key],
                        "book_date2" => $requestData['book_date'][$key],
                         "room_price" => $requestData['room_price'][$key],
                         "patient_id" => $bookingModel->patient_id,
                         "booking_id" => $bookingModel->booking_id,
                         "extra_bed" => $requestData['extra_bed'][$key] ?? 'off',
                         "extra_bed_price" => $requestData['extra_bed_price'][$key],
                         "extra_bed_qty" => $requestData['extra_bed_qty'][$key],
                        ];
                     tbl_room_booking_detail::create($roonArr);
                }                
            }

            if($requestData['refund_amount']!="" && $requestData['refund_amount']!="0"){
             
                //cancel booking
                $bookingModel->status = 0;
                if ($bookingModel->save()) {
                  tbl_room_booking_detail::where('booking_id', $bookingModel->booking_id)->update(['status' => 0]);
                };
                //cancel booking
            }
            return [
            "status" => "success",
            "save_data" => $guest,
           ];
        }
    }
    public function destroy($id, Request $request)
    {
        
            $cancelBooking = tbl_booking::find($id);
            $cancelBooking->status = 0;
            if ($cancelBooking->save()) {
                $findRooms = tbl_room_booking_detail::where('booking_id', $cancelBooking->booking_id)->update(['status' => 0]);
                return ['status' => 'success'];
             };

    }
}