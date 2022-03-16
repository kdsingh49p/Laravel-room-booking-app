<?php

namespace App\Http\Controllers;

use App\User;
use App\tbl_disease;
use App\tbl_franchisee;
use App\tbl_student_admission;
 
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DiseaseController extends Controller
{
    
    public function index()
    {
        $disease = tbl_disease::orderBy('created_at', 'DESC')
                      ->paginate(10);
        return view('admin.disease_list', compact('disease'));
    }

    public function checkvalidation(Request $request){
         $requestData = $request->all();
         $diseaseModel = tbl_disease::where('title', $requestData['title'])
                                     ->first();

        if($diseaseModel){
            return ['status' => false];
        } else{
            return ['status' => true];
        }
     }
    

    

     public function search(Request $request){
        $search =  $request->all();
        if(is_array($search) && sizeof($search)){
            $query = tbl_disease::orderBy('created_at', 'DESC');
            foreach($search as $key => $attr){
                if($key=='search' && $key!='' && $attr!=''){
                    $query->where(function ($query) use ($attr, $search) {
                       $query->orWhere('title', 'like' , "%".$attr."%");
                    });
                }
            }
          $disease =   $query->paginate(10);
            return view('admin.disease_row', compact('disease'))->render();
        }
    }
     
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $requestData = $request->all();
        return view('admin.disease_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $requestData = $request->all();
        
        //code start for validation
            $diseaseModel = tbl_disease::where('title', $requestData['title'])
                                     ->first();
            if($diseaseModel){
                 return [
                    'status' => "validate",
                    'message' => 'This entry already exists '
                   ];

                exit;
            } 

        //code end for validation
        
         $save = tbl_disease::create($requestData);
        if($save){
            return [
            'status' => "success",
            'save_data' => $save
           ];
        }
    }
   
    /**
     * Display the specified resource.
     *
     * @param  \App\Enquiry  $Enquiry
     * @return \Illuminate\Http\Response
     */
    
    public function show($id)
    {
        $disease = tbl_disease::find($id);
        return view('admin.disease_show', compact('disease'))->render();
        // return [
        //     'status' => 'found',
        //     'data' => $branch
        // ];
     }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Enquiry  $Enquiry
     * @return \Illuminate\Http\Response
     */
    public function activeinactive($id){
        $disease = tbl_disease::where('disease_id',$id)
                     ->first();
        if($disease->status==1){
            $disease->status=0;
        }else{
            $disease->status=1;
        }
        $disease->save();
    }
    public function edit(Request $request, $id)
    {
         $requestData = $request->all();
  
       $disease = tbl_disease::where('disease_id',$id)
                     ->first();
        //code start for validation
        
        $diseaseModel = tbl_disease::where('title', $requestData['title'])
                                 ->where('disease_id', '!=',  $id)
                                ->first();

        if($diseaseModel){
             return [
                'status' => "validate",
                'message' => 'This entry already exists '
               ];
            exit;
        }

       //code end for validation
        $disease->title = $requestData['title'];
        // $disease->status = $requestData['status'];
        if($disease->save()){
            return [
            'status' => "success",
            'save_data' => $disease
           ];
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Enquiry  $Enquiry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        $disease = tbl_disease::where('disease_id', $id)
                                    ->first();
        if($request->ajax()){
            return [
                'status' => 'found',
                'data' => $disease
            ];
        }
        return view('admin.disease_update', compact('disease'))->render();

        
     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Enquiry  $Enquiry
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        // $check = tbl_student_admission::where('disease_id', $id)->first();
        // if($check){
        //     return ['status' => 'fail'];
        // }else{
            $delete = tbl_disease::find($id);
            $delete->delete();
            if($delete->trashed()){
                return ['status' => 'success'];
           }
        // }
        
    }
}