<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use function PHPUnit\Framework\returnSelf;

class LoginController extends Controller
{
    //
    public function index() {
        return view('auth.login');
    }

    public function login_process(Request $request) {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $data = [
            'email'     => $request->email,
            'password'  => $request->password,

        ];

        if (Auth::attempt($data)){
            return redirect()->route('admin.dashboard');
        }
        else {
            return redirect()->route('login')->with('failed', 'Maaf, Email dan Password Salah');    
        }
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Anda Telah Berhasil Logout');
    }

    public function register() {
        return view('auth.register');
    }

    public function register_process(Request $request) {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'email'=>'required|email|unique:users,email',
            'password' => 'required',
        ]);
        if ($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);
        $data['name'] = $request->nama;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);

        User::create($data);
       
        $login = [
            'email' => $request->email,
            'password' => $request->password
        ];
        if (Auth::attempt($login)) {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('login')->with('failed','email dan password salah');
        }
    
    }
}
