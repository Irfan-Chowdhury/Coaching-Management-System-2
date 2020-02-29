<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StudentType;
use App\ClassName;
use App\Batch;
use DB;

class BatchManagementController extends Controller
{
    public function addBatchForm()
    {
        $classes = ClassName::all();
        return view('admin.settings.batch.add-form',compact('classes'));
    }

    public function classWiseStudentType(Request $request)
    {
        $student_types = StudentType::where('status','!=',3)
                                    ->where('class_id',$request->class_id)
                                    ->get();
        return view('admin.settings.batch.class-wise-student-type',compact('student_types'));
    }

    public function batchSave(Request $request)
    {
        $this->validate($request,[
            'class_id'         => 'required',
            'student_type_id'  => 'required',
            'batch_name'       => 'required',
            'student_capacity' => 'required',
        ]);

        $batch = new Batch();
        $batch->class_id        = $request->class_id;
        $batch->student_type_id = $request->student_type_id;
        $batch->batch_name      = $request->batch_name;
        $batch->student_capacity= $request->student_capacity;
        $batch->status          = 1;

        $batch->save();

        return back()->with('message','Batch added successfully');
    }

    public function batchList()
    {
        $classes = ClassName::all();
        return view('admin.settings.batch.batch-list',compact('classes'));
    }

    public function batchListByAjax(Request $request)
    {
        $batches = Batch::where([
                            'class_id'        =>$request->class_id,
                            'student_type_id' =>$request->student_type_id,
                        ])
                        ->where('status','!=','3')
                        ->get();

        if (count($batches)>0) {
            return view('admin.settings.batch.batch-list-by-ajax',compact('batches'));
        }
        else {
            return view('admin.settings.batch.batch-empty-error');
        }

        // return view('admin.settings.batch.batch-list-by-ajax',compact('batches'));
    }

    public function batchUnpublished(Request $request)
    {
        $batch = Batch::find($request->batch_id);
        $batch->status = 2;
        $batch->save();

        $batches = Batch::where([
            'class_id' =>$request->class_id
        ])->get();

        return view('admin.settings.batch.batch-list-by-ajax',compact('batches'))->with('message','Batch unpublished successfully');
    }

    public function batchPublished(Request $request)
    {
        $batch = Batch::find($request->batch_id); //request from Ajax
        $batch->status = 1;
        $batch->save();

        $batches = Batch::where([
            'class_id' =>$request->class_id //request from Ajax
        ])->get();

        return view('admin.settings.batch.batch-list-by-ajax',compact('batches'));
    }
    
    public function batchDelete(Request $request)
    {
        $batch = Batch::find($request->batch_id); //request from Ajax
        $batch->delete();

        $batches = Batch::where([
            'class_id' =>$request->class_id //request from Ajax
        ])->get();

        if (count($batches)>0) 
        {
            return view('admin.settings.batch.batch-list-by-ajax',compact('batches'));
        }
        else 
        {
            return view('admin.settings.batch.batch-empty-error');
        }
    }

    public function batchEdit($id)
    {
        $batch_student_type_id_and_type = DB::table('batches')
                                    ->join('student_types','student_types.id','=','batches.student_type_id')
                                    ->select('batches.student_type_id','student_types.student_type')
                                    ->where('batches.id','=', $id)
                                    ->first(); 

        $batch = Batch::find($id);
        $classes = ClassName::all();
        return view('admin.settings.batch.edit-form',compact('batch','classes','batch_student_type_id_and_type'));
    }

    public function batchUpdate(Request $request,$id)
    {
        $this->validate($request,[
            'class_id'         => 'required',
            'batch_name'       => 'required',
            'student_capacity' => 'required',
        ]);

        $batch = Batch::find($id);
        $batch->class_id         = $request->class_id;
        $batch->student_type_id  = $request->student_type_id;
        $batch->batch_name       = $request->batch_name;
        $batch->student_capacity = $request->student_capacity;
        $batch->update();

        return back()->with('message','Batch Updated successfully');
    }
}
