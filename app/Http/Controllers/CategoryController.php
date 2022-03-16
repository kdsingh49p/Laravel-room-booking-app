<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
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
