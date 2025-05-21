<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request) {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            // 'g-recaptcha-response' => 'recaptcha',
        ]);
    
        $user = User::where('email', $validated['email'])->first();
    
        if (!$user) {
            return redirect()->route('login')->withErrors(['email' => 'User belum terdaftar!']);
        }
    
        if (!$user->verified) {
            return redirect()->route('login')->withErrors(['email' => 'User belum diverifikasi oleh admin!']);
        }
    
        if (Hash::check($validated['password'], $user->password)) {
            Auth::login($user);
            return redirect()->route('dashboard.home');
        }
    
        return redirect()->route('login')->withErrors(['password' => 'Password salah!']);
    }

    public function register(Request $request) {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users|email',
            'password' => [
                'required',
                'min:8',
                'regex:/[A-Z]/',      // Minimal satu huruf besar
                'regex:/[a-z]/',      // Minimal satu huruf kecil
                'regex:/[0-9]/',      // Minimal satu angka
            ],
            'confirm_password' => 'required|same:password',
            // 'g-recaptcha-response' => 'recaptcha'
        ]);

        $user = new User();
        $user->email = $validated['email'];
        $user->password = $validated['password'];
        $user->name = str_split($user->email, strpos($user->email, '@'))[0];
        $user->email_verified_at = now();
        $user->save();

        return redirect()->route('login');
    }

    public function logout() {
        if (Auth::check()) {
            Auth::logout();
            return redirect()->route('login');
        }
    }
}
