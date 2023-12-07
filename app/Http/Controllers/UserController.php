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

        $search = $r->input('search');

        $query = "SELECT * FROM pelanggan";

        if ($search) {
            $query .= " WHERE Nama LIKE '%$search%'";
        }

        $data = \DB::select($query);

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
            $queryStep1 = "DELETE FROM pelanggan WHERE deleted_at IS NOT NULL";
            $rowsDeletedStep1 = \DB::delete($queryStep1);

            \Log::info("Step 2: Deleted $rowsDeletedStep1 rows from pelanggan");

            $queryStep2 = "DELETE FROM transaksi 
                    WHERE ID_Pelanggan IS NOT NULL 
                    AND NOT EXISTS (
                        SELECT 1 FROM pelanggan 
                        WHERE pelanggan.ID_Pelanggan = transaksi.ID_Pelanggan
                    )";
            $rowsDeletedStep2 = \DB::delete($queryStep2);

            \Log::info("Step 1: Deleted $rowsDeletedStep1 rows from transaksi");

            if ($rowsDeletedStep1 > 0) {
                Alert::success('Hard Delete Berhasil', 'Data berhasil dihapus permanen.');
            } else {
                Alert::warning('Tidak ada data yang dihapus secara permanen.', 'Peringatan');
            }
        } catch (\Exception $e) {
            Alert::error('Terjadi kesalahan dalam menghapus data permanen: ' . $e->getMessage());
        }

        return redirect()->route('admin.home.user');
    }

    public function RestoreAll(Request $request)
    {
        try {
            $successFlag = false;

            $deletedRecords = \DB::select("
                SELECT *
                FROM pelanggan
                WHERE deleted_at IS NOT NULL
                ORDER BY deleted_at ASC
            ");

            foreach ($deletedRecords as $record) {
                Pelanggan::withTrashed()->find($record->ID_Pelanggan)->restore();
                $successFlag = true;
                break;
            }

            if ($successFlag) {
                Alert::success('Restore Berhasil');
            } else {
                Alert::error('Tidak ada data yang dapat direstore');
            }
        } catch (\Exception $e) {
            Alert::error('User Tidak Ditemukan');
        }

        return redirect()->route('admin.home.user');
    }
}
