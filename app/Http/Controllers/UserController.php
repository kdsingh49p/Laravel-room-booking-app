<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\components\Helper;
use App\components\Features;
class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $users = User::orderBy('created_at', 'desc')->paginate(4);
        return view('user-register.user_list', compact('users'))->render();
    }
    public function verify_otp(Request $request){
        // $validatedData = $request->validate([
        //      'otp'  => 'required|max:6',
        //  ]);
        $requestData = $request->all();
        if(isset($requestData['id'])){
            $user = User::where('id', $requestData['id'])->first();
            $user->otp_verified = 1;
            $user->save();

            return [
                'status' => 'success',
            ];
        }
    }
    public function register(Request $request)
    {
        $validatedData = $request->validate([
             'name'  => 'required|max:240',
             // 'email' => 'email|max:100',
             'mobile' => 'required|max:20',
             'password' => 'required|max:240',
         ]);
                      
        $requestData = $request->all();
        $otp = Helper::generateRandomString(5);

        //first save user
        $userData = [
            'name' => $requestData['name'],
            'mobile' => $requestData['mobile'],
            'password' => Hash::make($requestData['password']),
            'password_hint' => $requestData['password'],
            'otp' => $otp,
            'type' => 'user',
            ];
        $saveUser = User::create($userData);
        if($saveUser){

            $message = "Enter OTP to register on DealsSite.com $otp";
            $Feature = Features::ConfigSms($requestData['mobile'], $message);
            if (Auth::attempt(['mobile' => $requestData['mobile'], 'password' => $requestData['password'], ])) {

                return $return = [
                    'status' => 'success',
                    'data' => $saveUser,
                 ];  
            }else{
                return $return = [
                    'status' => 'Invalid Login',
                    'data' => [],
                ];  
            }    
                
        }else{
             return $return['status'] = 'user add fail';
        }

    }
    public function search_result(Request $request)
    {
         
         $data = [];


        if($request->has('q')){
            $search = $request->q;
            $data = User::where('name','LIKE',"%$search%")
                    ->get();
            
        }


        return json_encode($data);
    }
    public function select2()
    {
         
        
        return view('slider.user_list');


     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         
         $user = Auth::user();
         // $this->authorize('create');
        //  if ($user->can('create', User::class)) {
        //     //
        //     echo 'Current logged in user is allowed to create new posts.';
        // }
        // if ($user->can('create', User::class)) {
        //   echo 'Current logged in user is allowed to create new posts.';
        // } else {
        //   echo 'Not Authorized';
        // }
        // if (Gate::allows('user-register')) {
        //     // The current user can edit settings
        // }
        // if ($user->can('create', User::class)) {
        //     // Executes the "create" method on the relevant policy...
        // }
        return view('user-register.user_create');
    }

    public function login()
    {
        return view('user-register.login');
    } 
    public function logout()
    {
        Auth::logout();
        Auth::guard('admin')->logout();
        Auth::guard('merchant')->logout();
        return view('user-register.login');
    }
    public function checklogin(Request $request)
    {
         $validatedData = $request->validate([
             'mobile' => 'required',
            'password' => 'required',
        ]);
        $requestData = $request->all();
    $userModel = User::where('mobile', $requestData['mobile'])->first();
    if($userModel){
        if(!$userModel->otp_verified){
            return $return = [
                    'status' => 'not_verified',
                ];  
        }
    }
    // var_dump($requestData);
    if (Auth::attempt(['mobile' => $requestData['mobile'], 'password' => $requestData['password'], ])) {
        return $return = [
                    'status' => 'success',
                    // 'data' => $saveUser,
                ];  
    }else{
            return $return = [
                    'status' => 'fail',
                    // 'data' => $saveUser,
                ];  

    }    
      
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
             'name'  => 'required|max:240',
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $requestData = $request->all();
        // var_dump($requestData);
        $requestData['password']  = Hash::make($requestData['password']);
        $save =  User::create($requestData);
        return redirect('user-register/index')->with('success','User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserRegister  $userRegister
     * @return \Illuminate\Http\Response
     */
    public function show(UserRegister $userRegister)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserRegister  $userRegister
     * @return \Illuminate\Http\Response
     */
    public function edit(UserRegister $userRegister)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserRegister  $userRegister
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserRegister $userRegister)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserRegister  $userRegister
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserRegister $userRegister)
    {
        //
    }
}
