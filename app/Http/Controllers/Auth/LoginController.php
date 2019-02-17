<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\User;

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

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'login';
    }

    public function login()
    {

        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $v = Validator::make($request->all(), [
            'login'   => 'required|unique:users',
            'password' => 'required'
        ]);
        if($v->fails()) {
            return response()->json(['message'=>$v->errors()->first('login')],201);
        }
        $login = $request->login;
        $password = $request->password;

        if (Auth::attempt(['login' => $login, 'password' => $password])) {
            return response()->json(['message'=>'user logined'],200);
        }else{
            try{
                $user = User::create([
                    'login' => $login,
                    'password' => bcrypt($password),
                ]);
                Auth::login($user, true);
                return response()->json(['message'=>'user created'],200);
            }catch (\Exception $e)
            {
                return response()->json(['message'=>'error, user not created'],400);
            }
        }
    }

    public function logout()
    {
        Auth::logout();
    }
}
