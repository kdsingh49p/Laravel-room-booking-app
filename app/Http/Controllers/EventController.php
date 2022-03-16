<?php

namespace App\Http\Controllers;

use App\tbl_event;
use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listevent(){
        $events = tbl_event::orderBy('created_at', 'desc')->paginate(10);
        return view('eventlist', compact('events'));
    }
    public function index()
    {
        $event = tbl_event::orderBy('created_at', 'desc')->paginate(4);
        return view('admin.event.index', compact('event'))->render();
    }
    public function event_view($slug){
        $event = tbl_event::where('slug', $slug)->first();
        return view('eventdtl', compact('event'));
    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('admin.event.create');
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
             'event_title'  => 'unique:tbl_event,event_title,NULL,event_id,deleted_at,NULL|required|max:240',
              'map' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
             'event_photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

          ]);
      
 
        $requestData = $request->all();
        $requestData['slug'] = strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $requestData['event_title']));

        if ($request->hasFile('map')) {
            if ($request->file('map')->isValid()) {
                $map_img = time().".".$request->file('map')->getClientOriginalExtension();
                $destinationPath =  base_path().'//uploads/';
                $requestData['map']= $map_img;
                $request->file('map')->move($destinationPath, $map_img);
            }
         } 
         if ($request->hasFile('event_photo')) {
            if ($request->file('event_photo')->isValid()) {
                $event_photo_img = time().".".$request->file('event_photo')->getClientOriginalExtension();
                $destinationPath =  base_path().'//uploads/';
                $requestData['event_photo']= $event_photo_img;
                $request->file('event_photo')->move($destinationPath, $event_photo_img);
            }
         }     
        $save_event =  tbl_event::create($requestData);
        if($save_event){
            return $return = [
                'status' => 'success',
                'data' => $save_event,
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
             'title' => 'required|max:240|unique:tbl_event,title,'.$category.',category_id',
             'slug' => 'required|max:240|unique:tbl_event,slug,'.$category.',category_id',

         ]);
        // Validator::make($data, [
        //     'slug' => [
        //         'required',
        //         Rule::unique('tbl_event')->ignore($category),
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

        $categoryModelCheckParent = tbl_event::where('parent_id', $CategoryId)->first();
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
