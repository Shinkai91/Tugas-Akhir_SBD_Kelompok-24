<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Alert;
use App\Models\Pelanggan;

class UserController extends Controller
{
    public function ViewAdminUser(Request $r)
    {
        $role_check = $r->session()->get('role');

        if (!$r->session()->has('username') || $role_check !== 'admin') {
            return redirect(route('admin.login.view'));
        }
        $data = \DB::select("SELECT * FROM pelanggan");

        return view('admin.user.data', [
            'data_user' => $data
        ]);
    }

    public function EditUser(Request $r, $id)
    {
        $role_check = $r->session()->get('role');

        if (!$r->session()->has('username') || $role_check !== 'admin') {
            return redirect(route('admin.login.view'));
        }

        $data = \DB::select("SELECT * FROM pelanggan WHERE ID_Pelanggan = '$id'");
        if (count($data) === 0) {
            return redirect(route('admin.home.user'));
        }
        return view('admin.user.edit', [
            'data' => $data[0]
        ]);
    }

    public function UpdateUser(Request $r)
    {
        $role_check = $r->session()->get('role');

        if (!$r->session()->has('username') || $role_check !== 'admin') {
            return redirect(route('admin.login.view'));
        }

        // Validasi input
        if (empty($r->username) || empty($r->no_telp) || empty($r->Nama) || empty($r->alamat) || empty($r->password)) {
            // Jika ada input kosong
            Alert::error('Update Gagal', 'Harap lengkapi semua field.');
            return redirect(route('admin.home.user'));
        }

        // Cek apakah ada data yang sama
        $existingUser = \DB::select("
        SELECT *
        FROM pelanggan
        WHERE username = ? AND ID_Pelanggan <> ?
    ", [$r->username, $r->id]);

        if ($existingUser) {
            // Jika data yang sama ditemukan
            Alert::error('Update Gagal', 'Username sudah digunakan oleh user lain.');
            return redirect(route('admin.home.user'));
        }

        // Lanjutkan dengan update jika validasi berhasil
        $id_pelanggan = $r->id;
        $nama = $r->Nama;
        $username = $r->username;
        $password = $r->password;
        $no_telp = $r->no_telp;
        $alamat = $r->alamat;

        $updateResult = \DB::update("
        UPDATE pelanggan
        SET Nama = ?, username = ?, password = ?, no_telp = ?, alamat = ?
        WHERE ID_Pelanggan = ?
    ", [$nama, $username, $password, $no_telp, $alamat, $id_pelanggan]);

        if ($updateResult) {
            // Jika update berhasil
            Alert::success('Update Berhasil', 'Data user berhasil diperbarui.');
        } else {
            // Jika update gagal
            Alert::error('Update Gagal', 'Terjadi kesalahan saat memperbarui data user.');
        }

        return redirect(route('admin.home.user'));
    }

    public function DeleteUser(Request $r, $id)
    {
        $role_check = $r->session()->get('role');

        if (!$r->session()->has('username') || $role_check !== 'admin') {
            return redirect(route('admin.login.view'));
        }

        $pelanggan = Pelanggan::find($id);

        if (!$pelanggan) {
            Alert::error('User Tidak Ditemukan');
            return redirect(route('admin.home.user'));
        }

        Alert::success('User Berhasil Dihapus');
        $pelanggan->update(['deleted_at' => now()]);

        return redirect(route('admin.home.user'));
    }

    public function hardDeleteAll(Request $request)
    {
        try {
            $softDeletedRecords = Pelanggan::onlyTrashed()->get();
            $successFlag = false;

            foreach ($softDeletedRecords as $record) {
                if ($record->deleted_at !== null) {
                    $record->forceDelete();
                    $successFlag = true; // Set flag to true if at least one record is successfully deleted
                }
            }

            if ($successFlag) {
                Alert::success('Hard Delete Berhasil');
            } else {
                Alert::error('Hard Delete Gagal');
            }
        } catch (\Exception $e) {
            Alert::error('User Tidak Ditemukan');
        }

        return redirect()->route('admin.home.user');
    }
}
