@extends('layouts.app')

@section('title', 'Pembayaran - Pineus Tilu')

@section('content')
<div class="flex items-center justify-center bg-green-700 min-h-screen-with-nav">
    <div class="w-full max-w-2xl p-8 bg-white rounded-lg shadow-md">
        <h2 class="mb-6 text-2xl font-bold text-green-900">Pembayaran</h2>
        
        @if(isset($booking))
        <!-- Detail Pemesanan -->
        <div class="p-6 mb-6 rounded-lg bg-gray-50">
            <h3 class="mb-4 text-lg font-semibold text-gray-800">Detail Pemesanan</h3>
            
            <div class="grid grid-cols-1 gap-4 text-sm md:grid-cols-2">
                <div>
                    <span class="font-medium text-gray-600">Nama:</span>
                    <p class="text-gray-800">{{ $nama }}</p>
                </div>
                
                <div>
                    <span class="font-medium text-gray-600">No. Telepon:</span>
                    <p class="text-gray-800">{{ $telepon ?? $booking->bookingDetail->telepon }}</p>
                </div>
                
                <div>
                    <span class="font-medium text-gray-600">Email:</span>
                    <p class="text-gray-800">{{ $email }}</p>
                </div>
                
                <div>
                    <span class="font-medium text-gray-600">Jumlah Orang:</span>
                    <p class="text-gray-800">{{ $jumlah_orang ?? $booking->bookingDetail->number_of_people }} orang</p>
                </div>
                
                <div>
                    <span class="font-medium text-gray-600">Area:</span>
                    <p class="text-gray-800">{{ $fasilitas ?? $booking->unit->area->name }}</p>
                </div>
                
                <div>
                    <span class="font-medium text-gray-600">Deck:</span>
                    <p class="text-gray-800">{{ $deck ?? $booking->unit->unit_name }}</p>
                </div>
                
                <div>
                    <span class="font-medium text-gray-600">Check-in:</span>
                    <p class="text-gray-800">{{ $tanggal_kunjungan ?? $booking->booking_for_date }}</p>
                </div>
                
                <div>
                    <span class="font-medium text-gray-600">Check-out:</span>
                    <p class="text-gray-800">{{ \Carbon\Carbon::parse($tanggal_kunjungan ?? $booking->booking_for_date)->addDay()->format('Y-m-d') }}</p>
                </div>
            </div>
            
            <hr class="my-4">
            
            <!-- Detail Harga -->
            <div class="space-y-2">
                <div class="flex justify-between">
                    <span class="font-medium text-gray-600">Subtotal:</span>
                    <span class="text-gray-800">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                </div>
                
                <div class="flex justify-between pt-2 text-lg font-bold text-green-700 border-t">
                    <span>Total Pembayaran:</span>
                    <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>
        @endif

        <!-- Buttons -->
        <div class="flex flex-col gap-3 sm:flex-row">
            <button id="cancel-button" class="w-full px-6 py-2 font-semibold text-red-600 transition bg-white border-2 border-red-600 rounded sm:w-auto hover:bg-red-50 disabled:opacity-50">
                Batalkan Pesanan
            </button>
            
            <button id="pay-button" class="w-full py-2 font-semibold text-white transition bg-green-700 rounded sm:flex-1 hover:bg-green-800 disabled:opacity-50">
                Bayar Sekarang
            </button>
        </div>
        
        <div id="loading" class="hidden mt-4 text-center">
            <p class="text-gray-600">Memproses pembayaran...</p>
        </div>
        
        <!-- Info Pembayaran -->
        <div class="p-4 mt-6 rounded-lg bg-blue-50">
            <h4 class="mb-2 font-semibold text-blue-800">ℹ️ Informasi Pembayaran:</h4>
            <ul class="space-y-1 text-sm text-blue-700">
                <li>• Pembayaran akan otomatis expired dalam 30 menit</li>
                <li>• Setelah pembayaran berhasil, booking akan dikonfirmasi</li>
                <li>• Jika ada kendala, hubungi customer service</li>
            </ul>
        </div>
    </div>
</div>

<!-- Midtrans Snap.js -->
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script>
// Handle Cancel Button
document.getElementById('cancel-button').onclick = function() {
    if (confirm('Apakah Anda yakin ingin membatalkan pesanan ini?')) {
        const cancelBtn = this;
        cancelBtn.disabled = true;
        cancelBtn.textContent = 'Membatalkan...';
        
        fetch("{{ route('pembayaran.cancel') }}", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                booking_id: "{{ $booking->id ?? '' }}"
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Pesanan berhasil dibatalkan');
                window.location.href = "{{ route('reservasi') }}";
            } else {
                alert('Gagal membatalkan pesanan: ' + (data.error || 'Unknown error'));
                cancelBtn.disabled = false;
                cancelBtn.textContent = 'Batalkan Pesanan';
            }
        })
        .catch(error => {
            alert('Terjadi kesalahan jaringan');
            cancelBtn.disabled = false;
            cancelBtn.textContent = 'Batalkan Pesanan';
        });
    }
};

// Handle Pay Button
document.getElementById('pay-button').onclick = function() {
    const button = this;
    const cancelBtn = document.getElementById('cancel-button');
    const loading = document.getElementById('loading');
    
    button.disabled = true;
    cancelBtn.disabled = true;
    button.textContent = 'Memproses...';
    loading.classList.remove('hidden');
    
    fetch("{{ route('pembayaran.process') }}", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            booking_id: "{{ $booking->id ?? '' }}",
            nama: "{{ $nama }}",
            email: "{{ $email }}",
            subtotal: "{{ $subtotal }}"
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.snapToken) {
            window.snap.pay(data.snapToken, {
                onSuccess: function(result) {
                    // Update booking status via AJAX
                    fetch('/pembayaran/finish?' + new URLSearchParams({
                        order_id: result.order_id,
                        status_code: result.status_code,
                        transaction_status: result.transaction_status
                    }), {
                        method: 'GET',
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        }
                    }).then(() => {
                        alert('Pembayaran berhasil! Status booking telah diperbarui.');
                        window.location.href = "{{ url('/') }}";
                    });
                },
                onPending: function(result) {
                    alert('Pembayaran sedang diproses. Silakan selesaikan pembayaran Anda.');
                    window.location.href = "{{ url('/') }}";
                },
                onError: function(result) {
                    alert('Pembayaran gagal!');
                    button.disabled = false;
                    cancelBtn.disabled = false;
                    button.textContent = 'Bayar Sekarang';
                    loading.classList.add('hidden');
                },
                onClose: function() {
                    // User menutup popup pembayaran (bisa dianggap sebagai cancel)
                    button.disabled = false;
                    cancelBtn.disabled = false;
                    button.textContent = 'Bayar Sekarang';
                    loading.classList.add('hidden');
                }
            });
        } else {
            alert('Gagal memproses pembayaran: ' + (data.error || 'Unknown error'));
            button.disabled = false;
            cancelBtn.disabled = false;
            button.textContent = 'Bayar Sekarang';
            loading.classList.add('hidden');
        }
    })
    .catch(error => {
        alert('Terjadi kesalahan jaringan');
        button.disabled = false;
        cancelBtn.disabled = false;
        button.textContent = 'Bayar Sekarang';
        loading.classList.add('hidden');
    });
};
</script>
@endsection