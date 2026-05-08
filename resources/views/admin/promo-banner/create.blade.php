@extends('layouts.admin')

@section('page-title', 'Tambah Banner Promo')

@section('content')
<style>
    .form-container {
        max-width: 900px;
        margin: 0 auto;
    }

    .card {
        background: linear-gradient(135deg, #2a2a2a 0%, #333 100%);
        border: 1px solid #FFD700;
        border-radius: 16px;
        padding: 2rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group label {
        display: block;
        color: #FFD700;
        margin-bottom: 0.5rem;
        font-weight: 600;
        font-size: 0.9rem;
    }

    .form-control {
        width: 100%;
        background: #1a1a1a;
        border: 1px solid #444;
        color: #fff;
        padding: 0.75rem 1rem;
        border-radius: 8px;
        transition: all 0.3s;
    }

    .form-control:focus {
        border-color: #FFD700;
        outline: none;
        box-shadow: 0 0 0 2px rgba(255, 215, 0, 0.2);
    }

    .btn-submit {
        background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%);
        color: #1a1a1a;
        padding: 0.8rem 2rem;
        border: none;
        border-radius: 8px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s;
        width: 100%;
        margin-top: 1rem;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 16px rgba(255, 215, 0, 0.3);
    }

    .image-preview {
        width: 100%;
        height: 150px;
        border: 2px dashed #444;
        border-radius: 8px;
        margin-top: 0.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #666;
        overflow: hidden;
        background-size: cover;
        background-position: center;
    }

    .grid-2 {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
    }

    .section-title {
        color: #fff;
        font-family: 'Playfair Display', serif;
        margin-bottom: 1.5rem;
        padding-bottom: 0.5rem;
        border-bottom: 1px solid #444;
        font-size: 1.25rem;
    }

    .product-select {
        height: 200px !important;
    }
</style>

<div class="form-container">
    <div style="margin-bottom: 2rem;">
        <a href="{{ route('admin.promo-banner.index') }}" style="color: #FFD700; text-decoration: none; display: flex; align-items: center; gap: 0.5rem;">
            <span>←</span> Kembali ke Daftar
        </a>
    </div>

    <form action="{{ route('admin.promo-banner.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <h2 class="section-title">Informasi Banner</h2>
            
            <div class="form-group">
                <label for="title">Judul Promo</label>
                <input type="text" name="title" id="title" class="form-control" placeholder="Contoh: Roti Sobek Premium Spesial" value="{{ old('title') }}" required>
                @error('title') <span style="color: #f44336; font-size: 0.8rem;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="subtitle">Deskripsi Promo</label>
                <textarea name="subtitle" id="subtitle" class="form-control" rows="3" placeholder="Masukkan deskripsi menarik...">{{ old('subtitle') }}</textarea>
            </div>

            <div class="grid-2">
                <div class="form-group">
                    <label for="price_original">Harga Asli (Rp)</label>
                    <input type="number" name="price_original" id="price_original" class="form-control" placeholder="35000" value="{{ old('price_original') }}" required>
                </div>
                <div class="form-group">
                    <label for="price_promo">Harga Diskon (Rp)</label>
                    <input type="number" name="price_promo" id="price_promo" class="form-control" placeholder="28000" value="{{ old('price_promo') }}" required>
                </div>
            </div>

            <div class="grid-2">
                <div class="form-group">
                    <label for="badge_text">Badge Promo (Kiri)</label>
                    <input type="text" name="badge_text" id="badge_text" class="form-control" placeholder="Contoh: SPECIAL" value="{{ old('badge_text') }}">
                </div>
                <div class="form-group">
                    <label for="discount_badge_text">Badge Diskon (Kanan)</label>
                    <input type="text" name="discount_badge_text" id="discount_badge_text" class="form-control" placeholder="Contoh: HEMAT 20%" value="{{ old('discount_badge_text') }}">
                </div>
            </div>

            <div class="grid-2">
                <div class="form-group">
                    <label for="end_time">Waktu Berakhir (Countdown)</label>
                    <input type="datetime-local" name="end_time" id="end_time" class="form-control" value="{{ old('end_time') }}">
                </div>
                <div class="form-group">
                    <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer; margin-top: 2rem;">
                        <input type="checkbox" name="is_active" value="1" checked>
                        <span>Aktifkan Banner Langsung</span>
                    </label>
                </div>
            </div>

            <h2 class="section-title" style="margin-top: 2rem;">Media & Gambar</h2>
            
            <div class="form-group">
                <label for="background_image">Background Banner (Rekomendasi: 1200x400)</label>
                <input type="file" name="background_image" id="background_image" class="form-control" onchange="previewImage(this, 'preview-bg')">
                <div id="preview-bg" class="image-preview">Pratinjau Background</div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label>Gambar Roti 1</label>
                    <input type="file" name="image_main" class="form-control" onchange="previewImage(this, 'preview-1')">
                    <div id="preview-1" class="image-preview">Roti 1</div>
                </div>
                <div class="form-group">
                    <label>Gambar Roti 2</label>
                    <input type="file" name="image_second" class="form-control" onchange="previewImage(this, 'preview-2')">
                    <div id="preview-2" class="image-preview">Roti 2</div>
                </div>
                <div class="form-group">
                    <label>Gambar Roti 3</label>
                    <input type="file" name="image_third" class="form-control" onchange="previewImage(this, 'preview-3')">
                    <div id="preview-3" class="image-preview">Roti 3</div>
                </div>
            </div>

            <h2 class="section-title" style="margin-top: 2rem;">Produk di Modal Popup</h2>
            <div class="form-group">
                <label for="promo_products">Pilih Produk yang Muncul di Modal (Tahan Ctrl/Cmd untuk pilih banyak)</label>
                <select name="promo_products[]" id="promo_products" class="form-control product-select" multiple>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }} - Rp {{ number_format($product->price, 0, ',', '.') }}</option>
                    @endforeach
                </select>
                <p style="color: #999; font-size: 0.75rem; margin-top: 0.5rem;">Produk ini akan muncul saat tombol "Pesan Sekarang" diklik.</p>
            </div>

            <button type="submit" class="btn-submit">Simpan Banner Promo</button>
        </div>
    </form>
</div>

<script>
    function previewImage(input, previewId) {
        const preview = document.getElementById(previewId);
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.style.backgroundImage = `url(${e.target.result})`;
                preview.innerHTML = '';
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
