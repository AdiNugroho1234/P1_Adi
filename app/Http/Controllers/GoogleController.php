<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use Laravel\Socialite\Facades\Socialite;

use App\Models\User;

use Illuminate\Support\Facades\Auth;



class GoogleController extends Controller

{

    public function redirect()

    {

        return Socialite::driver('google')->redirect();

    }



    public function callback(Request $request)

    {

        $userFromGoogle = Socialite::driver('google')->stateless()->user();



        // Cari user berdasarkan google_id

        $user = User::where('google_id', $userFromGoogle->getId())->first();



        if (!$user) {

            // Cek kalau email sudah ada

            $user = User::where('email', $userFromGoogle->getEmail())->first();



            if (!$user) {

                // User benar-benar baru

                $user = User::create([

                    'name'       => $userFromGoogle->getName(),

                    'email'      => $userFromGoogle->getEmail(),

                    'google_id'  => $userFromGoogle->getId(),

                    'avatar'     => $userFromGoogle->getAvatar(),

                    'password'   => bcrypt(str()->random(16)), // Dummy password

                    'is_complete'=> false, // ⬅ Tambahkan field ini di tabel users

                ]);



                Auth::login($user);

                return redirect()->route('profile.complete'); // ⬅ Arahkan user baru ke form lengkapi data

            } else {

                // Email ada, tapi belum punya google_id

                $user->google_id = $userFromGoogle->getId();

                $user->avatar = $userFromGoogle->getAvatar();

                $user->save();

            }

        }



        Auth::login($user);

        session()->regenerate();



        // Jika data belum lengkap, redirect ke form

        if (!$user->is_complete) {

            return redirect()->route('profile.complete');

        }



        return redirect()->route('welcome')->with('success', 'Berhasil masuk dengan akun Google');

    }



    public function showCompleteForm()

    {

        return view('auth.profile'); // ⬅ Buat view ini

    }



    public function submitCompleteForm(Request $request)

    {

        $request->validate([

            'phone'   => 'required',

            'address' => 'required',

        ]);



        $user = Auth::user();

        $user->phone = $request->phone;

        $user->address = $request->address;

        $user->is_complete = true;

        $user->save();



        return redirect()->route('welcome')->with('success', 'Profil berhasil dilengkapi.');

    }



    public function logout(Request $request)

    {

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('welcome')->with('success', 'Berhasil keluar');

    }



    public function profile()

{

    $user = Auth::user();

    return view('profile.edit', compact('user'));

}

}