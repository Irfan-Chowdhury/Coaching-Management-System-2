<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slide;
use Image;


class SliderController extends Controller
{
    public function addSlide()
    {
        return view('admin.slider.slide-add-form');
    }

    public function uploadSlide(Request $request)
    {
        $this->validate($request,[
            'slide_image'       => 'required',
            'slide_title'       => 'required',
            'slide_description' => 'required',
            'status'            => 'required',
        ]);

        $data = new Slide();
        $data->slide_image = $this->createSlide($request);
        $data->slide_title = $request->slide_title;
        $data->slide_description = $request->slide_description;
        $data->status = $request->status;
        $data->save();

        return back()->with('message','New Slide Added Successfully');

    }

    protected function createSlide($request)
    {
        $file = $request->file('slide_image');
        $imageName = $file->getClientOriginalName();
        $directory = 'admin/assets/slider/';
        $imageUrl = $directory.$imageName;

        Image::make($file)->resize(1400,570)->save($imageUrl);
        
        return $imageUrl;
    }

    public function manageSlide()
    {
        $slides = Slide::all();

        return view('admin.slider.manage-slide',compact('slides'));
    }

    public function slideUnpublished($id)
    {
        $slide = Slide::find($id);
        $slide->status = 2;
        $slide->save();

        return redirect()->back()->with('error_message','Slide Unpublished Sucessfully');
    }
    
    public function slidePublished($id)
    {
        $slide = Slide::find($id);
        $slide->status = 1;
        $slide->save();

        return redirect()->back()->with('success_message','Slide Unpublished Sucessfully');
    }

    public function photoGallery()
    {
        $slides = Slide::all();

        return view('admin.slider.photo-gallery',compact('slides'));
    }
}
