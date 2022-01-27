<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
//import package laravel socialite
use Laravel\Socialite\Facades\Socialite;
use Auth;
// menggunakan package mail
use Mail;
use App\Mail\User\AfterRegister;

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
        // sebelum menggunakan mail
        // $user = User::firstOrCreate(
        //     ['email' => $data['email']],
        //     $data
        // );

        // setelah menggunakan mail
        $user = User::whereEmail($data['email'])->first();
        if (!$user) {
            $user = User::create($data);
            Mail::to($user->email)->send(new AfterRegister($user));
        }

        Auth::login($user, true);

        return redirect(route('welcome'));
    }
}
