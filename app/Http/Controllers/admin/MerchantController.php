<?php

namespace App\Http\Controllers\admin;

use App\Merchant;
use App\BusinessType;
use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class MerchantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function autologin($id){
        if($id){
           if(Auth::guard('merchant')->loginUsingId($id)) {
                return redirect('merchant/dashboard')->with('success','Merchant Login Successfully');
           }
        }
    }
    public function index()
    {
        $merchants = Merchant::orderBy('created_at', 'desc')->paginate(4);
        return view('admin.merchant.index', compact('merchants'))->render();
    }

    public function fetchdata(Request $request)
    {
     if($request->ajax())
     {
      $sub_contractors = Merchant::orderBy('created_at', 'desc')->paginate(5);
      return view('admin.merchant.pagination_data', compact('sub_contractors'))->render();
     }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $merchants = Merchant::orderBy('created_at', 'desc')->get();
        return view('admin.merchant.create', compact('merchants'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function login(Request $request){
        return view('admin.merchant.login');
    }
     public function checkLogin(Request $request){
                 $validatedData = $request->validate([
             'mobile' => 'required',
            'password' => 'required',
        ]);
         $return = [
                    'status' => 'fail',
                ];  
        $requestData = $request->all();
        $find_user = User::where('mobile', $requestData['mobile'])->first();
        if($find_user){
            // var_dump($requestData);
            if (Auth::guard($find_user->type)->attempt(['mobile' => $requestData['mobile'], 'password' => $requestData['password'], ])) {
                   $return = [
                    'status' => 'success',
                    ];
            }else{
                $return = [
                    'status' => 'fail',
                    'msg' => 'Invalid Login',
                ];  
            }    
        }else{
            $return = [
                    'status' => 'fail',
                    'msg' => 'Email Not Found',
                ];  
        }
        return $return;
    }
    public function store(Request $request)
    {

          $validatedData = $request->validate([ 
             'business_name'  => 'required|max:240',
             // 'email' => 'email|max:100',
             'owner_name' => 'required|max:240',
             'address' => 'required|max:240',
             'pan_number' => 'max:240',
             'company_type' => 'max:240',
             'number_of_employee' => 'required|max:240',
             'mobile' => 'unique:users|required|max:50',
             'owner_mobile' => 'max:20',
             'description' => 'max:240',
         ]);
                      
        $requestData = $request->all();
        // var_dump($requestData);
        $return = [
            'status' => 'fail',
             'data' => [],
        ];

        //Lets Find Business type Or create New
        if(!is_numeric($requestData['company_type']))
        {
            $letsFirstFind = BusinessType::firstOrCreate(['title' => strtoupper($requestData['company_type'])]);
            if($letsFirstFind){
                $requestData['company_type'] = $letsFirstFind->business_type_id;
            }
        }
        //first save user
        $userData = [
            'name' => $requestData['business_name'],
            'mobile' => $requestData['mobile'],
            'password' => Hash::make($requestData['password']),
            'password_hint' => $requestData['password'],
            'type' => 'merchant',
            ];
        $saveUser = User::create($userData);
        if($saveUser){
            $requestData['user_id'] = $saveUser->id;
            $saveMerchant =  Merchant::create($requestData);
            if($saveMerchant){
                return $return = [
                    'status' => 'success',
                    'data' => $saveMerchant,
                ];  
            }
            else{
               return $return;
            }
        }else{
             return $return['status'] = 'user add fail';
        }
        
     }

    /**
     * Display the specified resource.
     *
     * @param  \App\Merchant  $Merchant
     * @return \Illuminate\Http\Response
     */
    public function show(Merchant $Merchant)
    {
        $sub_contractors = Merchant::find($Merchant);
        return view('admin.merchant.show', compact('sub_contractors'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Merchant  $Merchant
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $Merchant)
    {
        $updateMerchant = Merchant::find($Merchant);
        $validatedData = $request->validate([
             'business_name'  => 'required|max:240',
             // 'email' => 'email|max:100',
             'owner_name' => 'required|max:240',
             'address' => 'required|max:240',
             'pan_number' => 'max:240',
             'company_type' => 'max:240',
             'number_of_employee' => 'required|max:240',
             'mobile' => 'required|max:240|unique:users,mobile,'.$updateMerchant->user_id,
             
             'owner_mobile' => 'max:20',
             'description' => 'max:240',
         ]);
         // Rule::unique('users')->ignore($updateMerchant->user_id, 'user_id');
             
        $requestData = $request->all();
        // var_dump($requestData);
        $return = [
            'status' => 'fail',
             'data' => [],
        ];

        //Lets Find Business type Or create New
        if(!is_numeric($requestData['company_type']))
        {
            $letsFirstFind = BusinessType::firstOrCreate(['title' => strtoupper($requestData['company_type'])]);
            if($letsFirstFind){
                $requestData['company_type'] = $letsFirstFind->business_type_id;
            }
        }


        
        $updateMerchant->business_name = $requestData['business_name'];
        $updateMerchant->email = $requestData['email'];
        $updateMerchant->owner_name = $requestData['owner_name'];
        $updateMerchant->address = $requestData['address'];
        $updateMerchant->pan_number = $requestData['pan_number'];
        $updateMerchant->company_type = $requestData['company_type'];
        $updateMerchant->number_of_employee = $requestData['number_of_employee'];
        $updateMerchant->mobile = $requestData['mobile'];
        $updateMerchant->owner_mobile = $requestData['owner_mobile'];
        $updateMerchant->description = $requestData['description'];

        $updateMerchant->save();
            if($updateMerchant){
                $updateUser = User::find($updateMerchant->user_id);
                $updateUser->name = $requestData['business_name'];
                $updateUser->mobile = $requestData['mobile'];
                $updateUser->password = Hash::make($requestData['password']);
                $updateUser->password_hint = $requestData['password'];
                if($updateUser->save()){
                    return $return = [
                        'status' => 'success',
                        'data' => $updateMerchant,
                    ];      
                }
                
            }
            else{
               return $return;
            }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Merchant  $Merchant
     * @return \Illuminate\Http\Response
     */
    public function update($MerchantId)
    {   
        return [
            'status' => 'found',
             'data' =>  Merchant::find($MerchantId)->load('user'),
        ];

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Merchant  $Merchant
     * @return \Illuminate\Http\Response
     */
    public function destroy($MerchantId)
    {
        $return = [
            'status' => 'fail',
        ];
        $MerchantModel = Merchant::find($MerchantId);
        $findUser  = $MerchantModel;
        $userId = $findUser->user_id;
        $MerchantModel->delete();

        if ($MerchantModel->trashed()) {
          
            $userModel=  User::where('id',$userId)->first();
            // return var_dump($userModel);
            // exit;
            if($userModel){
               $userModel->delete();
                if($userModel->trashed()){
                     return $return = [
                        'status' => 'delete',
                        'user_id' => $userId,
                    ];  
                }else{
                    $return['status'] = 'userModel Not Delete';
                }  
            }else{
                $return['status'] = 'User Not Found';
            }
           
            
        }else{
                $return['status'] = 'MerchantModel Not Delete';
            }
    }
}
