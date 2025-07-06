@extends('layouts.app')

@section('title', 'Pembayaran - Pineus Tilu')

@section('content')
    <div class="flex items-center justify-center py-8 min-h-screen-with-nav"
        style="background-image: url('/images/reservasi.JPG');">
        <div class="w-full max-w-2xl px-4 py-6 mx-auto my-16 bg-white rounded-lg shadow-md">
            <h2 class="mb-6 text-2xl font-bold text-green-900">Pembayaran</h2>

            @if (isset($booking))
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
                            <p class="text-gray-800">{{ $jumlah_orang ?? $booking->bookingDetail->number_of_people }} orang
                            </p>
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
                            <p class="text-gray-800">
                                {{ \Carbon\Carbon::parse($tanggal_kunjungan ?? $booking->booking_for_date)->addDay()->format('Y-m-d') }}
                            </p>
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
                <button id="cancel-button"
                    class="w-full px-6 py-2 font-semibold text-red-600 transition bg-white border-2 border-red-600 rounded sm:w-auto hover:bg-red-50 disabled:opacity-50">
                    Batalkan Pesanan
                </button>

                <button id="pay-button"
                    class="w-full py-2 font-semibold text-white transition bg-green-700 rounded sm:flex-1 hover:bg-green-800 disabled:opacity-50">
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

    <!-- 🔥 Modal Konfirmasi Pembatalan -->
    <div id="cancelModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-lg">
                <div class="text-center">
                    <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 bg-red-100 rounded-full">
                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z">
                            </path>
                        </svg>
                    </div>

                    <h3 class="mb-2 text-lg font-semibold text-gray-900">Konfirmasi Pembatalan</h3>
                    <p class="mb-6 text-gray-600">Apakah Anda yakin ingin membatalkan pesanan ini?</p>

                    <div class="flex gap-3">
                        <button id="cancelConfirmNo"
                            class="flex-1 px-4 py-2 font-semibold text-gray-700 transition bg-gray-100 rounded hover:bg-gray-200">
                            Tidak
                        </button>
                        <button id="cancelConfirmYes"
                            class="flex-1 px-4 py-2 font-semibold text-white transition bg-red-600 rounded hover:bg-red-700">
                            Ya, Batalkan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 🔥 Modal Success Pembatalan -->
    <div id="cancelSuccessModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-lg">
                <div class="text-center">
                    <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 bg-green-100 rounded-full">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>

                    <h3 class="mb-2 text-lg font-semibold text-gray-900">Pesanan Berhasil Dibatalkan</h3>
                    <p class="mb-6 text-gray-600">Pesanan Anda telah berhasil dibatalkan. Anda akan diarahkan ke halaman
                        reservasi.</p>

                    <button id="successOkBtn"
                        class="w-full px-4 py-2 font-semibold text-white transition bg-green-600 rounded hover:bg-green-700">
                        OK
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- 🔥 Modal Error Pembatalan -->
    <div id="cancelErrorModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-lg">
                <div class="text-center">
                    <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 bg-red-100 rounded-full">
                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                            </path>
                        </svg>
                    </div>

                    <h3 class="mb-2 text-lg font-semibold text-gray-900">Gagal Membatalkan Pesanan</h3>
                    <p id="errorMessage" class="mb-6 text-gray-600">Terjadi kesalahan saat membatalkan pesanan. Silakan coba
                        lagi.</p>

                    <button id="errorOkBtn"
                        class="w-full px-4 py-2 font-semibold text-white transition bg-red-600 rounded hover:bg-red-700">
                        OK
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- 🔥 Modal Success Pembayaran -->
    <div id="paymentSuccessModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-lg">
                <div class="text-center">
                    <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 bg-green-100 rounded-full">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>

                    <h3 class="mb-2 text-lg font-semibold text-gray-900">Pembayaran Berhasil!</h3>
                    <p class="mb-6 text-gray-600">Pembayaran telah berhasil. Invoice dan keterangan lainnya akan kami kirim lewat email yang terdaftar.</p>

                    <button id="paymentSuccessOkBtn"
                        class="w-full px-4 py-2 font-semibold text-white transition bg-green-600 rounded hover:bg-green-700">
                        OK
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- 🔥 Modal Error Pembayaran -->
    <div id="paymentErrorModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-lg">
                <div class="text-center">
                    <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 bg-red-100 rounded-full">
                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                            </path>
                        </svg>
                    </div>

                    <h3 class="mb-2 text-lg font-semibold text-gray-900">Pembayaran Gagal</h3>
                    <p class="mb-6 text-gray-600">Pembayaran gagal. Silahkan hubungi kontak admin untuk bantuan lebih lanjut.</p>

                    <button id="paymentErrorOkBtn"
                        class="w-full px-4 py-2 font-semibold text-white transition bg-red-600 rounded hover:bg-red-700">
                        OK
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- 🔥 Modal Pending Pembayaran -->
    <div id="paymentPendingModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-lg">
                <div class="text-center">
                    <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 bg-yellow-100 rounded-full">
                        <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>

                    <h3 class="mb-2 text-lg font-semibold text-gray-900">Pembayaran Sedang Diproses</h3>
                    <p class="mb-6 text-gray-600">Pembayaran sedang diproses. Silakan selesaikan pembayaran Anda.</p>

                    <button id="paymentPendingOkBtn"
                        class="w-full px-4 py-2 font-semibold text-white transition bg-yellow-600 rounded hover:bg-yellow-700">
                        OK
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Midtrans Snap.js -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
    </script>
    <script>
        // 🔥 Modal Functions
        function showModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
            document.body.style.overflow = 'hidden'; // Prevent scroll
        }

        function hideModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
            document.body.style.overflow = 'auto'; // Enable scroll
        }

        // 🔥 Handle Cancel Button - Show Confirmation Modal
        document.getElementById('cancel-button').onclick = function() {
            showModal('cancelModal');
        };

        // 🔥 Handle Cancel Confirmation - No
        document.getElementById('cancelConfirmNo').onclick = function() {
            hideModal('cancelModal');
        };

        // 🔥 Handle Cancel Confirmation - Yes
        document.getElementById('cancelConfirmYes').onclick = function() {
            const confirmBtn = this;
            const originalText = confirmBtn.textContent;

            // Show loading state
            confirmBtn.disabled = true;
            confirmBtn.textContent = 'Membatalkan...';

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
                    hideModal('cancelModal');

                    if (data.success) {
                        // Show success modal
                        showModal('cancelSuccessModal');
                    } else {
                        // Show error modal
                        document.getElementById('errorMessage').textContent = data.error ||
                            'Terjadi kesalahan saat membatalkan pesanan.';
                        showModal('cancelErrorModal');
                    }
                })
                .catch(error => {
                    hideModal('cancelModal');

                    // Show error modal
                    document.getElementById('errorMessage').textContent =
                        'Terjadi kesalahan jaringan. Silakan coba lagi.';
                    showModal('cancelErrorModal');
                })
                .finally(() => {
                    // Reset button state
                    confirmBtn.disabled = false;
                    confirmBtn.textContent = originalText;
                });
        };

        // 🔥 Handle Success Modal OK Button (Cancel)
        document.getElementById('successOkBtn').onclick = function() {
            hideModal('cancelSuccessModal');
            // Redirect to reservasi page
            window.location.href = "{{ route('reservasi') }}";
        };

        // 🔥 Handle Error Modal OK Button (Cancel)
        document.getElementById('errorOkBtn').onclick = function() {
            hideModal('cancelErrorModal');
        };

        // 🔥 Handle Payment Success Modal OK Button
        document.getElementById('paymentSuccessOkBtn').onclick = function() {
            hideModal('paymentSuccessModal');
            // Redirect to dashboard
            window.location.href = "{{ url('/') }}";
        };

        // 🔥 Handle Payment Error Modal OK Button
        document.getElementById('paymentErrorOkBtn').onclick = function() {
            hideModal('paymentErrorModal');
            // Redirect to tentang page
            window.location.href = "{{ url('/tentang') }}";
        };

        // 🔥 Handle Payment Pending Modal OK Button
        document.getElementById('paymentPendingOkBtn').onclick = function() {
            hideModal('paymentPendingModal');
            // Redirect to dashboard
            window.location.href = "{{ url('/') }}";
        };

        // 🔥 Close modal when clicking outside
        document.getElementById('cancelModal').onclick = function(e) {
            if (e.target === this) {
                hideModal('cancelModal');
            }
        };

        document.getElementById('cancelSuccessModal').onclick = function(e) {
            if (e.target === this) {
                hideModal('cancelSuccessModal');
                window.location.href = "{{ route('reservasi') }}";
            }
        };

        document.getElementById('cancelErrorModal').onclick = function(e) {
            if (e.target === this) {
                hideModal('cancelErrorModal');
            }
        };

        document.getElementById('paymentSuccessModal').onclick = function(e) {
            if (e.target === this) {
                hideModal('paymentSuccessModal');
                window.location.href = "{{ url('/') }}";
            }
        };

        document.getElementById('paymentErrorModal').onclick = function(e) {
            if (e.target === this) {
                hideModal('paymentErrorModal');
                window.location.href = "{{ url('/tentang') }}";
            }
        };

        document.getElementById('paymentPendingModal').onclick = function(e) {
            if (e.target === this) {
                hideModal('paymentPendingModal');
                window.location.href = "{{ url('/') }}";
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
                                    // Show payment success modal
                                    showModal('paymentSuccessModal');
                                });
                            },
                            onPending: function(result) {
                                // Show payment pending modal
                                showModal('paymentPendingModal');
                            },
                            onError: function(result) {
                                // Show payment error modal
                                showModal('paymentErrorModal');
                            },
                            onClose: function() {
                                // User closed the payment popup
                                button.disabled = false;
                                cancelBtn.disabled = false;
                                button.textContent = 'Bayar Sekarang';
                                loading.classList.add('hidden');
                            }
                        });
                    } else {
                        // Show payment error modal
                        showModal('paymentErrorModal');
                    }
                })
                .catch(error => {
                    // Show payment error modal
                    showModal('paymentErrorModal');
                })
                .finally(() => {
                    // Reset button state if not redirected
                    button.disabled = false;
                    cancelBtn.disabled = false;
                    button.textContent = 'Bayar Sekarang';
                    loading.classList.add('hidden');
                });
        };
    </script>
@endsection
