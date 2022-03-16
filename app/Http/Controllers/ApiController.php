<?php

namespace App\Http\Controllers;

use App\Merchant;
use Illuminate\Http\Request;
use App\BusinessType;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;
class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('created_at', 'desc')->paginate(4);
        return view('category.index', compact('categories'))->render();
    }
    public function login(Request $request){
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
            if (Auth::attempt(['mobile' => $requestData['mobile'], 'password' => $requestData['password'], ])) {
                   $return = [
                    'status' => 'success',
                    'user' => $find_user->load('getMerchant'),
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
    public function merchantregister(Request $request){
        // {"business_name":"Kuldeep S","owner_name":"sdlfkj","owner_mobile":"039423048098","email":"sdfsdfsdfsdf@yopmail.com","pan_number":"320498324","company_type":"0938408","address":"0938409","mobile":"324234","description":"93048","password":"234234234"}
        $requestData = $request->all();
        $validator = Validator::make( $requestData, [ 
             'business_name'  => 'required|max:240',
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
         $return = [
            'status' => 'fail',
             'data' => [],
        ];
       if ($validator->passes()) {
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
                     $return = [
                        'status' => 'success',
                        'data' => $saveMerchant,
                    ];  
                }
                else{
                    $return['status'] = 'fail';

                 }
            }else{
                  $return['status'] = 'fail';
            }
             return response()->json([
                'status' => $return['status'] ,
                'data' => $saveUser->load('getMerchant'),
                'message' => 'Successfully created user!'
            ], 200);

              }
              else{
 return response()->json(['error'=>$validator->errors()->all()], 422);
              }  

             


       

         
     }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('created_at', 'desc')->get();
        return view('category.create', compact('categories'));
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
             'title'  => 'unique:tbl_category,title,NULL,category_id,deleted_at,NULL|required|max:240',
             'slug' => 'unique:tbl_category,slug,NULL,category_id,deleted_at,NULL|required|max:240',
             'parent_id' => 'max:240',
         ]);
        $data = [
                "name"=> ['Kuldeep', 'Manpreet'],
                "age"=> ['24', '25'],
                "city" => "Amritsar",
                ];
 
        $requestData = $request->all();
        // {"name":["Kuldeep","Manpreet"],"age":["24","25"],"city":"Amritsar"}
        // [["Kuldeep","Manpreet"],["24","25"],"Amritsar"]
        // $data = array_values($data);

        $requestData['data'] = json_encode($data);
        // var_dump($requestData);
        $return = [
            'status' => 'fail',
             'data' => [],
        ];
        $saveCategory =  Category::create($requestData);
        if($saveCategory){
            return $return = [
                'status' => 'success',
                'data' => $saveCategory->load('parent_category'),
            ];  
        }
        else{
           return $return;
        }
        
     }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Merchant  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $category)
    {
         $updateCategory = Category::find($category);
        $validatedData = $request->validate([
             'parent_id' => 'max:240',
             'title' => 'required|max:240|unique:tbl_category,title,'.$category.',category_id',
             'slug' => 'required|max:240|unique:tbl_category,slug,'.$category.',category_id',

         ]);
        // Validator::make($data, [
        //     'slug' => [
        //         'required',
        //         Rule::unique('tbl_category')->ignore($category),
        //     ],
        // ]);
         // Rule::unique('users')->ignore($updateCategory->user_id, 'user_id');
             
        $requestData = $request->all();
        // var_dump($requestData);
        $return = [
            'status' => 'fail',
             'data' => [],
        ];

        $updateCategory->title = $requestData['title'];
        $updateCategory->slug = $requestData['slug'];
        $updateCategory->parent_id = $requestData['parent_id'];
        $updateCategory->save();
            if($updateCategory){
                    return $return = [
                        'status' => 'success',
                        'data' => $updateCategory->load('parent_category'),
                    ];      
            }
            else{
               return $return;
            }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Merchant  $category
     * @return \Illuminate\Http\Response
     */
    public function update($CategoryId)
    {   
        return [
            'status' => 'found',
             'data' =>  Category::find($CategoryId)->load('parent_category'),
        ];

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Merchant  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($CategoryId)
    {
        $return = [
            'status' => 'fail',
        ];

        $categoryModelCheckParent = Category::where('parent_id', $CategoryId)->first();
        if (!$categoryModelCheckParent) {
            $categoryModel = Category::find($CategoryId);
            $categoryModel->delete();

            if ($categoryModel->trashed()) {
                       $return = [
                            'status' => 'delete',
                        ];  
            }else{
                   $return['status'] = 'MerchantModel Not Delete';
            }
        }else{
                  $return['status'] = 'Category in use';
            }

        return  $return;
    }
}
