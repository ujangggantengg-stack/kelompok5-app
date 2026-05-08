<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PromoBanner;
use App\Models\PromoProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class PromoBannerController extends Controller
{
    public function index()
    {
        $banners = PromoBanner::latest()->get();
        return view('admin.promo-banner.index', compact('banners'));
    }

    public function create()
    {
        $products = Product::all();
        return view('admin.promo-banner.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string',
            'badge_text' => 'nullable|string|max:50',
            'discount_badge_text' => 'nullable|string|max:50',
            'price_original' => 'required|numeric',
            'price_promo' => 'required|numeric',
            'background_image' => 'nullable|image|max:2048',
            'image_main' => 'nullable|image|max:2048',
            'image_second' => 'nullable|image|max:2048',
            'image_third' => 'nullable|image|max:2048',
            'end_time' => 'nullable|date',
            'promo_products' => 'nullable|array',
            'promo_products.*' => 'exists:products,id',
        ]);

        $data = $request->except(['background_image', 'image_main', 'image_second', 'image_third', 'promo_products']);
        $data['is_active'] = $request->has('is_active');

        // Handle Image Uploads
        $imageFields = ['background_image', 'image_main', 'image_second', 'image_third'];
        foreach ($imageFields as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $filename = time() . '_' . $field . '_' . $file->getClientOriginalName();
                $file->move(public_path('images/promo'), $filename);
                $data[$field] = 'images/promo/' . $filename;
            }
        }

        $banner = PromoBanner::create($data);

        // Sync promo products
        if ($request->has('promo_products')) {
            foreach ($request->promo_products as $index => $productId) {
                PromoProduct::create([
                    'promo_banner_id' => $banner->id,
                    'product_id' => $productId,
                    'order' => $index,
                ]);
            }
        }

        return redirect()->route('admin.promo-banner.index')->with('success', 'Banner promo berhasil dibuat!');
    }

    public function edit(PromoBanner $promoBanner)
    {
        $products = Product::all();
        $selectedProducts = $promoBanner->products->pluck('product_id')->toArray();
        return view('admin.promo-banner.edit', compact('promoBanner', 'products', 'selectedProducts'));
    }

    public function update(Request $request, PromoBanner $promoBanner)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string',
            'badge_text' => 'nullable|string|max:50',
            'discount_badge_text' => 'nullable|string|max:50',
            'price_original' => 'required|numeric',
            'price_promo' => 'required|numeric',
            'background_image' => 'nullable|image|max:2048',
            'image_main' => 'nullable|image|max:2048',
            'image_second' => 'nullable|image|max:2048',
            'image_third' => 'nullable|image|max:2048',
            'end_time' => 'nullable|date',
            'promo_products' => 'nullable|array',
            'promo_products.*' => 'exists:products,id',
        ]);

        $data = $request->except(['background_image', 'image_main', 'image_second', 'image_third', 'promo_products']);
        $data['is_active'] = $request->has('is_active');

        // Handle Image Uploads
        $imageFields = ['background_image', 'image_main', 'image_second', 'image_third'];
        foreach ($imageFields as $field) {
            if ($request->hasFile($field)) {
                // Delete old image
                if ($promoBanner->$field && File::exists(public_path($promoBanner->$field))) {
                    File::delete(public_path($promoBanner->$field));
                }

                $file = $request->file($field);
                $filename = time() . '_' . $field . '_' . $file->getClientOriginalName();
                $file->move(public_path('images/promo'), $filename);
                $data[$field] = 'images/promo/' . $filename;
            }
        }

        $promoBanner->update($data);

        // Update promo products
        $promoBanner->products()->delete();
        if ($request->has('promo_products')) {
            foreach ($request->promo_products as $index => $productId) {
                PromoProduct::create([
                    'promo_banner_id' => $promoBanner->id,
                    'product_id' => $productId,
                    'order' => $index,
                ]);
            }
        }

        return redirect()->route('admin.promo-banner.index')->with('success', 'Banner promo berhasil diperbarui!');
    }

    public function destroy(PromoBanner $promoBanner)
    {
        // Delete images
        $imageFields = ['background_image', 'image_main', 'image_second', 'image_third'];
        foreach ($imageFields as $field) {
            if ($promoBanner->$field && File::exists(public_path($promoBanner->$field))) {
                File::delete(public_path($promoBanner->$field));
            }
        }

        $promoBanner->delete();
        return redirect()->route('admin.promo-banner.index')->with('success', 'Banner promo berhasil dihapus!');
    }

    public function toggleStatus(PromoBanner $promoBanner)
    {
        $promoBanner->update(['is_active' => !$promoBanner->is_active]);
        return response()->json(['success' => true, 'is_active' => $promoBanner->is_active]);
    }
}
