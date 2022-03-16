<?php

namespace App\Http\Controllers;

use App\tbl_mode_of_payment;
use App\tbl_student_admission;
use Illuminate\Http\Request;

class ModeOfPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mop = tbl_mode_of_payment::orderBy('created_at', 'DESC')
                      ->paginate(1000);
        return view('mode-of-payment.index', compact('mop'))->render();
    }
     public function checkvalidation(Request $request){
         $requestData = $request->all();
         $purposeModel = tbl_mode_of_payment::where('title', $requestData['title'])
                                     ->first();

        if($purposeModel){
            return ['status' => false];
        } else{
            return ['status' => true];
        }
     }
    
     
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
 
        return view('mode-of-payment.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'  => 'required',
         ]);
        $requestData = $request->all();

             //code start for validation
            $mode_of_payment = tbl_mode_of_payment::where('title', $requestData['title'])
                                     ->first();
            if($mode_of_payment){
                 return [
                    'status' => "validate",
                    'message' => 'This entry already exists '
                   ];

                exit;
            } 
            //code end for validation

        $save = tbl_mode_of_payment::create($requestData);
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
    public function show(Supplier $id)
    {
        $mop = tbl_mode_of_payment::find($id);
        return view('mode-of-payment.show', compact('mop'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Enquiry  $Enquiry
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $this->validate($request, [
             'title'  => 'required',
 
        ]);
        $requestData = $request->all();


         //code start for validation
        $mode_of_pyament_model = tbl_mode_of_payment::where('title', $requestData['title'])
                                 ->where('mode_of_payment_id', '!=',  $id)
                                ->first();
        if($mode_of_pyament_model){
             return [
                'status' => "validate",
                'message' => 'This entry already exists '
               ];
            exit;
        } 
       //code end for validation



        $updateArr = 
           [
            'title' => $requestData['title'],
          ];         
        $update =  tbl_mode_of_payment::where('mode_of_payment_id', $id)
           ->update($updateArr);

        if($update){
            return [
                'status' => 'update'    
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
        $find = tbl_mode_of_payment::where('mode_of_payment_id', $id)
                                    ->first();

        return ['status' => 'found', 'data' => $find];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Enquiry  $Enquiry
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $check = tbl_student_admission::where('mode_of_payment_id', $id)->first();
        if($check){
            return ['status' => 'fail'];
        }else{
             $delete = tbl_mode_of_payment::where('mode_of_payment_id', $id)->first();
             $delete->delete();
                if($delete->trashed()){
                    return ['status' => 'success'];
            }
        }
    }
}