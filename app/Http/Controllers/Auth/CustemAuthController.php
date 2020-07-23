<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class CustemAuthController extends Controller
{
    public function adolt(){
        return view('custemAuth.index');
    }

    public function getsite(){
        return view('site');
    }
    
    public function getadmin(){
        return view('admin');
    }
    

    public function adminLogin(){
        return view('auth.adminlog');
    }

    public function chackAdmin(Request $req){

        $this->validate($req , [
            'email'=>'required|email',
            'password'=>'required',
        ]);
        if (Auth::guard('admin')->attempt(['email'=> $req->email, 'password' => $req->password])) {
            return redirect()->intended('/admin');
        }
        return back()->withInput($req->only('email'));
    }
}
