<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class ProfileController extends Controller
{
    /**
     * Show profile page
     */
    public function index()
    {
        $customer = Auth::guard('customer')->user();
        return view('customer.profile.index', compact('customer'));
    }

    /**
     * Update profile
     */
    public function update(Request $request)
    {
        $customer = Auth::guard('customer')->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email,' . $customer->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:100',
            'province' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:10',
        ]);

        $customer->update($request->only([
            'name', 'email', 'phone', 'address', 
            'city', 'province', 'postal_code'
        ]));

        return back()->with('success', 'Profile berhasil diperbarui!');
    }

    /**
     * Update password
     */
    public function updatePassword(Request $request)
    {
        $customer = Auth::guard('customer')->user();

        $request->validate([
            'current_password' => 'required',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        if (!Hash::check($request->current_password, $customer->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini salah.']);
        }

        $customer->update([
            'password' => Hash::make($request->password)
        ]);

        return back()->with('success', 'Password berhasil diubah!');
    }

    /**
     * Upload avatar
     */
    public function uploadAvatar(Request $request)
    {
        $customer = Auth::guard('customer')->user();

        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars', 'public');
            $customer->update(['avatar' => '/storage/' . $path]);
        }

        return back()->with('success', 'Foto profil berhasil diperbarui!');
    }
}
