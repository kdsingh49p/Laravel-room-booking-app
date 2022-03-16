<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;
use App\Options;
use App\Http\Requests;

class MenuController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $menu = Menu::orderBy('created_at', 'desc')->paginate(4);
        return view('admin.menu.index', compact('menu'));
    }
	public function show($menuId)
    {
        $menu = Menu::find($menuId);
        return view('admin.menu.show', compact('menu'));
    }
    public function create()
    {
         return view('admin.menu.create');
    }

    public function store(Request $request){

        $this->validate($request, [
        	'title'  => 'required|max:240',
	        'slug' => 'string|max:240',
	        'parent_id' => 'integer',
            'page_title' => 'required|max:40',
	        'page_type' => 'required|max:40',
	        'page_description' => 'required|max:70',
	        'keywords' => 'required|max:240',
	    	'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
 
        ]);
        $requestData = $request->all();
        if ($request->hasFile('image')) {
            if ($request->file('image')->isValid()) {
                $fileNewName = \App\components\CheckOptions::generateRandomString().".".$request->file('image')->getClientOriginalExtension();
                $destinationPath =  base_path().'//uploads/';
                $requestData['image']= $fileNewName;
                $request->file('image')->move($destinationPath, $fileNewName);
            }
         }
        $requestData['slug'] = strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $requestData['title']));
        $save =  Menu::create($requestData);
        return redirect('/admin/menu/index')->with('success','Menu created successfully');
    }
    public function update($menuId){
        return view('admin.menu.update')->with('menu', Menu::find($menuId));
    }

    public function edit(Request $request, $menuId){
         $this->validate($request, [
            'title'  => 'required|max:240',
	        'slug' => 'max:240',
 	        'parent_id' => 'integer',
	        'page_title' => 'required|max:40',
            'page_type' => 'required|max:40',
            'page_description' => 'required|max:70',
	        'keywords' => 'required|max:240',
	    	'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);
        $menuModel = Menu::find($menuId);
        $requestData = $request->all();
        if ($request->hasFile('image')) {
            if ($request->file('image')->isValid()) {
                if($menuModel->image!=NULL){
                    if(file_exists(base_path().'//uploads/'.$menuModel->image)){
                        unlink(base_path().'//uploads/'.$menuModel->image);   
                    }
                }
                $fileNewName = \App\components\CheckOptions::generateRandomString().".".$request->file('image')->getClientOriginalExtension();
                $destinationPath =  base_path().'//uploads/';
                $requestData['image']= $fileNewName;
                $request->file('image')->move($destinationPath, $fileNewName);
            }
         }
        
       	$requestData['slug'] = strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $requestData['title']));
        $menuModel->update($requestData);
        return redirect('/admin/menu/show/'.$menuId)->with('success','Menu updated successfully');
    }

    public function destroy(Menu $menu)
    {
        if($menu->image!=NULL){
            if(file_exists(base_path().'//uploads/'.$menu->image)){
                unlink(base_path().'//uploads/'.$menu->image);
            }
        }
        $menu->delete();
        return redirect('/admin/menu/index');
    }
}
