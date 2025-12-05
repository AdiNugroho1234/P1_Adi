<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PesananController extends Controller
{
    public function index()
    {
        // JOIN order_items dan orders untuk menampilkan semua data dalam 1 tabel
        $orders = DB::table('orders')
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->select(
                'orders.id',
                'orders.name',
                'orders.total',
                'orders.status',
                'orders.address',
                'orders.city',
                'orders.province',
                'orders.postal_code',
                'orders.country',
                'order_items.nama_produk',
                'order_items.photo'
            )
            ->orderBy('orders.id', 'desc')
            ->get();

        return view('pesanan', compact('orders'));
    }

    public function show($id)
    {
        $order = DB::table('orders')
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->select(
                'orders.*',
                'order_items.nama_produk',
                'order_items.harga',
                'order_items.jumlah',
                'order_items.subtotal',
                'order_items.photo'
            )
            ->where('orders.id', $id)
            ->first();

        if (!$order) {
            return redirect()->route('pesanan')->with('error', 'Data pesanan tidak ditemukan.');
        }

        return view('formView', compact('order'));
    }
    public function destroy($id)
    {
        // Hapus dulu item yang terkait
        DB::table('order_items')->where('order_id', $id)->delete();

        // Hapus order utama
        DB::table('orders')->where('id', $id)->delete();

        return redirect()->route('pesanan')->with('success', 'Pesanan berhasil dihapus.');
    }

    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key'); // pastikan kamu udah set di .env
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed == $request->signature_key) {
            if ($request->transaction_status == 'capture' || $request->transaction_status == 'settlement') {
                DB::table('orders')
                    ->where('id', $request->order_id)
                    ->update(['status' => 'paid']);
            }
        }

        return response()->json(['message' => 'Callback received']);
    }

    public function updateStatus($id)
{
    DB::table('orders')->where('id', $id)->update(['status' => 'paid']);

    return redirect()->route('pesanan')->with('success', 'Status pesanan berhasil diperbarui menjadi "paid".');
}

}
