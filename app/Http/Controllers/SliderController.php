<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Slider;
use Validator;
class SliderController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $slider = Slider::orderBy('created_at', 'desc')->paginate(4);
        return view('admin.slider.index', compact('slider'));
    }

    public function show($slide)
    {
        $slide = Slider::find($slide);
        return view('admin.slider.show', compact('slide'));
    }

     public function create()
    {
         return view('admin.slider.create');
    }

    public function store(Request $request){

        $this->validate($request, [
            'title1' => 'required|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
 
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
        $save =  Slider::create($requestData);
        return redirect('/admin/slider/index')->with('success','Slide created successfully');
    }

    public function update($slide){
        return view('admin.slider.update')->with('slider', Slider::find($slide));
    }

    public function edit(Request $request, $slide){
         $this->validate($request, [
            'title1' => 'required|max:50',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);
        $slideModel = Slider::find($slide);
        $requestData = $request->all();
        if ($request->hasFile('image')) {
            if ($request->file('image')->isValid()) {
                if($slideModel->image!=NULL){
                    if(file_exists(base_path().'//uploads/'.$slideModel->image)){
                        unlink(base_path().'//uploads/'.$slideModel->image);
                    }
                }
                $fileNewName = \App\components\CheckOptions::generateRandomString().".".$request->file('image')->getClientOriginalExtension();
                $destinationPath =  base_path().'//uploads/';
                $requestData['image']= $fileNewName;
                $request->file('image')->move($destinationPath, $fileNewName);
            }
         }
        $slideModel->update($requestData);
        return redirect('/admin/slider/show/'.$slide)->with('success','Slide updated successfully');
    }

    public function destroy(Slider $slide)
    {
        if($slide->image!=NULL){
            if (file_exists(base_path().'//uploads/'.$slide->image)) {
                unlink(base_path().'//uploads/'.$slide->image);
            }
        }
        $slide->delete();
        return redirect('/admin/slider/index');
    }
}