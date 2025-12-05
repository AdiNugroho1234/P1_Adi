<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Barang;
use Carbon\Carbon;

class BarangController extends Controller
{
    public function index()
    {
        $barang = DB::table('t_barang')->get();
        $ukuran = ['38', '39', '40', '41', '42', '43', '44', '45'];
        $jenis = DB::table('t_jenis')->get();

        return view('barang', compact('barang', 'ukuran', 'jenis',));
    }

    public function show($id)
    {
        $cek = DB::table('t_barang')->where('id', $id)->first();

        if (!$cek) {
            return redirect()->route('barang.index')->with('error', 'Data barang tidak ditemukan.');
        }

        // Konversi objek $cek ke array dan siapkan data
        $barang = [
            'id' => $cek->id,
            'photo' => json_decode($cek->photo ?? '[]', true), // decode array photo di sini
            'nama_barang' => $cek->nama_barang,
            'jenis_barang' => $cek->jenis_barang,
            'harga' => $cek->harga,
            'description' => $cek->description ?? '',
            'ukuran' => $cek->ukuran ?? '',
            'stok' => $cek->stok ?? '',
            'warna' => $cek->warna ?? '',
            'model' => $cek->model ?? '',
            'negara' => $cek->negara ?? '',
            'created_at' => $cek->created_at ?? '',
            'updated_at' => $cek->updated_at ?? ''
        ];

        return view('detail', [
            'barang' => $barang,
            'photos' => $barang['photo'] // kirim array photo ke view
        ]);
    }


    public function create(Request $request)
    {
        $barang = [
            'id' => '',
            'photo' => [],
            'nama_barang' => '',
            'jenis_barang' => '',
            'harga' => '',
            'description' => '',
            'ukuran' => '',
            'stok' => '',
            'warna' => '',
            'model' => '',
            'negara' => '',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString()
        ];

        $jenis = DB::table('t_jenis')->get();
        $ukuran = ['38', '39', '40', '41', '42', '43', '44', '45'];

        // Jika mode edit
        if ($request->input('id') != '') {
            $cek = DB::table('t_barang')->where('id', $request->input('id'))->first();
            if ($cek) {
                $barang = [
                    'id' => $cek->id,
                    'photo' => json_decode($cek->photo ?? '[]', true),
                    'nama_barang' => $cek->nama_barang,
                    'jenis_barang' => $cek->jenis_barang,
                    'harga' => $cek->harga,
                    'description' => $cek->description,
                    'ukuran' => $cek->ukuran,
                    'stok' => $cek->stok,
                    'warna' => $cek->warna,
                    'model' => $cek->model,
                    'negara' => $cek->negara,
                    'created_at' => $cek->created_at,
                    'updated_at' => $cek->updated_at
                ];
            }
        }

        return view('formBarang', compact('barang', 'jenis', 'ukuran'));
    }


    public function destroy($id)
    {
        DB::table('t_barang')->where('id', $id)->delete();
        return redirect()->route('barang');
    }

    public function store(Request $request)
    {
        $task = $request->input("action_task");

        switch ($task) {
            case 'save_barang':
                $sizes = $request->input('sizes', []);
                $stocks = $request->input('stocks', []);

                $ukuran_stok = [];
                foreach ($sizes as $i => $size) {
                    if (!empty($size) && isset($stocks[$i]) && $stocks[$i] !== null) {
                        $ukuran_stok[] = [
                            'ukuran' => $size,
                            'stok' => $stocks[$i]
                        ];
                    }
                }

                $data = [
                    'nama_barang' => $request->input('nama_barang'),
                    'jenis_barang' => $request->input('jenis_barang'),
                    'harga' => $request->input('harga'),
                    'description' => $request->input('description'),
                    'ukuran' => json_encode($ukuran_stok),
                    'warna' => $request->input('warna'),
                    'model' => $request->input('model'),
                    'negara' => $request->input('negara'),
                    'updated_at' => Carbon::now()
                ];

                if ($request->hasFile('gambar')) {
                    $paths = [];
                    foreach ($request->file('gambar') as $file) {
                        if ($file->isValid()) {
                            $paths[] = $file->store('images', 'public');
                        }
                    }
                    $data['photo'] = json_encode($paths);
                }


                if ($request->input("id") != '') {
                    DB::table('t_barang')->where('id', $request->input('id'))->update($data);
                } else {
                    $data['created_at'] = Carbon::now();
                    DB::table('t_barang')->insert($data);
                }

                return redirect()->route('barang');
        }
    }

    public function welcome()
    {
        $products = DB::table('t_barang')->get();
        return view('welcome', compact('products'));
    }

    public function detail()
    {
        $barang = Barang::with('kategori')->get();
        return view('product.detail', compact('barang'));
    }

    public function beli(Request $request, $id)
    {
        $barang = DB::table('t_barang')->where('id', $id)->first();

        if (!$barang) {
            return redirect()->back()->with('error', 'Barang tidak ditemukan.');
        }

        $ukuranData = json_decode($barang->ukuran, true);

        if (empty($ukuranData)) {
            return redirect()->back()->with('error', 'Ukuran barang tidak tersedia.');
        }

        // Kurangi stok dari ukuran pertama sebagai contoh
        $ukuranData[0]['stok'] = max(0, $ukuranData[0]['stok'] - 1);

        DB::table('t_barang')->where('id', $id)->update([
            'ukuran' => json_encode($ukuranData),
            'updated_at' => now()
        ]);

        return redirect()->back()->with('success', 'Berhasil membeli 1 item ' . $barang->nama_barang);
    }
}
