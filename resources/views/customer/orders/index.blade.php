<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Saya - Dapoer Budess</title>
    <link rel="stylesheet" href="/css/customer-profile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="customer-container">
        <!-- Header -->
        <div class="customer-header">
            <div class="customer-header-left">
                <a href="/" class="back-link">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h1>Pesanan Saya</h1>
            </div>
            <form method="POST" action="{{ route('customer.logout') }}">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>

        @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            <span>{{ session('success') }}</span>
        </div>
        @endif

        <div class="customer-layout">
            <!-- Sidebar -->
            <div class="customer-sidebar">
                <div class="customer-avatar-section">
                    <img src="{{ $customer->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($customer->name) }}" 
                         alt="{{ $customer->name }}" 
                         class="customer-avatar">
                    <div class="customer-name">{{ $customer->name }}</div>
                    <div class="customer-email">{{ $customer->email }}</div>
                </div>

                <nav class="customer-menu">
                    <a href="{{ route('customer.profile') }}" class="menu-item">
                        <i class="fas fa-user"></i>
                        <span>Profil Saya</span>
                    </a>
                    <a href="{{ route('customer.addresses') }}" class="menu-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>Alamat Saya</span>
                    </a>
                    <a href="{{ route('customer.orders') }}" class="menu-item active">
                        <i class="fas fa-shopping-bag"></i>
                        <span>Pesanan Saya</span>
                    </a>
                </nav>
            </div>

            <!-- Main Content -->
            <div class="customer-main">
                <div class="content-card">
                    <h3>Riwayat Pesanan</h3>

                    @if($orders->count() > 0)
                        @foreach($orders as $order)
                        <div class="order-card">
                            <div class="order-header">
                                <div>
                                    <div class="order-number">Order #{{ $order->order_number }}</div>
                                    <div class="order-date">{{ $order->created_at->format('d M Y, H:i') }}</div>
                                </div>
                                <span class="order-status status-{{ $order->status }}">
                                    @if($order->status === 'pending')
                                        Menunggu Pembayaran
                                    @elseif($order->status === 'pending_payment')
                                        Menunggu Pembayaran
                                    @elseif($order->status === 'processing')
                                        Diproses
                                    @elseif($order->status === 'completed')
                                        Selesai
                                    @elseif($order->status === 'cancelled')
                                        Dibatalkan
                                    @else
                                        {{ ucfirst($order->status) }}
                                    @endif
                                </span>
                            </div>

                            @foreach($order->items as $item)
                            <div class="order-items">
                                @php
                                    $imageUrl = '/images/roti.jpg'; // Default fallback
                                    $debugInfo = 'Using fallback';
                                    
                                    if ($item->product_id) {
                                        if ($item->product) {
                                            if ($item->product->image) {
                                                $imageUrl = $item->product->image_url;
                                                $debugInfo = 'Product image: ' . $item->product->image;
                                            } else {
                                                $debugInfo = 'Product exists but no image';
                                            }
                                        } else {
                                            $debugInfo = 'Product ID: ' . $item->product_id . ' but product not found';
                                        }
                                    } else {
                                        $debugInfo = 'No product_id';
                                    }
                                @endphp
                                <img src="{{ $imageUrl }}" 
                                     alt="{{ $item->product_name }}" 
                                     class="order-item-image"
                                     title="{{ $debugInfo }}"
                                     onerror="this.src='/images/rooti.jpg'">
                                <div class="order-item-info">
                                    <div class="order-item-name">{{ $item->product_name }}</div>
                                    <div class="order-item-qty">{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</div>
                                    @if(config('app.debug'))
                                    <div style="font-size: 10px; color: #999;">{{ $debugInfo }}</div>
                                    @endif
                                </div>
                                <div class="order-item-price">
                                    Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                                </div>
                            </div>
                            @endforeach

                            <div class="order-summary">
                                <div class="order-summary-row">
                                    <span>Subtotal Produk:</span>
                                    <span>Rp {{ number_format($order->items->sum(function($item) { return $item->price * $item->quantity; }), 0, ',', '.') }}</span>
                                </div>
                                @if($order->shipping_cost > 0)
                                <div class="order-summary-row">
                                    <span>Ongkos Kirim:</span>
                                    <span>Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
                                </div>
                                @endif
                                @if($order->discount_amount > 0)
                                <div class="order-summary-row discount">
                                    <span>Diskon:</span>
                                    <span>- Rp {{ number_format($order->discount_amount, 0, ',', '.') }}</span>
                                </div>
                                @endif
                                <div class="order-total">
                                    <span>Total Pembayaran:</span>
                                    <span>Rp {{ number_format($order->final_total, 0, ',', '.') }}</span>
                                </div>
                            </div>

                            <div style="margin-top: 1rem;">
                                <a href="{{ route('customer.orders.show', $order->id) }}" class="btn-detail">
                                    <i class="fas fa-eye"></i> Lihat Detail
                                </a>
                            </div>
                        </div>
                        @endforeach

                        <div style="margin-top: 1.5rem;">
                            {{ $orders->links() }}
                        </div>
                    @else
                        <div class="empty-state">
                            <i class="fas fa-shopping-bag"></i>
                            <p>Belum ada pesanan</p>
                            <a href="/" class="btn btn-primary">
                                <i class="fas fa-shopping-cart"></i>
                                <span>Mulai Belanja</span>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>
</html>
