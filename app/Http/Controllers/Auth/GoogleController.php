<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Exception;

class GoogleController extends Controller
{
    /**
     * Redirect to Google OAuth
     */
    public function redirect()
    {
        return Socialite::driver('google')
            ->stateless()
            ->with(['guzzle' => ['verify' => false]])
            ->redirect();
    }

    /**
     * Handle Google OAuth callback
     */
    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')
                ->stateless()
                ->setHttpClient(new \GuzzleHttp\Client(['verify' => false]))
                ->user();
            
            // Check if customer already exists by email or google_id
            $customer = Customer::where('google_id', $googleUser->id)
                ->orWhere('email', $googleUser->email)
                ->first();
            
            if ($customer) {
                // Update existing customer
                $customer->update([
                    'google_id' => $googleUser->id,
                    'name' => $googleUser->name,
                    'avatar' => $googleUser->avatar,
                    'email_verified_at' => now(),
                ]);
            } else {
                // Create new customer
                $customer = Customer::create([
                    'google_id' => $googleUser->id,
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'avatar' => $googleUser->avatar,
                    'email_verified_at' => now(),
                    'password' => null, // No password for Google OAuth users
                ]);
            }

            Auth::guard('customer')->login($customer);

            return redirect('/')->with('success', 'Berhasil login dengan Google!');
            
        } catch (Exception $e) {
            \Log::error('Google OAuth Error: ' . $e->getMessage());
            return redirect('/customer/login')->with('error', 'Gagal login dengan Google: ' . $e->getMessage());
        }
    }
}
