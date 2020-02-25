<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use Image;

class UserRegistrationController extends Controller
{
    public function showRegistrationForm()
    {
        if (Auth::user()->role=="Admin") 
        {
            return view('admin.users.registration-form');
        }
        else {
            // return redirect('/home');
            return redirect()->back();
        }
    }

    public function userSave(Request $request)
    {
        $this->validator($request->all())->validate(); //include this line in top: use Illuminate\Auth\Events\Registered;

        event(new Registered($user = $this->create($request->all())));

        $users = User::all();  //include this line in top: use App\User;

        return view('admin.users.user-list',['users'=>$users]);

        // $this->guard()->login($user);

        // return $this->registered($request, $user)
        //                 ?: redirect($this->redirectPath());
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [   //include this line in top: use Illuminate\Support\Facades\Validator;
            'role'  => ['required'],
            'name'  => ['required', 'string', 'max:255'],
            'mobile'  => ['required', 'string', 'min:13', 'max:13'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        return User::create([          //include this line in top: use App\User;
            'role' => $data['role'],
            'name' => $data['name'],
            'mobile' => $data['mobile'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']), //include this line in top: use Illuminate\Support\Facades\Hash;
        ]);
    }

    public function userList()
    {

        if (Auth::user()->role=="Admin") 
        {
            $users = User::all();  

            return view('admin.users.user-list',['users'=>$users]);
        }
        else {
            // return redirect('/home');
            return redirect()->back();
        }


    }

    public function userProfile($userId)
    {
        $user = User::find($userId);

        return view('admin.users.profile',compact('user'));
        // return $user;
    }

    public function changeUserInfo($id)
    {
        $user = User::find($id);

        return view('admin.users.change-user-info',compact('user'));
    }

    // public function userInfoUpdate(Request $request,$id)
    public function userInfoUpdate(Request $request)
    {
        $this->validate($request,[
            'name'   => 'required|string|max:255',
            'mobile' => 'required|string|max:13|min:13',
            'email' => 'required|string|max:255|email'
        ]); 

        // $user = User::find($id);
        $user = User::find($request->user_id);
        $user->name   = $request->name;
        $user->mobile = $request->mobile;
        $user->email  = $request->email;

        $user->update();

        // return redirect("/user-profile/$id")->with('message','Data Updated Successfull.');
        return redirect("/user-profile/$request->user_id")->with('message','Data Updated Successfull.');
            // [note: any $varible suppurt in double cotation (""), but not in single cotation ('') ]
    }

    public function changeUserAvatar($id)
    {
        $user = User::find($id);

        return view('admin.users.change-user-avatar',compact('user'));
    }

    public function updateUserPhoto(Request $request, $id)
    {
        $user = User::find($id);

        $file = $request->file('avatar');
        $imageName = $file->getClientOriginalName();
        $directory = 'admin/assets/avatar/';
        $imageUrl = $directory.$imageName;
        // $file->move($directory,$imageUrl); //instead of this line I will use 'Image' Package

        Image::make($file)->resize(300,300)->save($imageUrl);

        $user->avatar = $imageUrl;
        $user->update();

        return redirect("user-profile/$id")->with('message','Photo Uploaded Successfully');

    }


}
