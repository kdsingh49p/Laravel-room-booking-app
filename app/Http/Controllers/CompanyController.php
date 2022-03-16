<?php
namespace App\Http\Controllers;
use App\tbl_company;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CompanyController extends Controller
{
    
    public function index()
    {
        $company = tbl_company::orderBy("created_at", "DESC")->paginate(10);
        return view("company.company_list", compact("company"));
    }
    
    public function checkvalidation(Request $request){
         $requestData = $request->all();
         $companyModel = tbl_company::where("title", $requestData["title"])->first();

        if($companyModel){
            return ["status" => false];
        } else{
            return ["status" => true];
        }
     }
  	 public function search(Request $request){
        $search =  $request->all();
        if(is_array($search) && sizeof($search)){
            $query = tbl_company::orderBy("created_at", "DESC");
            foreach($search as $key => $attr){
                if($key=="search" && $key!="" && $attr!=""){
                    $query->where(function ($query) use ($attr, $search) {
                    	$query->orWhere("title", "like" , "%".$attr."%");
			 			   });
                }
            }
          $company =   $query->paginate(10);
            return view("company.company_row", compact("company"))->render();
        }
    }

    public function create(Request $request)
    {
        $requestData = $request->all();
        return view("company.company_create");
    }
    public function store(Request $request)
    {
       
        $requestData = $request->all();
         
	    //code start for validation
        $companyModel = tbl_company::where("title", $requestData["title"])
                                 ->first();
        if($companyModel){
            return [
                "status" => "validate",
                "message" => "This entry already exists "
               ];
            exit;
        } 
    	//code end for validation
    	$save = new tbl_company();
        $save->title = $requestData['title'];
        $save->save();
        if($save){
            return [
            "status" => "success",
            "save_data" => $save
           ];
        }
    }
    public function show($id)
    {
        $company = tbl_company::find($id);
        return view("company.company_show", compact("company"))->render();
    }

    
    public function activeinactive($id){
        $company = tbl_company::where("company_id",$id)
                     ->first();
        if($company->status==1){
            $company->status=0;
        }else{
            $company->status=1;
        }
        $company->save();
    }
    public function update(Request $request, $id)
    {   
        $company = tbl_company::where("company_id", $id)
                                    ->first();
        if($request->ajax()){
            return [
                "status" => "found",
                "data" => $company
            ];
        }
        return view("company.company_update", compact("company"))->render();
 
     }

    public function edit(Request $request, $id)
    {
       $requestData = $request->all();
  	   //code start for validation
  	   $companyModel = tbl_company::where("title", $requestData["title"])
	                                 ->where("company_id", "!=", $id)
	                                ->first();
       if($companyModel){
	        return [
	            "status" => "validate",
	            "message" => "This entry already exists "
	           ];
	        exit;
       }
       //code end for validation
	       $company = tbl_company::where("company_id",$id)->first();
        $company->title = $requestData["title"];
 		 
        if($company->save()){
            return [
            "status" => "success",
            "save_data" => $company
           ];
        }
    }
    public function destroy($id, Request $request)
    {
        
            $delete = tbl_company::find($id);
            $delete->delete();
            if($delete->trashed()){
                return ["status" => "success"];
           }
    }
}