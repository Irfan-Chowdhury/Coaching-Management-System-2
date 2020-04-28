<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ClassName;
use App\Year;
use App\StudentAttendance;
use DB;
use Auth;

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
        $today = date('Y-m-d');
        $checkAttendance = StudentAttendance::where([
            'class_id' => $request->class_id,
            'type_id'  => $request->type_id,
            'batch_id' => $request->batch_id,
        ])->whereDate('created_at',$today)->get();

        if (count($checkAttendance) > 0) //ডাটাবেজে অলরেডি Attendance আছে কিনা চেক করবে, থাকলে Error দেখাবে
        {
            return view('admin.student.attendance.attendance-error'); //session দিলে পেজ ভেঙ্গে যায় যেহেতু এটা Ajax এর মাধ্যমে <div id="studentList"> </div> লোড হচ্ছে তাই ওটার মেসেজ একটা blade এ দিলাম 
        }
        else{ //যদি এটেন্ডেন্স না নিয়ে থাকে তাহলে এটেন্ডেন্স নেয়ার জন্য ফর্মটা দেখাবে 

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
    }

    public function saveStudentAttendance(Request $request)
    {
        $today = date('Y-m-d');
        $checkAttendance = StudentAttendance::where([
            'class_id' => $request->class_id,
            'type_id'  => $request->type_id,
            'batch_id' => $request->batch_id,
        ])->whereDate('created_at',$today)->get();

        if (count($checkAttendance) > 0) //ডাটাবেজে অলরেডি Attendance আছে কিনা চেক করবে, থাকলে Error দেখাবে || //এখানে কন্ডিশনটা আবার চেক করা হইছে কারণ Google Chrome সাবমিট করার পর আবার পিছনে বেক করলে পেজ ক্লিয়ার হয়ে যায় কিন্তু Mozila Firefox এ সেটা হয়না, যার কারণে কন্ডিশন দিয়ে চেক করা 
        {
            return redirect()->back()->with('error_message','Attendance Already Submitted !!!');
        }
        else{ 
            $this->saveAttendance($request); //got to saveAttendance() method
            return redirect()->back()->with('message','Attendance Submitted Successfully!!!');
        }
    }

    protected function saveAttendance($request)
    {   
        $session     = $request->academic_session;
        $classId     = $request->class_id;
        $typeId      = $request->type_id;
        $batchId     = $request->batch_id;
        $attendances = $request->attendance; //attendance[{{$student->id}}]
        $userId      = Auth::user()->id; //who operate this attendance manage

        foreach ($attendances as $studentId => $attendance) {  //মাল্টিপল ইমেজের মত Array মধ্যে ঢুকায় ঐ Array তে যতগুলা Item আছে ততগুলাই এক ক্লিকে ডাটাবেজে স্টোর হবে। 
            $data                   = new StudentAttendance();
            $data->academic_session = $session;
            $data->class_id         = $classId;
            $data->type_id          = $typeId;
            $data->batch_id         = $batchId;
            $data->student_id       = $studentId; //student_id=1,2,3 ....
            $data->attendance       = $attendance; //attendance1= 1, attendance2= 1, attendance3= 2 .....
            $data->user_id          = $userId; //student_id
            $data->save();
        }
    }   
}
