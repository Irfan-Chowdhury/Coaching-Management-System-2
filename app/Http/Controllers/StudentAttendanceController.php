<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ClassName;
use App\Year;
use DB;

class StudentAttendanceController extends Controller
{
    public function batchSelectionFormForAttendanceAdd()
    {
        $classes = ClassName::where('status','=',1)->get();
        $years   = Year::where('status','=',1)->get();

        return view('admin.student.attendance.batch-selection-form-for-attendance-add',compact('classes','years'));
    }

    public function batchWiseStudentListForAttendance(Request $request)
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
                'student_type_details.batch_id'    => $request->batch_id,
                'student_type_details.type_status' => 1,
            ])->orderBy('student_type_details.roll_no','ASC')->get();

        // return $students;
        return view('admin.student.attendance.student-list-for-attendance-add',compact('students'));
    }

    public function saveStudentAttendance(Request $request)
    {
        return $request->all();
    }
}
