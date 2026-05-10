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
            max-height: 600px;
            overflow-y: auto;
        }

        .order-item {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 16px;
            border-bottom: 1px solid #f0f0f0;
            transition: background 0.2s;
        }

        .order-item:hover {
            background: #fafafa;
        }

        .order-item:last-child {
            border-bottom: none;
        }

        .item-image {
            width: 80px;
            height: 80px;
            min-width: 80px;
            border-radius: 8px;
            object-fit: cover;
            background: #f5f5f5;
            border: 2px solid #e0e0e0;
        }

        .item-details {
            flex: 1;
            min-width: 0;
        }

        .item-name {
            font-weight: 600;
            color: #333;
            margin-bottom: 6px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .item-quantity {
            color: #666;
            font-size: 14px;
        }

        .item-price {
            font-weight: 600;
            color: #FF6B35;
            font-size: 16px;
            white-space: nowrap;
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
            .container {
                padding: 12px;
            }

            .order-detail {
                padding: 20px;
            }

            .order-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }

            .order-title {
                font-size: 20px;
            }

            .info-grid {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .order-items {
                max-height: 500px;
            }

            .order-item {
                padding: 12px;
                gap: 12px;
            }

            .item-image {
                width: 70px;
                height: 70px;
                min-width: 70px;
            }

            .item-name {
                font-size: 14px;
                white-space: normal;
                line-height: 1.4;
            }

            .item-quantity {
                font-size: 13px;
            }

            .item-price {
                font-size: 15px;
            }

            .summary {
                padding: 16px;
            }

            .summary-row {
                font-size: 14px;
            }

            .summary-row.total {
                font-size: 16px;
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
            @if($order->customer_address)
            <div class="section">
                <h2 class="section-title">Alamat Pengiriman</h2>
                <div class="info-value">
                    {{ $order->customer_address }}
                    @if($order->city), {{ $order->city }}@endif
                </div>
            </div>
            @endif

            <!-- Order Items -->
            <div class="section">
                <h2 class="section-title">Produk yang Dipesan</h2>
                <div class="order-items">
                    @foreach($order->items as $item)
                        <div class="order-item">
                            @php
                                $imageUrl = '/images/rooti.jpg'; // Default fallback
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
                                        $debugInfo = 'Product ID: ' . $item->product_id . ' but product not found (deleted?)';
                                    }
                                } else {
                                    $debugInfo = 'No product_id in order item';
                                }
                            @endphp
                            <img src="{{ $imageUrl }}" 
                                 alt="{{ $item->product_name }}" 
                                 class="item-image"
                                 title="{{ $debugInfo }}"
                                 onerror="this.src='/images/rooti.jpg'; console.log('Image load error: {{ $debugInfo }}');">
                            <div class="item-details">
                                <div class="item-name">{{ $item->product_name }}</div>
                                <div class="item-quantity">{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</div>
                                @if(config('app.debug'))
                                <div style="font-size: 11px; color: #999; margin-top: 4px;">{{ $debugInfo }}</div>
                                @endif
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
                        <span>Rp {{ number_format($order->items->sum(function($item) { return $item->price * $item->quantity; }), 0, ',', '.') }}</span>
                    </div>
                    @if($order->shipping_cost > 0)
                    <div class="summary-row">
                        <span>Ongkos Kirim</span>
                        <span>Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
                    </div>
                    @endif
                    @if($order->discount_amount > 0)
                    <div class="summary-row" style="color: #4CAF50;">
                        <span>Diskon</span>
                        <span>- Rp {{ number_format($order->discount_amount, 0, ',', '.') }}</span>
                    </div>
                    @endif
                    <div class="summary-row total">
                        <span>Total Pembayaran</span>
                        <span>Rp {{ number_format($order->final_total, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
