<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Show order history
     */
    public function index()
    {
        $customer = Auth::guard('customer')->user();
        $orders = $customer->orders()
            ->with('items.product')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('customer.orders.index', compact('customer', 'orders'));
    }

    /**
     * Show order detail
     */
    public function show($id)
    {
        $customer = Auth::guard('customer')->user();
        $order = $customer->orders()
            ->with('items.product')
            ->findOrFail($id);

        return view('customer.orders.show', compact('customer', 'order'));
    }

    /**
     * Reorder
     */
    public function reorder($id)
    {
        $customer = Auth::guard('customer')->user();
        $order = $customer->orders()->with('items.product')->findOrFail($id);

        // Add items to cart or redirect to checkout with items
        $cartItems = [];
        foreach ($order->items as $item) {
            if ($item->product && $item->product->is_available) {
                $cartItems[] = [
                    'id' => $item->product->id,
                    'name' => $item->product->name,
                    'price' => $item->product->price,
                    'quantity' => $item->quantity,
                ];
            }
        }

        session(['reorder_items' => $cartItems]);

        return redirect('/')->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }
}
