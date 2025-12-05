<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Midtrans\Config;
use Midtrans\Snap;

class CheckoutController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $alamatUtama = DB::table('t_alamat_user')
            ->where('user_id', $user->id)
            ->where('utama', 1)
            ->first();

        // Ambil semua item di cart user
        $checkoutItems = DB::table('cart')
            ->join('t_barang', 'cart.barang_id', '=', 't_barang.id')
            ->where('cart.user_id', $user->id)
            ->select('cart.*', 't_barang.nama_barang', 't_barang.harga', 't_barang.photo')
            ->get();

        // Hitung total & subtotal
        $subtotal = $checkoutItems->sum(fn($item) => $item->harga * $item->quantity);
        $totalItems = $checkoutItems->sum('quantity');

        // Konfigurasi Midtrans
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Buat Snap token
        $params = [
            'transaction_details' => [
                'order_id' => uniqid(),
                'gross_amount' => $subtotal,
            ],
            'customer_details' => [
                'first_name' => $user->name,
                'email' => $user->email,
            ]
        ];

        $snapToken = Snap::getSnapToken($params);

        return view('cart.checkout', compact(
            'alamatUtama',
            'snapToken',
            'checkoutItems',
            'subtotal',
            'totalItems'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'telepon' => 'required|string|max:20',
            'alamat' => 'required|string',
            'email' => 'required|string|email',
            'kota' => 'required|string|max:100',
            'kode_pos' => 'required|string|max:10',
            'negara' => 'required|string|max:100',
            'provinsi' => 'required|string|max:100',
        ]);

        $name = $request->first_name . ' ' . $request->last_name;

        DB::table('t_alamat_user')->insert([
            'user_id'   => $request->user_id,
            'name'      => $name,
            'telepon'   => $request->telepon,
            'alamat'    => $request->alamat,
            'kota'      => $request->kota,
            'email'     => $request->email,
            'kode_pos'  => $request->kode_pos,
            'negara'    => $request->negara,
            'provinsi'  => $request->provinsi,
            'utama'     => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Alamat berhasil disimpan.');
    }

    public function checkout(Request $request)
    {
        $userId = Auth::id();

        // ambil semua cart item user
        $checkoutItems = DB::table('cart')
            ->join('t_barang', 'cart.barang_id', '=', 't_barang.id')
            ->where('cart.user_id', $userId)
            ->select('cart.*', 't_barang.nama_barang', 't_barang.harga', 't_barang.photo')
            ->get();

        if ($checkoutItems->isEmpty()) {
            return redirect()->back()->with('error', 'Keranjang kosong!');
        }

        // simpan ke tabel t_pesanan
        foreach ($checkoutItems as $item) {
            DB::table('t_pesanan')->insert([
                'barang_id'   => $item->barang_id,
                'user_id'     => $userId,
                'name'        => Auth::user()->name,
                'telepon'     => '', // isi sesuai kebutuhan
                'alamat'      => '', // isi sesuai kebutuhan
                'nama_barang' => $item->nama_barang,
                'harga'       => $item->harga,
                'quantity'    => $item->quantity,
                'status'      => 'pending',
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }

        // hapus cart setelah checkout
        DB::table('cart')->where('user_id', $userId)->delete();

        // redirect balik dengan notif
        return redirect()->back()->with('success', 'Pesanan berhasil dikirim!');
    }




    public function process(Request $request)
    {
        $userId = Auth::id();

        $cartItems = DB::table('cart')
            ->where('user_id', $userId)
            ->whereIn('barang_id', $request->input('items'))
            ->get();

        $subtotal = $cartItems->sum(fn($item) => $item->harga * $item->quantity);
        $totalItems = $cartItems->sum('quantity');

        DB::table('order')->insert([
            'user_id'   => $userId,
            'subtotal'  => $subtotal,
            'total_items' => $totalItems,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('cart')->whereIn('barang_id', $request->input('items'))->delete();

        return redirect()->route('order.index')->with('success', 'Order berhasil dibuat.');
    }

    public function notificationHandler(Request $request)
    {
        // Konfigurasi Midtrans
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $notif = new \Midtrans\Notification();

        $transaction = $notif->transaction_status;
        $type        = $notif->payment_type;
        $orderId     = $notif->order_id;
        $fraud       = $notif->fraud_status;

        if ($transaction == 'settlement') {
            // pembayaran sukses → simpan ke t_pesanan
            DB::table('t_pesanan')->insert([
                'order_id'    => $orderId,
                'user_id'     => Auth::id(), // atau simpan user_id yang sesuai
                'status'      => 'paid',
                'payment_type' => $type,
                'gross_amount' => $notif->gross_amount,
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);

            // hapus cart user
            DB::table('cart')->where('user_id', Auth::id())->delete();
        } else if ($transaction == 'pending') {
            // bisa simpan status pending juga kalau mau
        } else if ($transaction == 'expire') {
            // tandai order expired
        }

        return response()->json(['status' => 'ok']);
    }
}
