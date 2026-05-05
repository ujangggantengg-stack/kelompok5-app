<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    /**
     * Show addresses page
     */
    public function index()
    {
        $customer = Auth::guard('customer')->user();
        $addresses = $customer->addresses()->active()->get();
        
        return view('customer.addresses.index', compact('customer', 'addresses'));
    }

    /**
     * Store new address
     */
    public function store(Request $request)
    {
        $customer = Auth::guard('customer')->user();

        $validated = $request->validate([
            'label' => 'required|string|max:50',
            'recipient_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'address_detail' => 'nullable|string',
            'city' => 'required|string|max:100',
            'district' => 'nullable|string|max:100',
            'province' => 'required|string|max:100',
            'postal_code' => 'nullable|string|max:10',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'is_primary' => 'boolean',
        ]);

        $address = $customer->addresses()->create($validated);

        if ($request->is_primary) {
            $address->setPrimary();
        }

        return back()->with('success', 'Alamat berhasil ditambahkan!');
    }

    /**
     * Update address
     */
    public function update(Request $request, $id)
    {
        $customer = Auth::guard('customer')->user();
        $address = $customer->addresses()->findOrFail($id);

        $validated = $request->validate([
            'label' => 'required|string|max:50',
            'recipient_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'address_detail' => 'nullable|string',
            'city' => 'required|string|max:100',
            'district' => 'nullable|string|max:100',
            'province' => 'required|string|max:100',
            'postal_code' => 'nullable|string|max:10',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        $address->update($validated);

        if ($request->is_primary) {
            $address->setPrimary();
        }

        return back()->with('success', 'Alamat berhasil diperbarui!');
    }

    /**
     * Set address as primary
     */
    public function setPrimary($id)
    {
        $customer = Auth::guard('customer')->user();
        $address = $customer->addresses()->findOrFail($id);
        
        $address->setPrimary();

        return back()->with('success', 'Alamat utama berhasil diubah!');
    }

    /**
     * Delete address
     */
    public function destroy($id)
    {
        $customer = Auth::guard('customer')->user();
        $address = $customer->addresses()->findOrFail($id);
        
        $address->update(['is_active' => false]);

        return back()->with('success', 'Alamat berhasil dihapus!');
    }
}
