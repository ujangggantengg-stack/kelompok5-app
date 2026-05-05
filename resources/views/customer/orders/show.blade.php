<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan #{{ $order->id }} - Toko Roti</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f5f5f5;
            color: #333;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #666;
            text-decoration: none;
            margin-bottom: 20px;
            padding: 8px 16px;
            border-radius: 8px;
            transition: all 0.2s;
        }

        .back-btn:hover {
            background: white;
            color: #FF6B35;
        }

        .order-detail {
            background: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #f0f0f0;
        }

        .order-title {
            font-size: 24px;
            font-weight: 700;
            color: #333;
        }

        .status-badge {
            padding: 8px 20px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
        }

        .status-pending {
            background: #FFF3E0;
            color: #FF6B35;
        }

        .status-processing {
            background: #E3F2FD;
            color: #2196F3;
        }

        .status-completed {
            background: #E8F5E9;
            color: #4CAF50;
        }

        .status-cancelled {
            background: #FFEBEE;
            color: #F44336;
        }

        .section {
            margin-bottom: 30px;
        }

        .section-title {
            font-size: 16px;
            font-weight: 600;
            color: #333;
            margin-bottom: 16px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }

        .info-item {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .info-label {
            font-size: 13px;
            color: #999;
        }

        .info-value {
            font-size: 15px;
            color: #333;
            font-weight: 500;
        }

        .order-items {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            overflow: hidden;
        }

        .order-item {
            display: flex;
            gap: 16px;
            padding: 16px;
            border-bottom: 1px solid #f0f0f0;
        }

        .order-item:last-child {
            border-bottom: none;
        }

        .item-image {
            width: 80px;
            height: 80px;
            border-radius: 8px;
            object-fit: cover;
            background: #f5f5f5;
        }

        .item-details {
            flex: 1;
        }

        .item-name {
            font-weight: 600;
            color: #333;
            margin-bottom: 6px;
        }

        .item-quantity {
            color: #666;
            font-size: 14px;
        }

        .item-price {
            font-weight: 600;
            color: #FF6B35;
            font-size: 16px;
        }

        .summary {
            background: #f9f9f9;
            border-radius: 8px;
            padding: 20px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            font-size: 15px;
        }

        .summary-row.total {
            font-size: 18px;
            font-weight: 700;
            color: #333;
            padding-top: 12px;
            border-top: 2px solid #e0e0e0;
            margin-top: 12px;
        }

        @media (max-width: 768px) {
            .order-detail {
                padding: 20px;
            }

            .order-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .order-item {
                flex-direction: column;
            }

            .item-image {
                width: 100%;
                height: 200px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="{{ route('customer.orders') }}" class="back-btn">
            ← Kembali ke Pesanan
        </a>

        <div class="order-detail">
            <div class="order-header">
                <h1 class="order-title">Order #{{ $order->id }}</h1>
                <span class="status-badge status-{{ $order->status }}">
                    @if($order->status === 'pending') Menunggu Pembayaran
                    @elseif($order->status === 'processing') Diproses
                    @elseif($order->status === 'completed') Selesai
                    @elseif($order->status === 'cancelled') Dibatalkan
                    @else {{ ucfirst($order->status) }}
                    @endif
                </span>
            </div>

            <!-- Order Info -->
            <div class="section">
                <h2 class="section-title">Informasi Pesanan</h2>
                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label">Tanggal Pesanan</span>
                        <span class="info-value">{{ $order->created_at->format('d M Y, H:i') }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Metode Pembayaran</span>
                        <span class="info-value">{{ $order->payment_method ?? 'Belum dipilih' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Nama Penerima</span>
                        <span class="info-value">{{ $order->customer_name }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Nomor Telepon</span>
                        <span class="info-value">{{ $order->customer_phone }}</span>
                    </div>
                </div>
            </div>

            <!-- Shipping Address -->
            <div class="section">
                <h2 class="section-title">Alamat Pengiriman</h2>
                <div class="info-value">
                    {{ $order->shipping_address }}<br>
                    {{ $order->shipping_city }}, {{ $order->shipping_province }}
                </div>
            </div>

            <!-- Order Items -->
            <div class="section">
                <h2 class="section-title">Produk yang Dipesan</h2>
                <div class="order-items">
                    @foreach($order->items as $item)
                        <div class="order-item">
                            <img src="{{ $item->product->image ?? '/images/placeholder.jpg' }}" 
                                 alt="{{ $item->product_name }}" 
                                 class="item-image">
                            <div class="item-details">
                                <div class="item-name">{{ $item->product_name }}</div>
                                <div class="item-quantity">{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</div>
                            </div>
                            <div class="item-price">
                                Rp {{ number_format($item->quantity * $item->price, 0, ',', '.') }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Order Summary -->
            <div class="section">
                <h2 class="section-title">Ringkasan Pembayaran</h2>
                <div class="summary">
                    <div class="summary-row">
                        <span>Subtotal Produk</span>
                        <span>Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span>
                    </div>
                    <div class="summary-row">
                        <span>Ongkos Kirim</span>
                        <span>Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
                    </div>
                    <div class="summary-row total">
                        <span>Total Pembayaran</span>
                        <span>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
