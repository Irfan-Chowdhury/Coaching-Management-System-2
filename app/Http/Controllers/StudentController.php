<?php

namespace App\Http\Controllers;

use App\Batch;
use App\School;
use App\ClassName;
use App\StudentType;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function studentRegistrationForm()
    {
        $schools = School::where('status','=','1')->get();
        $classes = ClassName::where('status','1')->get(); //another technic
        
        return view('admin.student.registration.registration-form',compact('schools','classes'));
    }

    public function birngStudentType(Request $request)
    {
        $types = StudentType::where('class_id','=',$request->class_id)->get();
        $classes = ClassName::where('status','1')->get(); 

        return view('admin.student.registration.student-type',[
                            'types'   =>$types,
                            'classes' =>$classes,
                            'data'    =>$request, //use for selected dropdown
                        ]);
    }


    public function batchRollForm(Request $request)
    {
        $batches = Batch::where([
                            'class_id'        => $request->class_id,
                            'student_type_id' => $request->student_type_id,
                        ])->get();
                
        $type = StudentType::find($request->student_type_id); //in video just type "type_id"

        return view('admin.student.registration.batch-roll-form',compact('batches','type'));
    }
}
