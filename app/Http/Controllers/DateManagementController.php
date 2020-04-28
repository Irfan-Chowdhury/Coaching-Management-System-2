<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Year;

class DateManagementController extends Controller
{
    public function addYear()
    {
        $currentYear = date('Y');
        // return $currentYear;

        $check       = Year::where('year','=',$currentYear)->get();
        if (count($check)>0)  //check new current date exist or not in database
        {
            return back()->with('error_message',"$currentYear already exists in database !!! Please try again in next year");
        }
        else //if not then save into database
        {
            $year         = new Year();
            $year->year   = $currentYear;    
            $year->status = 1;    
            $year->save();    
            return back()->with('message',"Year $currentYear added in database successfully.");

        }
    }
}
