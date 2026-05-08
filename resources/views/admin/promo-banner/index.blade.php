@extends('layouts.admin')

@section('page-title', 'Banner Promo')

@section('content')
<style>
    .banners-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }
    
    .add-btn {
        background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%);
        color: #1a1a1a;
        padding: 0.75rem 1.5rem;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .add-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 16px rgba(255, 215, 0, 0.3);
    }

    .banner-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 1.5rem;
    }

    .banner-card {
        background: linear-gradient(135deg, #2a2a2a 0%, #333 100%);
        border: 1px solid #FFD700;
        border-radius: 16px;
        overflow: hidden;
        transition: all 0.3s;
        position: relative;
    }

    .banner-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.5);
    }

    .banner-image {
        height: 180px;
        background-size: cover;
        background-position: center;
        position: relative;
    }

    .banner-status {
        position: absolute;
        top: 1rem;
        right: 1rem;
        padding: 0.4rem 0.8rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 700;
        z-index: 2;
    }

    .status-active { background: rgba(76, 175, 80, 0.9); color: #fff; }
    .status-inactive { background: rgba(244, 67, 54, 0.9); color: #fff; }

    .banner-info {
        padding: 1.5rem;
    }

    .banner-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: #FFD700;
        margin-bottom: 0.5rem;
        font-family: 'Playfair Display', serif;
    }

    .banner-prices {
        display: flex;
        gap: 1rem;
        align-items: center;
        margin-bottom: 1rem;
    }

    .price-promo {
        color: #FFD700;
        font-weight: 800;
        font-size: 1.1rem;
    }

    .price-original {
        color: #999;
        text-decoration: line-through;
        font-size: 0.9rem;
    }

    .banner-actions {
        display: flex;
        gap: 0.5rem;
        margin-top: 1rem;
    }

    .action-btn {
        flex: 1;
        padding: 0.6rem;
        border-radius: 8px;
        text-align: center;
        text-decoration: none;
        font-size: 0.85rem;
        font-weight: 600;
        transition: all 0.3s;
        cursor: pointer;
        border: none;
    }

    .edit-btn { background: rgba(255, 215, 0, 0.1); color: #FFD700; border: 1px solid #FFD700; }
    .edit-btn:hover { background: #FFD700; color: #1a1a1a; }

    .delete-btn { background: rgba(244, 67, 54, 0.1); color: #f44336; border: 1px solid #f44336; }
    .delete-btn:hover { background: #f44336; color: #fff; }

    .toggle-btn { background: rgba(255, 255, 255, 0.1); color: #fff; border: 1px solid #555; }
    .toggle-btn:hover { background: rgba(255, 255, 255, 0.2); }
</style>

<div class="banners-header">
    <div>
        <h1 style="color: #FFD700; font-family: 'Playfair Display', serif; font-size: 2rem;">Manajemen Banner Promo</h1>
        <p style="color: #999;">Atur tampilan promo di halaman utama</p>
    </div>
    <a href="{{ route('admin.promo-banner.create') }}" class="add-btn">
        <span>+</span> Tambah Banner Baru
    </a>
</div>

@if(session('success'))
    <div style="background: rgba(76, 175, 80, 0.2); color: #4CAF50; padding: 1rem; border-radius: 8px; margin-bottom: 2rem; border: 1px solid #4CAF50;">
        {{ session('success') }}
    </div>
@endif

<div class="banner-grid">
    @foreach($banners as $banner)
    <div class="banner-card">
        <div class="banner-image" style="background-image: linear-gradient(to bottom, rgba(0,0,0,0.3), rgba(0,0,0,0.7)), url('{{ asset($banner->background_image ?? 'images/hero/slide1.jpg') }}')">
            <span class="banner-status {{ $banner->is_active ? 'status-active' : 'status-inactive' }}">
                {{ $banner->is_active ? 'AKTIF' : 'NONAKTIF' }}
            </span>
        </div>
        <div class="banner-info">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <h3 class="banner-title">{{ $banner->title }}</h3>
                <span style="background: #FFD700; color: #1a1a1a; padding: 0.2rem 0.5rem; border-radius: 4px; font-size: 0.7rem; font-weight: 800;">
                    {{ $banner->badge_text ?? 'PROMO' }}
                </span>
            </div>
            <p style="color: #ccc; font-size: 0.85rem; margin-bottom: 1rem; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                {{ $banner->subtitle }}
            </p>
            <div class="banner-prices">
                <span class="price-promo">Rp {{ number_format($banner->price_promo, 0, ',', '.') }}</span>
                <span class="price-original">Rp {{ number_format($banner->price_original, 0, ',', '.') }}</span>
            </div>
            <div style="font-size: 0.75rem; color: #999; margin-bottom: 1rem;">
                <span>⏳ Berakhir: {{ $banner->end_time ? $banner->end_time->format('d M Y, H:i') : 'Tidak diatur' }}</span>
            </div>
            
            <div class="banner-actions">
                <a href="{{ route('admin.promo-banner.edit', $banner->id) }}" class="action-btn edit-btn">Edit</a>
                <form action="{{ route('admin.promo-banner.toggle', $banner->id) }}" method="POST" style="flex: 1;">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="action-btn toggle-btn">{{ $banner->is_active ? 'Nonaktifkan' : 'Aktifkan' }}</button>
                </form>
                <form action="{{ route('admin.promo-banner.destroy', $banner->id) }}" method="POST" style="flex: 1;" onsubmit="return confirm('Yakin ingin menghapus banner ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="action-btn delete-btn">Hapus</button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>

@if($banners->isEmpty())
    <div style="text-align: center; padding: 4rem; background: rgba(255,255,255,0.05); border-radius: 16px; border: 1px dashed #555;">
        <span style="font-size: 3rem;">📢</span>
        <h3 style="color: #fff; margin-top: 1rem;">Belum ada banner promo</h3>
        <p style="color: #999;">Klik tombol "Tambah Banner Baru" untuk memulai.</p>
    </div>
@endif
@endsection
