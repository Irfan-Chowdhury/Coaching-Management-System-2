<?php

namespace App\Http\Controllers;
use App\ClassName;
use Illuminate\Http\Request;

class ClassManagementController extends Controller
{
    public function addClassForm()
    {
        return view('admin.settings.class.add-form');
    }
    
    public function classSave(Request $request)
    {
        $this->validate($request,[
            'class_name' =>'required|string'
        ]);

        $class = new ClassName();
        $class->class_name = $request->class_name;
        $class->status     = 1;
        $class->save();

        return back()->with('message','Class Added Successfully');
    }

    public function classList()
    {
        $classes = ClassName::all();
        return view('admin.settings.class.list',compact('classes'));
    }

    public function classUnpublished($id)
    {
        $class = ClassName::find($id);
        $class->status = 2;
        $class->save();

        return back()->with('error_message','Class Unpublished Sucessfully');
    }

    public function classPublished($id)
    {
        $class = ClassName::find($id);
        $class->status = 1;
        $class->save();

        return back()->with('success_message','Class Published Sucessfully');
    }

    public function classEditForm($id)
    {
        $class = ClassName::find($id);
        return view('admin.settings.class.edit-form',compact('class'));
    }

    public function classUpdate(Request $request, $id)
    {
        $class = ClassName::find($id);

        $class->class_name  = $request->class_name;
        $class->update();

        return redirect('class/list')->with('success_message','Class name updated successfully');   
    }

    public function classDelete($id)
    {
        $class = ClassName::find($id);

        $class->delete();

        return back()->with('error_message','Class deleted Successfully');   
    }
}
