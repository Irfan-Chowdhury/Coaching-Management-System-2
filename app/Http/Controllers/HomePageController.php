<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HeaderFooter;
use DB;
class HomePageController extends Controller
{
    public function addHeaderFooterForm()
    {
        //URL Access Protection

        $headerFooter = DB::table('header_footers')->first();

        if (isset($headerFooter)) {
            return view('admin.home.manage-header-footer-form',compact('headerFooter'));
        }
        else{
            return view('admin.home.add-header-footer-form');
        }
    }

    public function headerFooterValidation($request)
    {
        $this->validate($request,[
            'owner_name'       => 'required',
            'owner_department' => 'required',
            'mobile'           => 'required',
            'address'          => 'required',
            'copyright'        => 'required',
            'status'           => 'required',
        ]);
    }

    public function headerFooterSave(Request $request)
    {
        // return $request->all();
        $this->headerFooterValidation($request);
        
        $data = new HeaderFooter();
        $data->owner_name       = $request->owner_name;
        $data->owner_department = $request->owner_department;
        $data->mobile           = $request->mobile;
        $data->address          = $request->address;
        $data->copyright        = $request->copyright;
        $data->status           = $request->status;
        $data->save();

        return redirect('/home')->with('message','Header & Footer Added Successfully');
    }

    public function manageHeaderFooter($id)
    {
        $headerFooter = HeaderFooter::find($id);
        return view('admin.home.manage-header-footer-form',compact('headerFooter'));
    } 

    public function headerFooterUpdate(Request $request, $id)
    {
        
        $this->headerFooterValidation($request);

        $headerFooter = HeaderFooter::find($id);
        $headerFooter->owner_name       = $request->owner_name;
        $headerFooter->owner_department = $request->owner_department;
        $headerFooter->mobile           = $request->mobile;
        $headerFooter->address          = $request->address;
        $headerFooter->copyright        = $request->copyright;
        $headerFooter->status           = $request->status;
        $headerFooter->update();

        return redirect('/home')->with('message','Header & Footer Updated Successfully');
    }

    

}
