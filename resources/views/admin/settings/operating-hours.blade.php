@extends('layouts.admin')

@section('title', 'Jam Operasional Toko')

@section('content')
<style>
    .settings-container {
        max-width: 900px;
        margin: 0 auto;
    }

    .settings-card {
        background: linear-gradient(145deg, #1a1a2e 0%, #16213e 100%);
        border-radius: 16px;
        box-shadow: 0 8px 32px rgba(0,0,0,0.4);
        padding: 2rem;
        margin-bottom: 2rem;
        border: 1px solid rgba(255,255,255,0.1);
    }

    .settings-header {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 2rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid rgba(255,255,255,0.1);
    }

    .settings-header h1 {
        font-size: 1.75rem;
        color: #ffffff;
        margin: 0;
        font-family: 'Playfair Display', serif;
        font-weight: 700;
    }

    .settings-icon {
        font-size: 2.5rem;
        filter: drop-shadow(0 0 10px rgba(255,215,0,0.3));
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group label {
        display: block;
        font-weight: 600;
        color: #e0e0e0;
        margin-bottom: 0.5rem;
        font-size: 0.95rem;
    }

    .form-group input[type="time"],
    .form-group select {
        width: 100%;
        padding: 0.75rem 1rem;
        background: rgba(255,255,255,0.05);
        border: 2px solid rgba(255,255,255,0.1);
        border-radius: 8px;
        font-size: 1rem;
        color: #ffffff;
        transition: all 0.3s;
    }

    .form-group input[type="time"]:focus,
    .form-group select:focus {
        outline: none;
        background: rgba(255,255,255,0.08);
        border-color: #ffd700;
        box-shadow: 0 0 0 3px rgba(255,215,0,0.1);
    }

    .time-range {
        display: grid;
        grid-template-columns: 1fr auto 1fr;
        gap: 1rem;
        align-items: center;
    }

    .time-separator {
        font-weight: 600;
        color: #888;
        text-align: center;
    }

    .day-section {
        background: rgba(255,255,255,0.03);
        padding: 1.5rem;
        border-radius: 12px;
        margin-bottom: 1.5rem;
        border-left: 4px solid #ffd700;
        backdrop-filter: blur(10px);
    }

    .day-section h3 {
        color: #ffffff;
        margin-bottom: 1rem;
        font-size: 1.1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-weight: 600;
    }

    .btn-save {
        background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%);
        color: #1a1a2e;
        padding: 0.875rem 2rem;
        border: none;
        border-radius: 8px;
        font-size: 1rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s;
        box-shadow: 0 4px 20px rgba(255,215,0,0.3);
        width: 100%;
    }

    .btn-save:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 28px rgba(255,215,0,0.5);
        background: linear-gradient(135deg, #ffed4e 0%, #ffd700 100%);
    }

    .alert {
        padding: 1rem 1.5rem;
        border-radius: 8px;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .alert-success {
        background: rgba(16, 185, 129, 0.15);
        border-left: 4px solid #10b981;
        color: #6ee7b7;
        border: 1px solid rgba(16, 185, 129, 0.3);
    }

    .info-box {
        background: rgba(255,215,0,0.1);
        border-left: 4px solid #ffd700;
        padding: 1rem 1.5rem;
        border-radius: 8px;
        margin-bottom: 2rem;
        border: 1px solid rgba(255,215,0,0.2);
    }

    .info-box p {
        margin: 0;
        color: #e0e0e0;
        line-height: 1.6;
    }

    .info-box strong {
        color: #ffd700;
    }

    .checkbox-group {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 1rem;
        background: rgba(255,255,255,0.05);
        border-radius: 8px;
        border: 2px solid rgba(255,255,255,0.1);
        cursor: pointer;
        transition: all 0.3s;
    }

    .checkbox-group:hover {
        border-color: #ffd700;
        background: rgba(255,215,0,0.05);
    }

    .checkbox-group input[type="checkbox"] {
        width: 20px;
        height: 20px;
        cursor: pointer;
        accent-color: #ffd700;
    }

    .checkbox-group label {
        margin: 0 !important;
        cursor: pointer;
        flex: 1;
        color: #e0e0e0;
    }

    .summary-card-item {
        transition: all 0.3s ease;
    }

    .summary-card-item:hover {
        transform: translateY(-3px);
        background: rgba(255,255,255,0.12) !important;
        box-shadow: 0 8px 24px rgba(0,0,0,0.3);
    }

    @media (max-width: 768px) {
        .settings-card {
            padding: 1.5rem;
        }

        .time-range {
            grid-template-columns: 1fr;
            gap: 0.75rem;
        }

        .time-separator {
            display: none;
        }
    }
</style>

<div class="settings-container">
    @if(session('success'))
    <div class="alert alert-success">
        <span style="font-size: 1.5rem;">✓</span>
        <span>{{ session('success') }}</span>
    </div>
    @endif

    <div class="settings-card">
        <div class="settings-header">
            <span class="settings-icon">🕐</span>
            <h1>Jam Operasional Toko</h1>
        </div>

        <div class="info-box">
            <p><strong>ℹ️ Informasi:</strong> Pengaturan jam operasional akan mempengaruhi notifikasi yang ditampilkan kepada customer saat toko tutup. Customer tetap bisa memesan, namun akan diberi tahu bahwa pesanan akan diproses sesuai jam operasional.</p>
        </div>

        <form action="{{ route('admin.settings.update-operating-hours') }}" method="POST">
            @csrf

            <!-- Senin - Jumat -->
            <div class="day-section">
                <h3>📅 Senin - Jumat</h3>
                <div class="time-range">
                    <div class="form-group" style="margin-bottom: 0;">
                        <label>Jam Buka</label>
                        <input type="time" name="weekday_open" value="{{ $settings['weekday_open'] }}" required>
                    </div>
                    <div class="time-separator">—</div>
                    <div class="form-group" style="margin-bottom: 0;">
                        <label>Jam Tutup</label>
                        <input type="time" name="weekday_close" value="{{ $settings['weekday_close'] }}" required>
                    </div>
                </div>
            </div>

            <!-- Sabtu -->
            <div class="day-section">
                <h3>📅 Sabtu</h3>
                <div class="time-range">
                    <div class="form-group" style="margin-bottom: 0;">
                        <label>Jam Buka</label>
                        <input type="time" name="saturday_open" value="{{ $settings['saturday_open'] }}" required>
                    </div>
                    <div class="time-separator">—</div>
                    <div class="form-group" style="margin-bottom: 0;">
                        <label>Jam Tutup</label>
                        <input type="time" name="saturday_close" value="{{ $settings['saturday_close'] }}" required>
                    </div>
                </div>
            </div>

            <!-- Minggu -->
            <div class="day-section">
                <h3>📅 Minggu</h3>
                <div class="checkbox-group">
                    <input type="checkbox" name="sunday_closed" id="sunday_closed" value="1" {{ $settings['sunday_closed'] == '1' ? 'checked' : '' }}>
                    <label for="sunday_closed">Tutup di hari Minggu</label>
                </div>
            </div>

            <button type="submit" class="btn-save">
                💾 Simpan Pengaturan
            </button>
        </form>
    </div>

    <!-- Preview Card - Dark Professional Design -->
    <div class="settings-card" style="background: linear-gradient(145deg, #0f0f1e 0%, #1a1a2e 100%); color: white; box-shadow: 0 12px 40px rgba(0,0,0,0.6); border: 1px solid rgba(255,215,0,0.2);">
        <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem; padding-bottom: 1rem; border-bottom: 2px solid rgba(255,215,0,0.2);">
            <span style="font-size: 2.5rem; filter: drop-shadow(0 0 10px rgba(255,215,0,0.5));">📋</span>
            <div>
                <h3 style="color: #ffd700; margin: 0; font-size: 1.5rem; font-family: 'Playfair Display', serif; font-weight: 700;">Ringkasan Jam Operasional</h3>
                <p style="margin: 0.25rem 0 0 0; opacity: 0.8; font-size: 0.9rem; color: #b0b0b0;">Jam operasional yang sedang aktif</p>
            </div>
        </div>
        
        <div style="display: grid; gap: 1rem;">
            <!-- Senin - Jumat -->
            <div class="summary-card-item" style="background: rgba(255,255,255,0.05); backdrop-filter: blur(10px); padding: 1.25rem; border-radius: 12px; border: 1px solid rgba(255,215,0,0.2); box-shadow: 0 4px 12px rgba(0,0,0,0.2);">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <span style="font-size: 1.75rem;">📅</span>
                        <div>
                            <div style="font-weight: 600; font-size: 1.05rem; color: #ffffff;">Senin - Jumat</div>
                            <div style="opacity: 0.7; font-size: 0.85rem; margin-top: 0.25rem; color: #b0b0b0;">Hari Kerja</div>
                        </div>
                    </div>
                    <div style="text-align: right;">
                        <div style="font-size: 1.25rem; font-weight: 700; font-family: 'Courier New', monospace; color: #ffd700;">
                            {{ $settings['weekday_open'] }} - {{ $settings['weekday_close'] }}
                        </div>
                        <div style="opacity: 0.7; font-size: 0.85rem; margin-top: 0.25rem; color: #b0b0b0;">WIB</div>
                    </div>
                </div>
            </div>

            <!-- Sabtu -->
            <div class="summary-card-item" style="background: rgba(255,255,255,0.05); backdrop-filter: blur(10px); padding: 1.25rem; border-radius: 12px; border: 1px solid rgba(255,215,0,0.2); box-shadow: 0 4px 12px rgba(0,0,0,0.2);">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <span style="font-size: 1.75rem;">📅</span>
                        <div>
                            <div style="font-weight: 600; font-size: 1.05rem; color: #ffffff;">Sabtu</div>
                            <div style="opacity: 0.7; font-size: 0.85rem; margin-top: 0.25rem; color: #b0b0b0;">Akhir Pekan</div>
                        </div>
                    </div>
                    <div style="text-align: right;">
                        <div style="font-size: 1.25rem; font-weight: 700; font-family: 'Courier New', monospace; color: #ffd700;">
                            {{ $settings['saturday_open'] }} - {{ $settings['saturday_close'] }}
                        </div>
                        <div style="opacity: 0.7; font-size: 0.85rem; margin-top: 0.25rem; color: #b0b0b0;">WIB</div>
                    </div>
                </div>
            </div>

            <!-- Minggu -->
            <div class="summary-card-item" style="background: rgba(255,255,255,0.05); backdrop-filter: blur(10px); padding: 1.25rem; border-radius: 12px; border: 1px solid rgba(255,215,0,0.2); box-shadow: 0 4px 12px rgba(0,0,0,0.2);">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <span style="font-size: 1.75rem;">📅</span>
                        <div>
                            <div style="font-weight: 600; font-size: 1.05rem; color: #ffffff;">Minggu</div>
                            <div style="opacity: 0.7; font-size: 0.85rem; margin-top: 0.25rem; color: #b0b0b0;">Hari Libur</div>
                        </div>
                    </div>
                    <div style="text-align: right;">
                        @if($settings['sunday_closed'] == '1')
                            <div style="display: inline-flex; align-items: center; gap: 0.5rem; background: rgba(239, 68, 68, 0.15); padding: 0.5rem 1rem; border-radius: 8px; border: 2px solid #ef4444;">
                                <span style="font-size: 1.25rem;">🔴</span>
                                <span style="font-size: 1.1rem; font-weight: 700; color: #fca5a5;">TUTUP</span>
                            </div>
                        @else
                            <div style="display: inline-flex; align-items: center; gap: 0.5rem; background: rgba(16, 185, 129, 0.15); padding: 0.5rem 1rem; border-radius: 8px; border: 2px solid #10b981;">
                                <span style="font-size: 1.25rem;">🟢</span>
                                <span style="font-size: 1.1rem; font-weight: 700; color: #6ee7b7;">BUKA</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Info Footer -->
        <div style="margin-top: 1.5rem; padding-top: 1.5rem; border-top: 2px solid rgba(255,215,0,0.2); display: flex; align-items: center; gap: 0.75rem;">
            <span style="font-size: 1.5rem; filter: drop-shadow(0 0 8px rgba(255,215,0,0.4));">💡</span>
            <p style="margin: 0; opacity: 0.8; font-size: 0.9rem; line-height: 1.6; color: #e0e0e0;">
                Jam operasional ini akan ditampilkan kepada customer di website. Perubahan akan langsung berlaku setelah disimpan.
            </p>
        </div>
    </div>
</div>
@endsection
