<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Alert;

class LoginController extends Controller
{
    public function ViewUserLogin(Request $r)
    {
        $role_check = $r->session()->get('role');
        if ($r->session()->has('username') && $role_check === 'user') {
            $user = session()->get('nama');
            Alert::info('Sudah Login', 'Anda sudah login dengan user ' . $user);
            return redirect(route('user.home'));
        }

        return view('user.login');

    }

    public function AuthUserLogin(Request $r)
    {
        $role_check = $r->session()->get('role');
        if ($r->session()->has('username') && $role_check === 'user') {
            return redirect(route('user.home'));
        }

        $username = $r->input('username');
        $password = $r->input('password');

        $users = \DB::select("SELECT * FROM pelanggan WHERE username = ? AND password = ?", [$username, $password]);

        if (count($users) > 0) {
            // Authentication successful
            session([
                'id' => $users[0]->ID_Pelanggan,
                'nama' => $users[0]->Nama,
                'username' => $users[0]->username,
                'phone' => $users[0]->no_telp,
                'role' => 'user'
            ]);

            // Display success alert
            Alert::success('Login Berhasil', 'Selamat datang, ' . $users[0]->Nama . '!');
            return redirect(route('user.home'));
        }

        // Authentication failed
        Alert::error('Login Gagal', 'Username atau password salah.');

        return redirect(route('user.login.auth'));
    }

    public function ViewUserRegister(Request $r)
    {
        $role_check = $r->session()->get('role');
        if ($r->session()->has('username') && $role_check === 'user') {
            $user = session()->get('nama');
            Alert::info('Sudah Login', 'Anda sudah login dengan user ' . $user);
            return redirect(route('user.home'));
        }
        return view('user.register');
    }

    public function AuthUserRegister(Request $r)
    {
        $role_check = $r->session()->get('role');
        if ($r->session()->has('username') && $role_check === 'user') {
            return redirect(route('user.home'));
        }

        $r->validate([
            'username' => 'required|unique:pelanggan,username',
            'phone' => 'required',
            'alamat' => 'required',
            'nama_user' => 'required',
            'password' => 'required',
        ]);

        Alert::success('Daftar Berhasil', 'Silahkan login');

        \DB::insert("
            INSERT INTO pelanggan (Nama, username, password, no_telp, alamat, created_at, deleted_at) 
            VALUES (?, ?, ?, ?, ?, NOW(), NULL)
        ", [
            $r->input('nama_user'),
            $r->input('username'),
            $r->input('password'),
            $r->input('phone'),
            $r->input('alamat'),
        ]);

        return redirect(route('user.home'));
    }


    public function ViewAdminLogin(Request $r)
    {
        $role_check = $r->session()->get('role');
        if ($r->session()->has('username') && $role_check === 'admin') {
            return redirect(route('admin.home'));
        }
        return view('admin.login');
    }

    public function AuthAdminLogin(Request $r)
    {
        $role_check = $r->session()->get('role');
        if ($r->session()->has('username') && $role_check === 'admin') {
            return redirect(route('admin.home'));
        }

        $username = $r->input('username');
        $password = $r->input('password');

        $admin = \DB::select("SELECT * FROM admin WHERE username = ? AND password = ?", [$username, $password]);

        if (count($admin) > 0) {
            // Authentication successful
            session([
                'id' => $admin[0]->ID_Admin,
                'username' => $admin[0]->username,
                'nama' => $admin[0]->nama,
                'role' => 'admin'
            ]);

            // Display success alert
            Alert::success('Login Berhasil', 'Selamat datang, ' . $admin[0]->nama . '!');
            return redirect(route('admin.home'));
        }

        // Authentication failed
        Alert::error('Login Gagal', 'Username atau password salah.');

        return redirect(route('admin.login.auth'));
    }

    public function logout(Request $r)
    {
        $role = $r->session()->get('role');

        $r->session()->flush();

        return redirect('/');
    }
}
