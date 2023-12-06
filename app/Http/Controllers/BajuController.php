<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Alert;
use App\Models\Baju;

class BajuController extends Controller
{
    public function ViewBaju(Request $r)
    {
        $role_check = $r->session()->get('role');

        if (!$r->session()->has('username') || $role_check !== 'admin') {
            return redirect(route('admin.login.view'));
        }

        $search = $r->input('search');

        $query = "SELECT * FROM baju";

        if ($search) {
            $query .= " WHERE nama_baju LIKE '%$search%'";
        }

        $data = \DB::select($query);

        return view('admin.baju.data', [
            'data_baju' => $data
        ]);
    }

    public function AddBaju(Request $r)
    {
        $role_check = $r->session()->get('role');

        if (!$r->session()->has('username') || $role_check !== 'admin') {
            return redirect(route('admin.login.view'));
        }
        Alert::success('Berhasil Menambah Baju');
        \DB::insert("INSERT INTO baju (nama_baju, harga, stok) VALUES ('$r->nama_baju',$r->harga,$r->stok)");
        return redirect(route('admin.home.baju'));
    }

    public function EditBaju(Request $r, $id)
    {
        $role_check = $r->session()->get('role');

        if (!$r->session()->has('username') || $role_check !== 'admin') {
            return redirect(route('admin.login.view'));
        }

        $data = \DB::select("SELECT * FROM baju WHERE ID_Baju = '$id'");
        if (count($data) === 0) {
            return redirect(route('admin.home.baju'));
        }
        return view('admin.baju.edit', [
            'data' => $data[0]
        ]);
    }

    public function UpdateBaju(Request $r)
    {
        $role_check = $r->session()->get('role');

        if (!$r->session()->has('username') || $role_check !== 'admin') {
            return redirect(route('admin.login.view'));
        }

        // Pengecekan input tidak kosong
        if (empty($r->nama_baju) || empty($r->harga)) {
            Alert::error('Nama Baju dan Harga harus diisi');
            return redirect()->back();
        }

        // Pengecekan stok tidak kurang dari 0
        if ($r->stok < 0) {
            Alert::error('Stok tidak boleh kurang dari 0');
            return redirect()->back();
        }

        // Eksekusi pernyataan UPDATE dengan parameter binding
        \DB::update("UPDATE baju SET nama_baju=?, harga=?, stok=? WHERE ID_Baju = ?", [
            $r->nama_baju,
            $r->harga,
            $r->stok,
            $r->id
        ]);

        Alert::success('Data Berhasil Diubah');
        return redirect(route('admin.home.baju'));
    }

    public function DeleteBaju(Request $r, $id)
    {
        $role_check = $r->session()->get('role');

        if (!$r->session()->has('username') || $role_check !== 'admin') {
            return redirect(route('admin.login.view'));
        }

        $baju = Baju::find($id);

        if (!$baju) {
            Alert::error('Baju Tidak Ditemukan');
            return redirect(route('admin.home.user'));
        }

        Alert::success('Baju Berhasil Dihapus');
        $baju->update(['deleted_at' => now()]);

        return redirect(route('admin.home.baju'));
    }

    public function hardDeleteAll(Request $request)
    {
        try {
            $softDeletedRecords = Baju::onlyTrashed()->get();
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
            Alert::error('Baju Tidak Ditemukan');
        }

        return redirect()->route('admin.home.baju');
    }

    public function RestoreAll(Request $request)
    {
        try {
            $successFlag = false;

            $deletedRecords = \DB::select("
                SELECT *
                FROM baju
                WHERE deleted_at IS NOT NULL
                ORDER BY deleted_at ASC
            ");

            foreach ($deletedRecords as $record) {
                Baju::withTrashed()->find($record->ID_Baju)->restore();
                $successFlag = true;
                break;
            }

            if ($successFlag) {
                Alert::success('Restore Berhasil');
            } else {
                Alert::error('Tidak ada data yang dapat direstore');
            }
        } catch (\Exception $e) {
            Alert::error('Baju Tidak Ditemukan');
        }

        return redirect()->route('admin.home.baju');
    }
}