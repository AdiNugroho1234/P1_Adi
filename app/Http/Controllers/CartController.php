<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Snap;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{

    public function index()
    {
        $cartItems = Cart::where('user_id', Auth::id())->get();
        $subtotal  = $cartItems->sum(fn($item) => $item->harga * $item->quantity);

        return view('cart.index', compact('cartItems', 'subtotal'));
    }

    public function prosesCheckout(Request $request)
    {
        $user = Auth::user();
        $cartItems = Cart::where('user_id', $user->id)->get();

        if ($cartItems->isEmpty()) {
            return back()->with('error', 'Keranjang masih kosong.');
        }

        $totalBayar = $cartItems->sum(fn($item) => $item->harga * $item->quantity);

        DB::beginTransaction();
        try {

            $order = Order::create([
                'user_id'   => $user->id,
                'name'      => $request->name,
                'phone'     => $request->phone,
                'email'     => $request->email,
                'address'   => $request->address,
                'city'      => $request->city,
                'province'  => $request->province,
                'postal_code' => $request->postal_code,
                'country'   => $request->country,
                'total'     => $totalBayar,
                'status'    => 'pending',
            ]);


            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id'     => $order->id,
                    'produk_id'    => $item->produk_id ?? $item->product_id ?? $item->id,
                    'nama_produk'  => $item->nama_produk ?? $item->nama_barang ?? 'Produk Tidak Dikenal',
                    'harga'        => $item->harga,
                    'jumlah'       => $item->jumlah ?? $item->quantity ?? 1,
                    'photo'        => $item->photo,
                    'subtotal'     => $item->subtotal ?? ($item->harga * ($item->jumlah ?? $item->quantity ?? 1)),
                ]);
            }


            Cart::where('user_id', $user->id)->delete();


            Config::$serverKey = env('MIDTRANS_SERVER_KEY');
            Config::$isProduction = false;
            Config::$isSanitized = true;
            Config::$is3ds = true;


            $params = [
                'transaction_details' => [
                    'order_id'      => 'ORDER-' . $order->id . '-' . time(),
                    'gross_amount'  => $totalBayar,
                ],
                'customer_details' => [
                    'first_name' => $request->name,
                    'email'      => $request->email,
                    'phone'      => $request->telepon,
                    'shipping_address' => [
                        'address'    => $request->address,
                        'city'       => $request->kota,
                        'postal_code' => $request->kode_pos,
                        'country_code' => 'IDN',
                    ],
                ],
                'item_details' => $cartItems->map(function ($item) {
                    return [
                        'id'       => $item->produk_id,
                        'price'    => $item->harga,
                        'quantity' => $item->quantity,
                        'name'     => $item->nama_barang,
                    ];
                })->toArray(),
            ];

            $snapToken = Snap::getSnapToken($params);

            DB::commit();

            return view('cart.index', [
                'cartItems'  => $cartItems,
                'subtotal'   => $totalBayar,
                'snapToken'  => $snapToken,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal memproses checkout: ' . $e->getMessage());
        }
    }

    public function add(Request $request)
    {

        

        $user = Auth::user();

        $request->validate([
            'barang_id' => 'required|integer',
            'nama_barang' => 'required|string',
            'jenis_barang' => 'nullable|string',
            'harga' => 'required|numeric',
            'quantity' => 'required|integer|min:1',
            'photo' => 'nullable|string',
        ]);

        $existingItem = Cart::where('user_id', $user->id)
            ->where('barang_id', $request->barang_id)
            ->first();

        if ($existingItem) {
            $existingItem->quantity += $request->quantity;
            $existingItem->save();
        } else {
            Cart::create([
                'user_id'      => $user->id,
                'barang_id'    => $request->barang_id,
                'nama_barang'  => $request->nama_barang,
                'jenis_barang' => $request->jenis_barang,
                'harga'        => $request->harga,
                'quantity'     => $request->quantity,
                'photo'        => $request->photo,
                'ukuran'       => $request->ukuran,
            ]);
        }

        return back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }


    public function remove($id)
    {
        $item = Cart::findOrFail($id);
        $item->delete();
        return back()->with('success', 'Item berhasil dihapus dari keranjang.');
    }
}
