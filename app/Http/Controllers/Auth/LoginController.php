<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    public function showLoginForm() //when composer update, then all code in AuthenticateUsers will setup default code like previuosly
    {
        // return view('auth.login');

        $users = User::all();
        
        if(count($users)>0)
        {
            return view('admin.users.login-form');
        }
        else {
            $user = new User();
            $user->role = "Admin";
            $user->name = "Admin";
            $user->mobile = "8801829498634";
            $user->email = "admin@gmail.com";
            $user->password = Hash::make('admin@gmail.com');
            $user->save();

            return view('admin.users.login-form');

        }

    }

    public function username()
    {
        // return 'email';
        return 'mobile';
    }

    protected function loggedOut(Request $request)
    {
        return redirect('/home');  //in video:  /home
        // return redirect('/login');
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

}
