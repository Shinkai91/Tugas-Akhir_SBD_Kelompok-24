<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Baju;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Alert;

class OrderController extends Controller
{
    public function ViewOrder(Request $r)
    {
        $role_check = $r->session()->get('role');

        if (!$r->session()->has('username') || $role_check !== 'user') {
            return redirect(route('user.login.view'));
        }

        $search = $r->input('search');

        $query = "SELECT * FROM baju";
        if ($search) {
            $query .= " WHERE nama_baju LIKE '%$search%'";
        }

        $data = \DB::select($query);

        return view('user.order', [
            'data_baju' => $data
        ]);
    }

    public function ProductOrder(Request $request)
    {
        $request->validate([
            'ID_Baju' => 'required',
            'quantity' => 'required|numeric|min:1',
        ]);

        $baju = Baju::find($request->ID_Baju);
        $totalHarga = $baju->harga * $request->quantity;

        // Retrieve user ID from the session
        $userId = session()->get('id');

        // Create a transaction
        $transaction = new Transaction([
            'ID_Pelanggan' => $userId,
            'ID_Baju' => $request->ID_Baju,
            'tanggal' => now(),
            'jumlah' => $request->quantity,
            'total_harga' => $totalHarga,
            'alamat' => 'NULL',
            'metode_pembayaran' => 'NULL',
        ]);

        $transaction->save();

        Alert::success('Success', 'Item added to cart successfully.');

        return redirect()->back();
    }

    public function ViewTransactionOrder(Request $r)
    {
        $role_check = $r->session()->get('role');

        if (!$r->session()->has('username') || $role_check !== 'user') {
            return redirect(route('user.login.view'));
        }

        $userId = session()->get('id');

        $data = \DB::select("
        SELECT transaksi.*, pelanggan.Nama as pelanggan_nama, baju.nama_baju, baju.harga, baju.stok
        FROM transaksi
        JOIN pelanggan ON transaksi.ID_Pelanggan = pelanggan.ID_Pelanggan
        JOIN baju ON transaksi.ID_Baju = baju.ID_Baju
        WHERE transaksi.ID_Pelanggan = ?
    ", [$userId]);

        return view('user.keranjang', [
            'data' => $data
        ]);
    }

    public function EditTransactionOrder(Request $r, $id)
    {
        $role_check = $r->session()->get('role');

        if (!$r->session()->has('username') || $role_check !== 'user') {
            return redirect(route('user.login.view'));
        }

        $userId = session()->get('id');

        $data = \DB::select("
            SELECT transaksi.*, pelanggan.Nama as pelanggan_nama, baju.nama_baju, baju.harga, baju.stok
            FROM transaksi
            JOIN pelanggan ON transaksi.ID_Pelanggan = pelanggan.ID_Pelanggan
            JOIN baju ON transaksi.ID_Baju = baju.ID_Baju
            WHERE transaksi.ID_Pelanggan = ? AND transaksi.ID_Transaksi = ?
        ", [$userId, $id]);

        if (count($data) === 0) {
            return redirect(route('user.keranjang'));
        }

        return view('user.editkeranjang', [
            'data' => $data[0]
        ]);
    }

    public function UpdateTransactionOrder(Request $r)
    {
        $role_check = $r->session()->get('role');

        if (!$r->session()->has('username') || $role_check !== 'user') {
            return redirect(route('user.login.view'));
        }

        // Validasi input
        $r->validate([
            'jumlah' => 'required|numeric', // Add any additional validation rules if needed
        ]);

        $id_transaksi = $r->id;
        $jumlah = $r->jumlah;

        // Get the corresponding transaction
        $transaction = \DB::select("
            SELECT transaksi.*, baju.harga as harga_per_unit
            FROM transaksi
            JOIN baju ON transaksi.ID_Baju = baju.ID_Baju
            WHERE transaksi.ID_Transaksi = ?
        ", [$id_transaksi]);

        if (count($transaction) === 0) {
            // If transaction not found
            Alert::error('Update Gagal', 'Data transaksi tidak ditemukan.');
            return redirect(route('user.keranjang'));
        }

        // Calculate the new total_harga based on the updated jumlah
        $harga_per_unit = $transaction[0]->harga_per_unit;
        $new_total_harga = $harga_per_unit * $jumlah;


        // Update the jumlah and total_harga columns in the transaksi table
        $updateResult = \DB::update("
        UPDATE transaksi
        SET jumlah = ?, total_harga = ?
        WHERE ID_Transaksi = ?
    ", [$jumlah, $new_total_harga, $id_transaksi]);

        if ($updateResult) {
            // If update is successful
            Alert::success('Update Berhasil', 'Data transaksi berhasil diperbarui.');
        } else {
            // If update fails
            Alert::error('Update Gagal', 'Terjadi kesalahan saat memperbarui data transaksi.');
        }

        return redirect(route('user.keranjang'));
    }

    public function DeleteTransactionOrder(Request $r, $id)
    {
        $role_check = $r->session()->get('role');

        if (!$r->session()->has('username') || $role_check !== 'user') {
            return redirect(route('user.login.view'));
        }
        Alert::success('Data Berhasil Dihapus');
        \DB::delete("DELETE FROM transaksi WHERE ID_Transaksi = $id");
        return redirect(route('user.keranjang'));
    }

    public function EditTransactionCheck(Request $r)
    {
        $role_check = $r->session()->get('role');

        if (!$r->session()->has('username') || $role_check !== 'user') {
            return redirect(route('user.login.view'));
        }

        $userId = session()->get('id');

        $totalHarga = \DB::select("
            SELECT SUM(total_harga) AS total_harga
            FROM transaksi
            WHERE ID_Pelanggan = ? AND deleted_at IS NULL
        ", [$userId])[0];

        $data = \DB::table('transaksi')
            ->select('alamat', 'metode_pembayaran')
            ->where('ID_Pelanggan', $userId)
            ->whereNull('deleted_at')
            ->groupBy('alamat', 'metode_pembayaran')
            ->first();

        if (!$data) {
            return redirect(route('user.keranjang'));
        }

        return view('user.checkout', [
            'data' => $data,
            'totalHarga' => $totalHarga->total_harga,
        ]);
    }

    public function UpdateTransactionCheck(Request $r)
    {
        try {
            // Check user session
            $role_check = $r->session()->get('role');
            if (!$r->session()->has('username') || $role_check !== 'user') {
                return redirect(route('user.login.view'));
            }

            // Validate input
            $r->validate([
                'alamat' => 'required|string',
                'metode_pembayaran' => 'required|string',
            ]);

            $userId = session()->get('id');

            if (!$userId) {
                \Log::error('ID_Pelanggan not found in session.');
                return redirect(route('user.login.view'));
            }

            // Get input data
            $alamat = $r->alamat;
            $metode_pembayaran = $r->metode_pembayaran;

            \DB::update("
            UPDATE transaksi
            SET alamat = ?, metode_pembayaran = ?, status = 'proses', deleted_at = NOW()
            WHERE ID_Pelanggan = ? AND deleted_at IS NULL
        ", [$alamat, $metode_pembayaran, $userId]);

            Alert::success('Update Berhasil', 'Data transaksi berhasil diperbarui.');
        } catch (\Exception $e) {
            \Log::error('Exception during update: ' . $e->getMessage());
            Alert::error('Update Gagal', 'Terjadi kesalahan saat memperbarui data transaksi.');
        }

        return redirect(route('user.keranjang'));
    }

    public function ViewHistory(Request $r)
    {
        $role_check = $r->session()->get('role');

        if (!$r->session()->has('username') || $role_check !== 'user') {
            return redirect(route('user.login.view'));
        }

        $userId = session()->get('id');
        $search = $r->input('search');

        $query = "
        SELECT transaksi.*, baju.nama_baju
        FROM transaksi
        JOIN baju ON transaksi.ID_Baju = baju.ID_Baju
        WHERE ID_Pelanggan = ?";

        if ($search) {
            $query .= " AND baju.nama_baju LIKE '%$search%'";
        }

        \Log::info("SQL Query: " . $query);

        $data = \DB::select($query, [$userId]);

        return view('user.status', [
            'data' => $data
        ]);
    }

    public function ViewAdminOrder(Request $r)
    {
        $role_check = $r->session()->get('role');

        if (!$r->session()->has('username') || $role_check !== 'admin') {
            return redirect(route('admin.login.view'));
        }

        $search = $r->input('search');

        $query = "
        SELECT transaksi.*, b1.nama_baju, pelanggan.Nama
        FROM transaksi
        JOIN baju AS b1 ON transaksi.ID_Baju = b1.ID_Baju
        JOIN pelanggan ON transaksi.ID_Pelanggan = pelanggan.ID_Pelanggan";

        if ($search) {
            $query .= " WHERE b1.nama_baju LIKE '%$search%' OR pelanggan.Nama LIKE '%$search%'";
        }

        $data = \DB::select($query);

        return view('admin.order.data', [
            'data' => $data
        ]);
    }

    public function EditOrder(Request $r, $id)
    {
        $role_check = $r->session()->get('role');

        if (!$r->session()->has('username') || $role_check !== 'admin') {
            return redirect(route('admin.login.view'));
        }

        $orders = \DB::select("
            SELECT transaksi.*, baju.nama_baju
            FROM transaksi
            JOIN baju ON transaksi.ID_Baju = baju.ID_Baju
            WHERE ID_Transaksi = '$id'
        ");

        if (count($orders) === 0) {
            return redirect(route('admin.home'));
        }
        return view('admin.order.edit', [
            'data' => $orders[0],
        ]);
    }

    public function UpdateOrder(Request $request)
    {

        $role_check = $request->session()->get('role');

        if (!$request->session()->has('username') || $role_check !== 'admin') {
            return redirect(route('admin.login.view'));
        }

        $request->validate([
            'ID_Transaksi' => 'required|numeric',
            'status' => 'required|string',
        ]);

        \DB::update("
            UPDATE transaksi 
            SET status = ? 
            WHERE ID_Transaksi = ?
        ", [$request->status, $request->ID_Transaksi]);

        alert()->success('Data Berhasil Diubah', 'Success');

        return redirect(route('admin.home.order'));
    }

    public function DeleteOrder(Request $r, $id)
    {
        $role_check = $r->session()->get('role');

        if (!$r->session()->has('username') || $role_check !== 'admin') {
            return redirect(route('admin.login.view'));
        }

        Alert::success('Data Berhasil Dihapus');

        \DB::delete("DELETE FROM transaksi WHERE ID_Transaksi = $id");

        return redirect(route('admin.home.order'));
    }
}
