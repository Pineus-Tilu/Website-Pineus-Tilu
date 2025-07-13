@extends('layouts.app')

@section('title', 'Reservasi - Pineus Tilu')

@section('content')
    <style>
        /* Styling untuk tanggal disabled di flatpickr */
        .flatpickr-day.flatpickr-disabled.disabled-date {
            background-color: #fee2e2 !important;
            color: #991b1b !important;
            cursor: not-allowed !important;
            opacity: 0.6 !important;
            pointer-events: none !important;
        }

        .flatpickr-day.flatpickr-disabled.disabled-date:hover,
        .flatpickr-day.flatpickr-disabled.disabled-date:focus,
        .flatpickr-day.flatpickr-disabled.disabled-date:active {
            background-color: #fee2e2 !important;
            color: #991b1b !important;
            cursor: not-allowed !important;
            pointer-events: none !important;
        }

        .flatpickr-day.flatpickr-disabled.cutoff-date {
            background-color: #fef3c7 !important;
            color: #92400e !important;
            cursor: not-allowed !important;
            opacity: 0.7 !important;
            pointer-events: none !important;
        }

        .flatpickr-day.flatpickr-disabled.cutoff-date:hover,
        .flatpickr-day.flatpickr-disabled.cutoff-date:focus,
        .flatpickr-day.flatpickr-disabled.cutoff-date:active {
            background-color: #fef3c7 !important;
            color: #92400e !important;
            cursor: not-allowed !important;
            pointer-events: none !important;
        }

        .flatpickr-day.flatpickr-disabled {
            pointer-events: none !important;
        }

        /* Styling untuk tanggal yang sudah dibooking */
        .flatpickr-day.booked-date {
            background-color: #fca5a5 !important;
            color: #7f1d1d !important;
            border-color: #ef4444 !important;
            cursor: not-allowed !important;
        }

        .flatpickr-day.booked-date:hover,
        .flatpickr-day.booked-date:focus {
            background-color: #f87171 !important;
            color: #7f1d1d !important;
        }
    </style>
    <div class="flex items-center justify-center py-8 min-h-screen-with-nav bg-gradient-to-br from-[#006C43] via-[#00844D] to-[#005A36]"
        data-aos="fade-in" data-aos-duration="1500">
        <div class="w-full max-w-6xl px-4 py-6 mx-auto my-10 bg-white rounded-lg shadow-md">
            <nav class="flex items-center mb-4 space-x-2 text-sm text-green-700">
                <span class="font-semibold text-green-900">Reservasi</span>
                <span>&gt;</span>
                <span>Pembayaran</span>
            </nav>

            @if ($errors->any())
                <div class="mb-4 text-red-600">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                <!-- Form Reservasi (Kiri) -->
                <div>
                    <form action="{{ route('reservasi.store') }}" method="POST" id="reservasi-form">
                        @csrf
                        <div class="mb-6">
                            <h2 class="mb-4 text-lg font-bold text-green-900 jp-brush">Informasi Reservasi</h2>
                            <div class="mb-4 font-typewriter">
                                <label class="block mb-2 font-medium text-green-800">Pilih Area</label>
                                <select name="fasilitas" id="fasilitas-select"
                                    class="w-full px-3 py-2 border border-green-300 rounded focus:outline-none focus:ring focus:border-green-500"
                                    required>
                                    <option value="" disabled selected>Pilih Area</option>
                                    @foreach ($areas as $area)
                                        <option value="{{ $area->name }}">{{ $area->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Deck / Plot -->
                            <div id="deck-container" class="hidden mb-4 font-typewriter">
                                <label class="block mb-2 font-medium text-green-800">Pilih Deck</label>
                                <select id="deck-select" name="deck"
                                    class="w-full px-3 py-2 border border-green-300 rounded focus:outline-none focus:ring focus:border-green-500"
                                    required>
                                    <option value="" disabled selected>Pilih Deck</option>
                                </select>
                            </div>

                            <!-- Tanggal Kunjungan -->
                            <div class="mb-4 font-typewriter">
                                <label class="block mb-2 font-medium text-green-800">Tanggal Kunjungan</label>
                                <input name="tanggal_kunjungan" type="text" id="tanggal-kunjungan"
                                    class="w-full px-3 py-2 bg-gray-100 border border-green-300 rounded cursor-not-allowed focus:outline-none focus:ring focus:border-green-500"
                                    placeholder="Pilih area dan deck terlebih dahulu" required autocomplete="off" disabled>
                            </div>

                            <!-- Jumlah Orang -->
                            <div class="mb-4 font-typewriter">
                                <div class="flex items-center justify-between mb-2">
                                    <label class="font-medium text-green-800">Jumlah Orang</label>
                                    <button type="button" id="info-btn" class="text-sm text-green-700 hover:underline">❔ Info</button>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <button type="button" id="minus-btn"
                                        class="px-3 py-1 bg-gray-200 rounded">&minus;</button>
                                    <input type="number" id="jumlah-orang" name="jumlah_orang" value="1"
                                        min="1" max="10" readonly
                                        class="w-16 px-2 py-1 text-center bg-gray-100 border border-green-300 rounded cursor-default focus:outline-none">
                                    <button type="button" id="plus-btn" class="px-3 py-1 bg-gray-200 rounded">+</button>
                                </div>
                            </div>

                            <!-- Modal Informasi Jumlah Orang -->
                            <div id="info-modal"
                                class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
                                <div class="w-full max-w-sm p-6 bg-white rounded-lg shadow-lg">
                                    <h2 class="mb-2 text-lg font-semibold text-green-800">Informasi Jumlah Orang</h2>
                                    <p class="text-sm text-green-700">
                                        Jika Anda menambah jumlah orang lebih dari batas normal area yang dipilih,
                                        akan dikenakan biaya tambahan (extra charge) per orang sesuai ketentuan area.
                                    </p>
                                    <div class="flex justify-end mt-4">
                                        <button id="close-info-btn"
                                            class="px-4 py-2 text-sm font-medium text-white bg-green-600 rounded hover:bg-green-700">Tutup</button>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="total_harga" id="total-harga-input" value="0">
                            <input type="hidden" name="status" value="pending">
                        </div>

                        <!-- Informasi Pengunjung -->
                        <div class="mb-4 font-typewriter">
                            <h2 class="mb-4 text-lg font-bold text-green-900">Informasi Pengunjung</h2>
                            <div class="mb-4">
                                <label class="block mb-2 font-medium text-green-800">Nama Lengkap</label>
                                <input name="nama" type="text" id="nama-input"
                                    class="w-full px-3 py-2 bg-gray-100 border border-green-300 rounded focus:outline-none"
                                    value="{{ Auth::check() ? Auth::user()->name : '' }}"
                                    @if (Auth::check()) readonly @endif required>
                            </div>
                            <div class="mb-4">
                                <label class="block mb-2 font-medium text-green-800">Nomor Telepon</label>
                                <input name="telepon" type="text" id="telepon-input"
                                    class="w-full px-3 py-2 border border-green-300 rounded focus:outline-none"
                                    value="{{ Auth::check() ? Auth::user()->phone ?? '' : '' }}" required>
                            </div>
                            <div class="mb-4">
                                <label class="block mb-2 font-medium text-green-800">Email</label>
                                <input name="email" type="email" id="email-input"
                                    class="w-full px-3 py-2 bg-gray-100 border border-green-300 rounded focus:outline-none"
                                    value="{{ Auth::check() ? Auth::user()->email : '' }}"
                                    @if (Auth::check()) readonly @endif required>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Detail Reservasi (Kanan) -->
                <div class="p-6 rounded-lg bg-gray-50">
                    <h2 class="mb-6 text-xl font-bold text-green-900 jp-brush">Detail Reservasi</h2>

                    <div class="mb-6 font-typewriter">
                        <h3 class="mb-4 font-semibold text-green-800">Data Reservasi</h3>
                        <div class="space-y-3">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <div class="text-sm text-green-700">🕓 Tanggal Check-in</div>
                                    <div class="font-medium" id="detail-checkin">-</div>
                                </div>
                                <div>
                                    <div class="text-sm text-green-700">🕘 Tanggal Check-out</div>
                                    <div class="font-medium" id="detail-checkout">-</div>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <div class="text-sm text-green-700">📍 Area</div>
                                    <div class="font-medium" id="detail-area">-</div>
                                </div>
                                <div>
                                    <div class="text-sm text-green-700">🛏️ Deck</div>
                                    <div class="font-medium" id="detail-deck">-</div>
                                </div>
                            </div>
                            <div>
                                <div class="text-sm text-green-700">👥 Jumlah Orang</div>
                                <div class="font-medium" id="detail-jumlah">-</div>
                            </div>
                            <div>
                                <div class="text-sm text-green-700">⚖️ Batas Normal / Maksimal</div>
                                <div class="font-medium" id="detail-batas-orang">-</div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-6 font-typewriter">
                        <h3 class="mb-4 font-semibold text-green-800">Data Pengunjung</h3>
                        <div class="space-y-3">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <div class="text-sm text-green-700">🙍 Nama Lengkap</div>
                                    <div class="font-medium" id="detail-nama">-</div>
                                </div>
                                <div>
                                    <div class="text-sm text-green-700">📞 Nomor Telepon</div>
                                    <div class="font-medium" id="detail-telepon">-</div>
                                </div>
                            </div>
                            <div>
                                <div class="text-sm text-green-700">✉️ Email</div>
                                <div class="font-medium" id="detail-email">-</div>
                            </div>
                        </div>
                    </div>

                    <div class="pt-4 border-t font-typewriter">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm text-green-700">💰 Harga Dasar</span>
                            <span class="text-sm" id="harga-dasar">Rp 0</span>
                        </div>
                        <div class="flex flex-col justify-between mb-3">
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-green-700">➕ Tambahan <span class="text-xs text-gray-500">(extra charge)</span></span>
                                <span class="text-sm" id="tambahan-harga">Rp 0</span>
                            </div>
                            <span class="mt-1 text-xs text-gray-500">⚠️ Dikenakan jika jumlah orang melebihi batas normal area.</span>
                        </div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-lg font-bold text-green-900">🧾 Total Harga</span>
                            <span class="text-lg font-bold text-green-900" id="total-harga">Rp 0</span>
                        </div>

                        <div class="flex items-center mb-4 font-typewriter">
                            <input type="checkbox" id="syarat" name="syarat" class="mr-2 accent-green-600" required form="reservasi-form">
                            <label for="syarat" class="text-sm text-green-800">✔️ Saya menyetujui syarat & ketentuan yang berlaku</label>
                        </div>
                        <button type="submit" form="reservasi-form"
                            class="w-full py-3 font-semibold text-white transition bg-gradient-to-r from-[#006C43] via-[#00844D] to-[#005A36] rounded hover:opacity-90 transform hover:scale-105 font-typewriter">
                            🛎️ Pesan Sekarang
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Prevent double form submission
        let isSubmitting = false;

        document.getElementById('reservasi-form').addEventListener('submit', function(e) {
            if (isSubmitting) {
                e.preventDefault();
                console.log("⚠️ Form sudah di-submit, mencegah double submission");
                return false;
            }

            isSubmitting = true;
            console.log("✅ Form submission allowed");

            setTimeout(() => {
                isSubmitting = false;
            }, 30000);
        });

        // Modal jumlah orang info
        const infoBtn = document.getElementById('info-btn');
        const infoModal = document.getElementById('info-modal');
        const closeInfoBtn = document.getElementById('close-info-btn');

        infoBtn.addEventListener('click', () => {
            infoModal.classList.remove('hidden');
        });

        closeInfoBtn.addEventListener('click', () => {
            infoModal.classList.add('hidden');
        });

        infoModal.addEventListener('click', (e) => {
            if (e.target === infoModal) {
                infoModal.classList.add('hidden');
            }
        });
    </script>

    <script>
        window.areaUnits = @json($areaUnits);
        window.prices = @json($prices);
        window.bookedDates = @json($bookedDates);

        const fasilitasSelect = document.getElementById('fasilitas-select');
        const deckSelect = document.getElementById('deck-select');
        const detailBatasOrang = document.getElementById('detail-batas-orang');

        function updateDetailBatasOrang() {
            const selectedArea = fasilitasSelect.value;
            const selectedDeck = deckSelect.value;

            if (!selectedArea || !selectedDeck || !window.areaUnits[selectedArea]) {
                detailBatasOrang.textContent = '-';
                return;
            }

            const units = window.areaUnits[selectedArea];
            const unit = units.find(u => u.unit_name === selectedDeck);

            if (unit) {
                detailBatasOrang.textContent = `${unit.default_people} / ${unit.max_people} orang`;
            } else {
                detailBatasOrang.textContent = '-';
            }
        }

        fasilitasSelect.addEventListener('change', updateDetailBatasOrang);
        deckSelect.addEventListener('change', updateDetailBatasOrang);
    </script>
@endsection
