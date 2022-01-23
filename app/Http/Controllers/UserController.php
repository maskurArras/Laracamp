<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
//import package laravel socialite
use Laravel\Socialite\Facades\Socialite;
use Auth;

class UserController extends Controller
{
    // menampilkan view login
    public function login()
    {
        return view('auth.user.login');
    }

    public function google()
    {
        // menambahkan redirect driver ke google
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallback()
    {
        //untuk mengetahui isi data yang digunakan saat login
        $callback = Socialite::driver('google')->stateless()->user();
        $data = [
            'name' => $callback->getName(),
            'email' => $callback->getEmail(),
            'avatar' => $callback->getAvatar(),
            'email_verified_at' => date('Y-m-d H:i:s', time()),
        ];

        $user = User::firstOrCreate(
            ['email' => $data['email']],
            $data
        );

        Auth::login($user, true);

        return redirect(route('welcome'));
    }
}
