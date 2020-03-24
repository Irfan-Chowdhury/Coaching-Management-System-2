<?php

namespace App\Http\Controllers;

use DB;
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
            $data->student_id = $studentId;   // This is: $studentId = $student->id;
            $data->class_id   = $request->class_id;
            $data->type_id    = $key;
            $data->batch_id   = $batches[$key]; // $batches   = $request->batch_id;
            $data->roll_no    = $rolls[$key];   // $rolls     = $request->roll;
            $data->type_status= 1;
            $data->save();
        }

        return back()->with('message','Registration Successful');
    }

    //All Running Student List start
    public function allRunningStudentList()
    {
        // $students = Student::where('status','1')->get();
        $students = DB::table('students')
                    ->join('schools','students.school_id','=','schools.id')
                    ->join('class_names','students.class_id','=','class_names.id')
                    ->select('students.*','schools.school_name','class_names.class_name')
                    ->where([
                        'students.status'=>1
                    ])->orderBy('students.class_id','ASC')->get();

        // return $students;
        return view('admin.student.all-running-student-list',compact('students'));
    }


    //Class Wise Student List start
    public function classSelectionForm()
    {
        $classes = ClassName::where('status','1')->get();
        return view('admin.student.class.class-selection-form',compact('classes'));
    }

    public function classStudentType(Request $request)
    {
        $types    = StudentType::where([
                    'class_id' => $request->class_id,
                    'status'   => 1
                ])->get();

        return view('admin.student.class.student-type',compact('types'));
    }

    public function classAndTypeWiseStudent(Request $request)
    {
        $students = DB::table('students')  //remember : I exchange the data around equal just left-right compare with video 
            ->join('schools','schools.id','=','students.school_id')
            ->join('student_type_details','student_type_details.student_id','=','students.id')
            ->join('batches','batches.id','=','student_type_details.batch_id')
            ->select('students.*','schools.school_name','student_type_details.roll_no','batches.batch_name')
            ->where([
                'students.status'                  => 1,
                'students.class_id'                => $request->class_id,
                'student_type_details.type_id'     => $request->type_id,
                'student_type_details.type_status' => 1,
            // ])->get(); //testing for Console

            ])->orderBy('student_type_details.roll_no','ASC')->get();

        // return $students; //testing for Console
        return view('admin.student.class.student-list',compact('students'));
    }

    public function studentDetails($id)
    {
        $students = $this->getSingleStudent($id);

        return view('admin.student.details.profile',compact('students'));
    }

    protected function getSingleStudent($id)
    {
        $students = DB::table('students') //remember : I exchange the data around equal just left-right compare with video
                    ->join('schools','schools.id','=','students.school_id')
                    ->join('class_names','class_names.id','=','students.class_id')
                    ->join('student_type_details','student_type_details.student_id','=','students.id')
                    ->join('student_types','student_types.id','=','student_type_details.type_id')
                    ->join('batches','batches.id','=','student_type_details.batch_id')
                    ->select('students.*','schools.school_name','student_type_details.roll_no','batches.batch_name','class_names.class_name','student_types.student_type')
                    ->where([
                        'students.status' => 1,
                        'students.id'     => $id,
                    ])->orderBy('student_type_details.type_id','ASC')->get();
        
        return $students;
    }
}
