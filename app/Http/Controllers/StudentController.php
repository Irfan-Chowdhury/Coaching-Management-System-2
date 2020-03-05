<?php

namespace App\Http\Controllers;

use App\Batch;
use App\School;
use App\Student;
use App\ClassName;
use App\StudentType;
use App\StudentTypeDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


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

    //Student-Save
    public function studentSave(Request $request)
    {
        // return $request->all();

        // Created 1 row in student table
        $student = new Student();
        $student->student_name      = $request->student_name;
        $student->school_id         = $request->school_id;
        $student->class_id          = $request->class_id;
        $student->father_name       = $request->father_name;
        $student->father_mobile     = $request->father_mobile;
        $student->father_profession = $request->father_profession;
        $student->mother_name       = $request->mother_name;
        $student->mother_mobile     = $request->mother_mobile;
        $student->mother_profession = $request->mother_profession;
        $student->email_address     = $request->email_address;
        $student->sms_mobile        = $request->sms_mobile;
        $student->date_of_admission = $request->date_of_admission;
        // $student->student_photo     = $request->student_photo;
        $student->address           = $request->address;
        $student->status            = $request->status;
        $student->password          = $request->sms_mobile;
        $student->encrypted_password= Hash::make($request->sms_mobile);
        $student->user_id           = Auth::user()->id;
        $student->save();

        $studentId = $student->id;
        $batches   = $request->batch_id;
        $rolls     = $request->roll;

        $studentTypes = $request->student_type;
        
        // Created 1/2/3/.. row in student_type table
        foreach ($studentTypes as $key => $studentType) 
        {
            $data             = new StudentTypeDetail();
            $data->student_id = $studentId;
            $data->class_id   = $request->class_id;
            $data->type_id    = $key;
            $data->batch_id   = $batches[$key];
            $data->roll_no    = $rolls[$key];
            $data->type_status= 1;
            $data->save();
        }

        return back()->with('message','Registration Successful');

    }
}
