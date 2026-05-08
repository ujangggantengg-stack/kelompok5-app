<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Exception;

class GoogleController extends Controller
{
    public function redirect()
    {
        try {
            // Cek apakah konfigurasi sudah diisi di .env
            $clientId = env('GOOGLE_CLIENT_ID');
            $clientSecret = env('GOOGLE_CLIENT_SECRET');

            if ($clientId === 'masukkan_client_id_disini' || empty($clientId) || $clientSecret === 'masukkan_client_secret_disini' || empty($clientSecret)) {
                return redirect()->route('customer.login')->with('error', 'Login Google belum dikonfigurasi dengan benar di file .env.');
            }

            return Socialite::driver('google')
                ->stateless()
                ->with(['guzzle' => ['verify' => false]])
                ->redirect();
        } catch (\Exception $e) {
            \Log::error('Google Login Redirect Error: ' . $e->getMessage());
            return redirect()->route('customer.login')->with('error', 'Terjadi kesalahan saat menghubungkan ke Google. Silakan coba lagi.');
        }
    }

    public function callback()
    {
        try {
            $user = Socialite::driver('google')
                ->stateless()
                ->with(['guzzle' => ['verify' => false]])
                ->user();

            // Cari user berdasarkan google_id atau email
            $customer = Customer::where('google_id', $user->id)
                ->orWhere('email', $user->email)
                ->first();

            if (!$customer) {
                // Register user baru jika belum ada
                $customer = Customer::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id' => $user->id,
                    'avatar' => $user->avatar,
                    'password' => \Hash::make(\Str::random(24)), // Random password aman
                    'email_verified_at' => now(),
                ]);
            } else {
                // Update data jika user sudah ada (misal update avatar atau link google_id)
                $customer->update([
                    'google_id' => $user->id,
                    'avatar' => $user->avatar,
                ]);
            }

            // Login menggunakan guard customer
            Auth::guard('customer')->login($customer, true);

            // Regenerate session untuk keamanan
            request()->session()->regenerate();

            return redirect()->intended('/')->with('success', 'Selamat Datang, ' . $customer->name . '! Berhasil masuk dengan Google.');
        } catch (\Exception $e) {
            \Log::error('Google Login Callback Error: ' . $e->getMessage());
            
            // Pesan error yang lebih user-friendly
            $errorMessage = 'Gagal masuk dengan Google.';
            if (str_contains($e->getMessage(), '401')) {
                $errorMessage = 'Konfigurasi Google tidak valid. Harap periksa Client ID dan Secret.';
            }
            
            return redirect()->route('customer.login')->with('error', $errorMessage);
        }
    }
}
