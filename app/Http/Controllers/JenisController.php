<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class JenisController extends Controller
{
    public function index()
    {
        $data = "Adi";
        $jenis = DB::table('t_jenis')->get();

            return view('jenis', ['data' => $data, 'jenis' => $jenis]);
    }

    public function show($id)
    {
        $cek = DB::table('t_jenis')->where('id', $id)->first();

        if (!$cek) {
            return redirect()->route('jenis.index')->with('error', 'Data jenis tidak ditemukan.');
        }

        $jenis = [
            'id' => $cek->id,
            'jenis_barang' => $cek->jenis_barang,
            'created_at' => $cek->created_at,
            'updated_at' => $cek->updated_at
        ];

        return view('formView', ['jenis' => $jenis]);
    }

    public function create(Request $request)
    {
        $jenis = [
            'id' => '',
            'jenis_barang' => '',
            'created_at' => '',
            'updated_at' => ''
        ];
        if ($request->input('id') != '') {
            $cek = DB::table('t_jenis')->where('id', $request->input('id'))->first();
            $jenis = [
                'id' => $cek->id,
                'jenis_barang' => $cek->jenis_barang,
                'created_at' => $cek->created_at,
                'updated_at' => $cek->updated_at
            ];
        }
        return view('formAdd', ['jenis' => $jenis]);
    }

    public function destroy($id)
    {
        DB::table('t_jenis')->where('id', $id)->delete();
        return redirect()->route('jenis');
    }



    public function store(Request $request)
    {
        $task = $request->input("action_task");

        switch ($task) {
            case 'save_jenis':
                $data = [
                    'jenis_barang' => $request->input('jenis_barang'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                if ($request->input("id") != '') {
                    DB::table('t_jenis')->where('id', $request->input('id'))->update($data);
                    #\DB::table('t_jenis')->update($data);
                } else {
                    DB::table('t_jenis')->insert($data);
                }
                return redirect('jenis');
                break;
        }
    }
}
