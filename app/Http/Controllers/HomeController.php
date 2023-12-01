<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function HomeUser(Request $r){
        $role_check = $r->session()->get('role');

        if (!$r->session()->has('username') || $role_check !== 'user' ) {
            return view('welcome');
        }
        return view ('user.home');
    }
    
    public function HomeAdmin(Request $r){
        $role_check = $r->session()->get('role');

        if (!$r->session()->has('username') || $role_check !== 'admin' ) {
            return redirect(route('admin.login.view'));
        }
        return view ('admin.home');
    }
}
