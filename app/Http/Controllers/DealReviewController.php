<?php

namespace App\Http\Controllers;

use App\DealReview;
use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class DealReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = DealReview::orderBy('created_at', 'desc')->paginate(4);
        return view('category.index', compact('categories'))->render();
    }
    public function active($id){
        $reviewModel = DealReview::where('review_id', $id)->first();
        if($reviewModel){
            $reviewModel->status = 10;
            $reviewModel->save();
            return [
                'status' => 'success',
            ];
        }
    }
    public function deal_review_report(Request $request){
            $reviews = DealReview::where('status', 0)
                        ->orderBy('created_at', 'DESC')
                        ->get();
    return view('admin.deal_review_report', compact('reviews'))->render();
    
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = DealReview::orderBy('created_at', 'desc')->get();
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
             'name'  => 'required|max:240',
             'email' => 'required|max:240',
             'review' => 'required|max:240',
             'deal_id' => 'required|max:240',
         ]);
 
        $requestData = $request->all();
        $return = [
            'status' => 'fail',
             'data' => [],
        ];
        $saveCategory =  DealReview::create($requestData);
        if($saveCategory){
            return $return = [
                'status' => 'success',
                'data' => $saveCategory,
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
         $updateCategory = DealReview::find($category);
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
             'data' =>  DealReview::find($CategoryId)->load('parent_category'),
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

        $categoryModelCheckParent = DealReview::where('parent_id', $CategoryId)->first();
        if (!$categoryModelCheckParent) {
            $categoryModel = DealReview::find($CategoryId);
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
