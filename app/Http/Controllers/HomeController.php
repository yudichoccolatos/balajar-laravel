<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function dashboard() {
        return view('dashboard');
    }

    public function index() {
        return view('home.index');
    }

    public function about() {
        return view('home.about');
    }

    public function shop() {
        return view('home.shop');
    }

    public function create() {
        return view ('backend/create');
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|mimes:png, jpg, jpeg|2048',
            'email'=>'required|email',
            'password' => 'required',
            'photo' => 'required',
        ]);
        if ($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);
        $data['name'] = $request->nama;
        $data['email'] = $request->email;
        $data['password'] =  Hash::make($request->password);
        $data['image'] = $request->photo;

        User::create($data);
        return redirect()-> route('index');
    }

    public function edit (Request $request, $id) {
        $data = User::find($id);
        return view ('backend/edit', compact('data'));
    }

    public function update (Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'email'=>'required|email',
            'password' => 'nullable',
        ]);
        if ($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);
        $data['name'] = $request->nama;
        $data['email'] = $request->email;
        if ($request->password) {
            $data['password'] =  Hash::make($request->password);
        }
        

        User::whereId($id)->update($data);
        return redirect()-> route('user');  
    }

    public function delete (Request $request, $id) {
        $data= User::find($id);
        if($data){
            $data->delete();
        } 
        return redirect()-> route('admin.user'); 
    }
}