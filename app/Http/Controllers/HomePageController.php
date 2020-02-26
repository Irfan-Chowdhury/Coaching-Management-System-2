<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HeaderFooter;

class HomePageController extends Controller
{
    public function addHeaderFooterForm()
    {
        return view('admin.users.add-header-footer-form');
    }

    public function headerFooterSave(Request $request)
    {
        // return $request->all();
        $this->validate($request,[
            'owner_name'       => 'required',
            'owner_department' => 'required',
            'mobile'           => 'required',
            'address'          => 'required',
            'copyright'        => 'required',
            'status'           => 'required',
        ]);
        
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
}
