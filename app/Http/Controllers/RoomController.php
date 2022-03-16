<?php
namespace App\Http\Controllers;
use App\tbl_room;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\tbl_room_booking_detail;

class RoomController extends Controller
{
    
    public function index()
    {
        $room = tbl_room::orderBy("created_at", "DESC")->paginate(10);
        return view("room.room_list", compact("room"));
    }

    public function getavailabelrooms(Request $request){
        $requestData = $request->all();
        $rooms = tbl_room::get();

        $checkoutDate = explode("-", $requestData['checkout']);
        $checkoutDate_decrease1 = ($checkoutDate[2]-1);
        $checkoutDate_back = $checkoutDate[0]."-".$checkoutDate[1]."-".($checkoutDate[2]-1);
    
        $booking_dates = [];
        $check_in = $requestData['checkin'];
        $check_out = $checkoutDate_back;
        while (strtotime($check_in) <= strtotime($check_out)) {
                $booking_dates[] = $check_in;
                $check_in = date ("Y-m-d", strtotime("+1 days", strtotime($check_in)));
        }

        $html = '<h3>Room Availability</h3>';
        foreach ($booking_dates as $key => $booking_date) {
            $html .= "<h4 class='booking_date_s'>".date('d/m/Y', strtotime($booking_date))."</h4>";

        $html.="<div class='row'>";
        if(count($rooms) > 0){
            foreach ($rooms as $key1 => $value) {
                $tbl_room_booking_detail = tbl_room_booking_detail::where('book_date2', $booking_date)->where('status', 1)->where('room_id', $value->room_id)->first();
                 
                if ($tbl_room_booking_detail) 
                { 
                     $html .= "<div class='col-md-2'>
                            <div class='form-group'>
                                <label class='booked_status'>Booked: ".$value['room_number']."</label>
                              </div>
                            </div>";
                    
                } else{
                    $html .= "<div class='col-md-2'>
                             <div class='demo-checkbox'>
 
                                    <input book_date='".$booking_date."' book_date2='".date('d/m/Y', strtotime($booking_date))."' type='checkbox' room_number='".$value['room_number']."' room_price='".$value['room_price']."'  id='basic_checkbox_".$value['room_id']."_".$booking_date."' room_id='".$value['room_id']."' class='add_room'>

                                    <label class='available_status' for='basic_checkbox_".$value['room_id']."_".$booking_date."'>Available: ".$value['room_number']."</label>
                                    
                                </div>
 
 
                             </div>";
                 }

 
            }
        }
            
          $html.="</div>";

         }

        


        return $html;
    }

    public function checkvalidation(Request $request){
         $requestData = $request->all();
         $roomModel = tbl_room::where("room_number", $requestData["room_number"])->first();

        if($roomModel){
            return ["status" => false];
        } else{
            return ["status" => true];
        }
     }
  	 public function search(Request $request){
        $search =  $request->all();
        if(is_array($search) && sizeof($search)){
            $query = tbl_room::orderBy("created_at", "DESC");
            foreach($search as $key => $attr){
                if($key=="search" && $key!="" && $attr!=""){
                    $query->where(function ($query) use ($attr, $search) {
                    	$query->orWhere("room_number", "like" , "%".$attr."%");
			 			   $query->orWhere("room_price", "like" , "%".$attr."%");
			 			   $query->orWhere("status", "like" , "%".$attr."%");
			 			   });
                }
            }
          $room =   $query->paginate(10);
            return view("room.room_row", compact("room"))->render();
        }
    }

    public function create(Request $request)
    {
        $requestData = $request->all();
        return view("room.room_create");
    }
    public function store(Request $request)
    {
       
        $requestData = $request->all();
         
	    //code start for validation
        $roomModel = tbl_room::where("room_number", $requestData["room_number"])
                                 ->first();
        if($roomModel){
            return [
                "status" => "validate",
                "message" => "This entry already exists "
               ];
            exit;
        } 
    	//code end for validation
    	$save = tbl_room::create($requestData);
        if($save){
            return [
            "status" => "success",
            "save_data" => $save
           ];
        }
    }
    public function show($id)
    {
        $room = tbl_room::find($id);
        return view("room.room_show", compact("room"))->render();
    }

    
    public function activeinactive($id){
        $room = tbl_room::where("room_id",$id)
                     ->first();
        if($room->status==1){
            $room->status=0;
        }else{
            $room->status=1;
        }
        $room->save();
    }
    public function update(Request $request, $id)
    {   
        $room = tbl_room::where("room_id", $id)
                                    ->first();
        if($request->ajax()){
            return [
                "status" => "found",
                "data" => $room
            ];
        }
        return view("room.room_update", compact("room"))->render();
 
     }

    public function edit(Request $request, $id)
    {
       $requestData = $request->all();
  	   //code start for validation
  	   $roomModel = tbl_room::where("room_number", $requestData["room_number"])
	                                 ->where("room_id", "!=", $id)
	                                ->first();
       if($roomModel){
	        return [
	            "status" => "validate",
	            "message" => "This entry already exists "
	           ];
	        exit;
       }
       //code end for validation
	       $room = tbl_room::where("room_id",$id)->first();
        $room->room_number = $requestData["room_number"];
 		$room->room_price = $requestData["room_price"];
 		// $room->status = $requestData["status"];
 		 
        if($room->save()){
            return [
            "status" => "success",
            "save_data" => $room
           ];
        }
    }
    public function destroy($id, Request $request)
    {
        
            $delete = tbl_room::find($id);
            $delete->delete();
            if($delete->trashed()){
                return ["status" => "success"];
           }
    }
}