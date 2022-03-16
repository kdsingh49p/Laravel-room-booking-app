<?php
namespace App\Http\Controllers;
use App\tbl_addon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\tbl_addon_booking_detail;

class AddonController extends Controller
{
    
    public function index()
    {
        $addon = tbl_addon::orderBy("created_at", "DESC")->paginate(10);
        return view("addon.addon_list", compact("addon"));
    }

    

    public function checkvalidation(Request $request){
         $requestData = $request->all();
         $addonModel = tbl_addon::where("title", $requestData["title"])->first();

        if($addonModel){
            return ["status" => false];
        } else{
            return ["status" => true];
        }
     }
  	 public function search(Request $request){
        $search =  $request->all();
        if(is_array($search) && sizeof($search)){
            $query = tbl_addon::orderBy("created_at", "DESC");
            foreach($search as $key => $attr){
                if($key=="search" && $key!="" && $attr!=""){
                    $query->where(function ($query) use ($attr, $search) {
                    	$query->orWhere("title", "like" , "%".$attr."%");
			 			   $query->orWhere("price", "like" , "%".$attr."%");
			 			   });
                }
            }
          $addon =   $query->paginate(10);
            return view("addon.addon_row", compact("addon"))->render();
        }
    }

    public function create(Request $request)
    {
        $requestData = $request->all();
        return view("addon.addon_create");
    }
    public function store(Request $request)
    {
       
        $requestData = $request->all();
         
	    //code start for validation
        $addonModel = tbl_addon::where("title", $requestData["title"])
                                 ->first();
        if($addonModel){
            return [
                "status" => "validate",
                "message" => "This entry already exists "
               ];
            exit;
        } 
    	//code end for validation
    	$save = tbl_addon::create($requestData);
        if($save){
            return [
            "status" => "success",
            "save_data" => $save
           ];
        }
    }
    public function show($id)
    {
        $addon = tbl_addon::find($id);
        return view("addon.addon_show", compact("addon"))->render();
    }

    
    public function activeinactive($id){
        $addon = tbl_addon::where("addon_id",$id)
                     ->first();
        if($addon->status==1){
            $addon->status=0;
        }else{
            $addon->status=1;
        }
        $addon->save();
    }
    public function update(Request $request, $id)
    {   
        $addon = tbl_addon::where("addon_id", $id)
                                    ->first();
        if($request->ajax()){
            return [
                "status" => "found",
                "data" => $addon
            ];
        }
        return view("addon.addon_update", compact("addon"))->render();
 
     }

    public function edit(Request $request, $id)
    {
       $requestData = $request->all();
  	   //code start for validation
  	   $addonModel = tbl_addon::where("title", $requestData["title"])
	                                 ->where("addon_id", "!=", $id)
	                                ->first();
       if($addonModel){
	        return [
	            "status" => "validate",
	            "message" => "This entry already exists "
	           ];
	        exit;
       }
       //code end for validation
	       $addon = tbl_addon::where("addon_id",$id)->first();
        $addon->title = $requestData["title"];
 		$addon->price = $requestData["price"];
 		// $addon->status = $requestData["status"];
 		 
        if($addon->save()){
            return [
            "status" => "success",
            "save_data" => $addon
           ];
        }
    }
    public function destroy($id, Request $request)
    {
        
            $delete = tbl_addon::find($id);
            $delete->delete();
            if($delete->trashed()){
                return ["status" => "success"];
           }
    }
}