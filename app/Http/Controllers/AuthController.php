<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showFormRegister(){
        return view('auth.form-register');
    }
    public function register(Request $request){
        $checkmail = User::where('email', $request->email)->first();
        if($checkmail != null){
            return redirect()->route('show-form-register')->with('errors', ['email' => 'Email đã được đăng kí']);
        }
        if($request->pass != $request->cfm_pass){
            return redirect()->route('show-form-register')->with('errors', ['pass' => 'Mật khẩu không giống nhau']);
        }
        $user = new User();
        $user->name = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($request->pass);
        $user->phone =  $request->phone;

        $user->save();
        return redirect()->route('show-form-login')->with('success','Đăng ký thành công');
    }
    public function showFormLogin(){
        return view('auth.form-login');
    }
    public function login(Request $request){   
        if(Auth::attempt(['email' => $request->email, 'password' => $request->pass])){
            $checkmail = User::where('email', $request->email)->first();
            $request->session()->put('id', $checkmail->id);
            return redirect()->route('show-form-uploadFile');
        }
        return redirect()->route('show-form-login')->with('error','Tài khoản hoặc mật khẩu không đúng');
    }
    public function logout(){
       session()->forget('id');
       return redirect()->route('show-form-login');
    }
}
