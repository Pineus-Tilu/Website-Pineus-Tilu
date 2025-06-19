@extends('layouts.app')

@section('title', 'Pembayaran')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-green-600">
    <div class="bg-white rounded-lg shadow-md p-8 max-w-lg w-full">
        <h2 class="text-2xl font-bold mb-4 text-green-900">Pembayaran</h2>
        <button id="pay-button" class="w-full bg-green-600 text-white py-2 rounded font-semibold hover:bg-green-700 transition">
            Bayar Sekarang
        </button>
    </div>
</div>

<!-- Midtrans Snap.js -->
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script>
document.getElementById('pay-button').onclick = function() {
    fetch("{{ route('pembayaran.process') }}", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            nama: "{{ $nama }}",
            email: "{{ $email }}",
            subtotal: "{{ $subtotal }}"
        })
    })
    .then(response => response.json())
    .then(data => {
        window.snap.pay(data.snapToken);
    });
};
</script>
@endsection