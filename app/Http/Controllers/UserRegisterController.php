<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class UserRegisterController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $users = User::where('id', '!=', 1)->orderBy('created_at', 'desc')->paginate(4);
        return view('user-register.user_list', compact('users'))->render();
    }
    public function search(Request $request){
        $search =  $request->all();
        if(is_array($search) && sizeof($search)){
            $query = User::where('id', '!=', 1)->orderBy("created_at", "DESC");
            foreach($search as $key => $attr){
                if($key=="search" && $key!="" && $attr!=""){
                    $query->where(function ($query) use ($attr, $search) {
                        $query->orWhere("name", "like" , "%".$attr."%");
                           $query->orWhere("email", "like" , "%".$attr."%");
                           });
                }
            }
        }
          $users =   $query->paginate(4);
            return view("user-register.user_row", compact("users"))->render();

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
 

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkvalidation(Request $request){
         $requestData = $request->all();
         $diseaseModel = User::where('email', $requestData['email'])
                                     ->first();

        if($diseaseModel){
            return ['status' => false];
        } else{
            return ['status' => true];
        }
     }
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
             'email' => 'required|email',
            'password' => 'required',
        ]);
        $requestData = $request->all();
        $find_user = User::where('email', 'like', '%'.trim($requestData['email']).'%')->first();
        if($find_user){
            // var_dump($requestData);
            if (Auth::guard($find_user->type)->attempt(['email' => $requestData['email'], 'password' => $requestData['password'], ])) {
                return "success";
            }else{
                return "Invalid Login";
            }    
        }else{
                return "Email Not Found";
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
       
        $requestData = $request->all();
        // var_dump($requestData);
        $requestData['password']  = Hash::make($requestData['password_hint']);
        $save =  User::create($requestData);
        if($save){
            return [
            "status" => "success",
            "save_data" => $save,
           ];
        }
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
    public function update(Request $request, $id)
    {   
        $user = User::where("id", $id)
                                    ->first();
        if($request->ajax()){
            return [
                "status" => "found",
                "data" => $user
            ];
        }
        return view("user-register.user_update", compact("user"))->render();
 
     }

    public function edit(Request $request, $id)
    {
       $requestData = $request->all();
       //code start for validation
       $userModel = User::where("email", $requestData["email"])
                                     ->where("id", "!=", $id)
                                    ->first();
       if($userModel){
            return [
                "status" => "validate",
                "message" => "This entry already exists "
               ];
            exit;
       }
       //code end for validation
        $user = User::where("id",$id)->first();
        $user->name = $requestData["name"];
        $user->email = $requestData["email"];
        $user->password_hint = $requestData["password_hint"];
        $user->password = Hash::make($requestData['password_hint']);
         
        if($user->save()){
            return [
            "status" => "success",
            "save_data" => $user
           ];
        }
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
