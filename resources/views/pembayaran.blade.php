@extends('layouts.app')

@section('title', 'Pembayaran - Pineus Tilu')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-green-700">
    <div class="bg-white rounded-lg shadow-md p-8 max-w-lg w-full">
        <h2 class="text-2xl font-bold mb-4 text-green-900">Pembayaran</h2>
        
        @if(isset($booking))
        <div class="mb-6 p-4 bg-gray-50 rounded-lg">
            <h3 class="font-semibold text-gray-800 mb-2">Detail Pemesanan:</h3>
            <p class="text-sm text-gray-600">{{ $booking->unit->area->name }} - {{ $booking->unit->unit_name }}</p>
            <p class="text-sm text-gray-600">{{ $booking->booking_for_date }}</p>
            <p class="text-lg font-bold text-green-700">Total: Rp {{ number_format($subtotal, 0, ',', '.') }}</p>
        </div>
        @endif

        <button id="pay-button" class="w-full bg-green-700 text-white py-2 rounded font-semibold hover:bg-green-800 transition disabled:opacity-50">
            Bayar Sekarang
        </button>
        
        <div id="loading" class="hidden text-center mt-4">
            <p class="text-gray-600">Memproses pembayaran...</p>
        </div>
    </div>
</div>

<!-- Midtrans Snap.js -->
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script>
document.getElementById('pay-button').onclick = function() {
    const button = this;
    const loading = document.getElementById('loading');
    
    button.disabled = true;
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
                    console.log('Payment success:', result);
                    
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
                        window.location.href = '/';
                    });
                },
                onPending: function(result) {
                    console.log('Payment pending:', result);
                    alert('Pembayaran pending, silakan selesaikan pembayaran.');
                    window.location.href = '/';
                },
                onError: function(result) {
                    console.log('Payment error:', result);
                    alert('Pembayaran gagal!');
                    button.disabled = false;
                    button.textContent = 'Bayar Sekarang';
                    loading.classList.add('hidden');
                },
                onClose: function() {
                    console.log('Payment popup closed');
                    button.disabled = false;
                    button.textContent = 'Bayar Sekarang';
                    loading.classList.add('hidden');
                }
            });
        } else {
            alert('Gagal memproses pembayaran: ' + (data.error || 'Unknown error'));
            button.disabled = false;
            button.textContent = 'Bayar Sekarang';
            loading.classList.add('hidden');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan jaringan');
        button.disabled = false;
        button.textContent = 'Bayar Sekarang';
        loading.classList.add('hidden');
    });
};
</script>
@endsection