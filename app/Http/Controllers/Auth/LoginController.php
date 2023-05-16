<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{   

    use AuthenticatesUsers;
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

    public function login(Request $request){

        $messages = [
            'Username/Email tidak boleh kosong!',
            'Password harus diisi minimal 6 karakter!'
        ];
        
        $this->validate($request, [
            'username' => 'required|string',
            'password' => 'required|string|min:6',
        ], $messages);

        $loginType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $login = [
            $loginType => $request->username,
            'password' => $request->password
        ];

        if(auth()->attempt($login)) {
            return redirect()->route('laporan.index');
        }

        return redirect()->route('login')->with(['error' => 'Email/password salah!']);
    }

    public function logout(Request $request){
        Auth::logout();

        return redirect()->route('login');
    }
}
