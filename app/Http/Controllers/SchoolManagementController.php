<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\School;
class SchoolManagementController extends Controller
{
    public function addSchoolForm()
    {
        return view('admin.settings.school.add-form');
    }

    public function schoolSave(Request $request)
    {
        $this->validate($request,[
            'school_name' => 'required|string'
        ]);

        $data = new School();
        $data->school_name  = $request->school_name;
        $data->status       = 1;
        $data->save();

        return back()->with('message','School Added Successfully');   
    }

    public function schoolList()
    {
        $schools = School::all();
        return view('admin.settings.school.list',compact('schools'));
    }

    public function schoolUnpublished($id)
    {
        $school = School::find($id);
        $school->status = 2;
        $school->save();

        return back()->with('error_message','School Unpublished Sucessfully');
    }
    
    public function schoolPublished($id)
    {
        $school = School::find($id);
        $school->status = 1;
        $school->save();

        return back()->with('success_message','School Published Sucessfully');
    }
    
    public function schoolEditForm($id)
    {
        $school = School::find($id);
        return view('admin.settings.school.edit-form',compact('school'));
    }
    
    public function schoolUpdate(Request $request, $id)
    {
        $school = School::find($id);

        $school->school_name  = $request->school_name;
        $school->update();

        return redirect('school/list')->with('success_message','School name updated successfully');   
    }
    
    public function schoolDelete($id)
    {
        $school = School::find($id);

        $school->delete();

        return back()->with('error_message','School Deleted Successfully');   
    }
}
