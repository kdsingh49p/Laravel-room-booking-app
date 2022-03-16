<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Options;

class OptionsController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $options = Options::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.options.index', compact('options'));
    }
	public function show($optionsId)
    {
        $options = Options::find($optionsId);
        return view('admin.options.show', compact('options'));
    }
    public function create()
    {
         return view('admin.options.create');
    }

    public function store(Request $request){

        $this->validate($request, [
        	'option_name'  => 'required|max:240',
        	'option_value'  => 'string|max:240',
 	        'option_type' => 'string|max:40',
            'option_img_value' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
         ]);
         
        $requestData = $request->all();
        if ($request->hasFile('option_img_value')) {
            if ($request->file('option_img_value')->isValid()) {
            	$requestData['option_type'] = 'image';
                $fileNewName = \App\components\CheckOptions::generateRandomString().".".$request->file('option_img_value')->getClientOriginalExtension();
                $destinationPath =  base_path().'//uploads/';
                $requestData['option_img_value']= $fileNewName;
                $request->file('option_img_value')->move($destinationPath, $fileNewName);
            }
         }
        
        $save =  Options::create($requestData);
        return redirect('/admin/options/index')->with('success','options created successfully');
    }
    public function update($optionsId){
        return view('admin.options.update')->with('options', Options::find($optionsId));
    }

    public function edit(Request $request, $optionsId){
         $this->validate($request, [
            'option_name'  => 'required|max:240',
        	'option_value'  => 'string|max:240',
 	        'option_type' => 'string|max:40',
            'option_img_value' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);
        $optionsModel = Options::find($optionsId);
        $requestData = $request->all();
        if ($request->hasFile('option_img_value')) {
            if ($request->file('option_img_value')->isValid()) {
            	if($optionsModel->option_img_value!=NULL){
		        	if(file_exists(base_path().'//uploads/'.$optionsModel->option_img_value)){
		        		unlink(base_path().'//uploads/'.$optionsModel->option_img_value);	
		        	}
		        }
       			$requestData['option_type'] = 'image';
                $fileNewName = \App\components\CheckOptions::generateRandomString().".".$request->file('option_img_value')->getClientOriginalExtension();
                $destinationPath =  base_path().'//uploads/';
                $requestData['option_img_value']= $fileNewName;
                $request->file('option_img_value')->move($destinationPath, $fileNewName);
            }
         }
        
        $optionsModel->update($requestData);
        return redirect('/admin/options/show/'.$optionsId)->with('success','options updated successfully');
    }

    public function destroy(Options $options)
    {
        if($options->option_img_value!=NULL){
            if(file_exists(base_path().'//uploads/'.$options->option_img_value)){
                unlink(base_path().'//uploads/'.$options->option_img_value);
            }
        }
        $options->delete();
        return redirect('/admin/options/index');
    }
}
