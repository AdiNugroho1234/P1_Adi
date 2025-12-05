<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UsersController extends Controller
    {
        public function index()
        {
            $users = DB::table('users')->get();
            return view('table', compact('users'));
        }
        public function show($id)
        {

            // ambil semua data jenis barang dari tabel jenis_barang
            $jenis = DB::table('t_jenis')->get();


            $user = DB::table('users')->find($id);
            if (!$user) {
                abort(404);
            }
            return view('users.show', compact('user'));
        }
        public function edit($id)
        {
            $user = DB::table('users')->find($id);
            if (!$user) {
                abort(404);
            }
            return view('users.edit', compact('user'));
        }
        public function destroy($id)
        {
            $user = User::findOrFail($id);
            if (!$user) {
                abort(404);
            }
            $user->delete();
            return redirect()->route('tabel')->with('success', 'User deleted successfully');
        }

        
    }
