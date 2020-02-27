<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ClassName;
use App\Batch;
class BatchManagementController extends Controller
{
    public function addBatchForm()
    {
        $classes = ClassName::all();
        return view('admin.settings.batch.add-form',compact('classes'));
    }

    public function batchSave(Request $request)
    {
        $this->validate($request,[
            'class_id'   => 'required',
            'batch_name' => 'required',
        ]);

        $batch = new Batch();
        $batch->class_id   = $request->class_id;
        $batch->batch_name = $request->batch_name;
        $batch->status     = 1;

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
            'class_id' =>$request->id
        ])->get();

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
        $batch = Batch::find($request->batch_id);
        $batch->status = 1;
        $batch->save();

        $batches = Batch::where([
            'class_id' =>$request->class_id
        ])->get();

        return view('admin.settings.batch.batch-list-by-ajax',compact('batches'));
    }
    
    public function batchDelete(Request $request)
    {
        $batch = Batch::find($request->batch_id);
        $batch->delete();

        $batches = Batch::where([
            'class_id' =>$request->class_id
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
}
