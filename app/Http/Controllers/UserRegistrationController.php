<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;


class UserRegistrationController extends Controller
{
    public function showRegistrationForm()
    {
        return view('admin.users.registration-form');
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

        $users = User::all();  

        return view('admin.users.user-list',['users'=>$users]);

    }
}
