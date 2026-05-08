<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alamat Saya - Dapoer Budess</title>
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
                <h1>Alamat Saya</h1>
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
                    <a href="{{ route('customer.addresses') }}" class="menu-item active">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>Alamat Saya</span>
                    </a>
                    <a href="{{ route('customer.orders') }}" class="menu-item">
                        <i class="fas fa-shopping-bag"></i>
                        <span>Pesanan Saya</span>
                    </a>
                </nav>
            </div>

            <!-- Main Content -->
            <div class="customer-main">
                <div class="content-card">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem;">
                        <h3 style="margin: 0;">Daftar Alamat</h3>
                        <button onclick="openAddressModal()" class="btn btn-primary">
                            <i class="fas fa-plus"></i>
                            <span>Tambah Alamat</span>
                        </button>
                    </div>

                    @if($addresses->count() > 0)
                        <div class="address-grid">
                            @foreach($addresses as $address)
                            <div class="address-card {{ $address->is_primary ? 'primary' : '' }}">
                                @if($address->is_primary)
                                <span class="primary-badge">Utama</span>
                                @endif

                                <div class="address-label">
                                    @if($address->label === 'home')
                                        <i class="fas fa-home"></i> Rumah
                                    @elseif($address->label === 'office')
                                        <i class="fas fa-building"></i> Kantor
                                    @elseif($address->label === 'apartment')
                                        <i class="fas fa-city"></i> Apartemen
                                    @elseif($address->label === 'kos')
                                        <i class="fas fa-bed"></i> Kos
                                    @else
                                        <i class="fas fa-map-marker-alt"></i> {{ ucfirst($address->label) }}
                                    @endif
                                </div>

                                <div class="address-name">{{ $address->recipient_name }}</div>
                                <div class="address-phone">{{ $address->phone }}</div>
                                
                                <div class="address-text">
                                    {{ $address->address }}
                                    @if($address->house_number), No. {{ $address->house_number }}@endif
                                    @if($address->rt_rw), RT/RW {{ $address->rt_rw }}@endif
                                    @if($address->address_detail)<br>{{ $address->address_detail }}@endif
                                    <br>{{ $address->district }}, {{ $address->city }}
                                    <br>{{ $address->province }} {{ $address->postal_code }}
                                </div>

                                <div class="address-actions">
                                    @if(!$address->is_primary)
                                    <form method="POST" action="{{ route('customer.addresses.primary', $address->id) }}" style="flex: 1;">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-secondary" style="width: 100%;">
                                            <i class="fas fa-star"></i> Jadikan Utama
                                        </button>
                                    </form>
                                    @endif
                                    <button onclick="editAddress({{ json_encode($address) }})" class="btn btn-sm btn-edit">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <form method="POST" action="{{ route('customer.addresses.destroy', $address->id) }}" 
                                          onsubmit="return confirm('Yakin hapus alamat ini?')" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-delete">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-state">
                            <i class="fas fa-map-marker-alt"></i>
                            <p>Belum ada alamat tersimpan</p>
                            <button onclick="openAddressModal()" class="btn btn-primary">
                                <i class="fas fa-plus"></i>
                                <span>Tambah Alamat Pertama</span>
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah/Edit Alamat -->
    <div id="addressModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 9999; overflow-y: auto;">
        <div style="min-height: 100%; display: flex; align-items: center; justify-content: center; padding: 1rem;">
            <div style="background: white; border-radius: 16px; max-width: 600px; width: 100%; margin: auto; max-height: 90vh; overflow-y: auto;">
                <div style="padding: 1.5rem; border-bottom: 2px solid #f0f0f0; display: flex; justify-content: space-between; align-items: center;">
                    <h3 style="margin: 0; font-size: 1.35rem;" id="modalTitle">Tambah Alamat</h3>
                    <button onclick="closeAddressModal()" style="background: none; border: none; font-size: 1.5rem; cursor: pointer; color: #666;">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                
                <form id="addressForm" method="POST" style="padding: 1.5rem;">
                    @csrf
                    <input type="hidden" name="_method" id="formMethod" value="POST">
                    
                    <div class="form-group">
                        <label class="form-label">Label Alamat</label>
                        <select name="label" class="form-input" required>
                            <option value="home">🏠 Rumah</option>
                            <option value="office">🏢 Kantor</option>
                            <option value="apartment">🏘️ Apartemen</option>
                            <option value="kos">🏠 Kos</option>
                            <option value="other">📍 Lainnya</option>
                        </select>
                    </div>

                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Nama Penerima</label>
                            <input type="text" name="recipient_name" class="form-input" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Nomor Telepon</label>
                            <input type="tel" name="phone" class="form-input" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Nama Jalan</label>
                        <input type="text" name="address" class="form-input" required>
                    </div>

                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">No. Rumah</label>
                            <input type="text" name="house_number" class="form-input">
                        </div>

                        <div class="form-group">
                            <label class="form-label">RT/RW</label>
                            <input type="text" name="rt_rw" class="form-input" placeholder="01/17">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Detail Alamat (Opsional)</label>
                        <textarea name="address_detail" class="form-textarea" rows="2" placeholder="Patokan, warna rumah, dll"></textarea>
                    </div>

                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Kecamatan</label>
                            <input type="text" name="district" class="form-input">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Kota</label>
                            <input type="text" name="city" class="form-input" required>
                        </div>
                    </div>

                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Provinsi</label>
                            <input type="text" name="province" class="form-input" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Kode Pos</label>
                            <input type="text" name="postal_code" class="form-input">
                        </div>
                    </div>

                    <div class="form-group">
                        <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                            <input type="checkbox" name="is_primary" value="1">
                            <span class="form-label" style="margin: 0;">Jadikan alamat utama</span>
                        </label>
                    </div>

                    <div style="display: flex; gap: 0.75rem; margin-top: 1.5rem;">
                        <button type="button" onclick="closeAddressModal()" class="btn btn-secondary" style="flex: 1;">
                            Batal
                        </button>
                        <button type="submit" class="btn btn-primary" style="flex: 1;">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openAddressModal() {
            document.getElementById('addressModal').style.display = 'block';
            document.getElementById('modalTitle').textContent = 'Tambah Alamat';
            document.getElementById('addressForm').action = '{{ route("customer.addresses.store") }}';
            document.getElementById('formMethod').value = 'POST';
            document.getElementById('addressForm').reset();
            document.getElementById('addressForm').elements['is_primary'].disabled = false;
        }

        function closeAddressModal() {
            document.getElementById('addressModal').style.display = 'none';
        }

        function editAddress(address) {
            document.getElementById('addressModal').style.display = 'block';
            document.getElementById('modalTitle').textContent = 'Edit Alamat';
            
            const form = document.getElementById('addressForm');
            form.action = `/customer/addresses/${address.id}`;
            document.getElementById('formMethod').value = 'PUT';
            
            // Fill form fields
            form.elements['label'].value = address.label;
            form.elements['recipient_name'].value = address.recipient_name;
            form.elements['phone'].value = address.phone;
            form.elements['address'].value = address.address;
            form.elements['house_number'].value = address.house_number || '';
            form.elements['rt_rw'].value = address.rt_rw || '';
            form.elements['address_detail'].value = address.address_detail || '';
            form.elements['district'].value = address.district || '';
            form.elements['city'].value = address.city;
            form.elements['province'].value = address.province;
            form.elements['postal_code'].value = address.postal_code || '';
            
            // Handle checkbox
            form.elements['is_primary'].checked = address.is_primary == 1;
            
            // If it's already primary, maybe disable the checkbox or just keep it checked
            if (address.is_primary == 1) {
                form.elements['is_primary'].disabled = true;
            } else {
                form.elements['is_primary'].disabled = false;
            }
        }

        // Close modal when clicking outside
        document.getElementById('addressModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeAddressModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeAddressModal();
            }
        });
    </script>
</body>
</html>
