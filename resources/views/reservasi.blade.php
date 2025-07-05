@extends('layouts.app')

@section('title', 'Reservasi - Pineus Tilu')

@section('content')
    <div class="flex items-center justify-center py-8 min-h-screen-with-nav"
    style="background-image: url('/images/reservasi.JPG');" data-aos="fade-in" data-aos-duration="1500">
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
                                    required></select>
                            </div>

                            <!-- Tanggal Kunjungan -->
                            <div class="mb-4 font-typewriter">
                                <label class="block mb-2 font-medium text-green-800">Tanggal Kunjungan</label>
                                <input name="tanggal_kunjungan" type="text" id="tanggal-kunjungan"
                                    class="w-full px-3 py-2 border border-green-300 rounded focus:outline-none focus:ring focus:border-green-500"
                                    required autocomplete="off">
                            </div>

                            <!-- Jumlah Orang -->
                            <div class="mb-4 font-typewriter">
                                <label class="block mb-2 font-medium text-green-800">Jumlah Orang</label>
                                <div class="flex items-center space-x-2">
                                    <button type="button" id="minus-btn" class="px-3 py-1 bg-gray-200 rounded">&minus;</button>
                                    <input type="number" id="jumlah-orang" name="jumlah_orang" value="1" min="1"
                                        max="10" readonly
                                        class="w-16 px-2 py-1 text-center bg-gray-100 border border-green-300 rounded cursor-default focus:outline-none">
                                    <button type="button" id="plus-btn" class="px-3 py-1 bg-gray-200 rounded">+</button>
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
                                    <div class="text-sm text-green-700">Tanggal Check-in</div>
                                    <div class="font-medium" id="detail-checkin">-</div>
                                </div>
                                <div>
                                    <div class="text-sm text-green-700">Tanggal Check-out</div>
                                    <div class="font-medium" id="detail-checkout">-</div>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <div class="text-sm text-green-700">Area</div>
                                    <div class="font-medium" id="detail-area">-</div>
                                </div>
                                <div>
                                    <div class="text-sm text-green-700">Deck</div>
                                    <div class="font-medium" id="detail-deck">-</div>
                                </div>
                            </div>
                            <div>
                                <div class="text-sm text-green-700">Jumlah Orang</div>
                                <div class="font-medium" id="detail-jumlah">-</div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-6 font-typewriter">
                        <h3 class="mb-4 font-semibold text-green-800">Data Pengunjung</h3>
                        <div class="space-y-3">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <div class="text-sm text-green-700">Nama Lengkap</div>
                                    <div class="font-medium" id="detail-nama">-</div>
                                </div>
                                <div>
                                    <div class="text-sm text-green-700">Nomor Telepon</div>
                                    <div class="font-medium" id="detail-telepon">-</div>
                                </div>
                            </div>
                            <div>
                                <div class="text-sm text-green-700">Email</div>
                                <div class="font-medium" id="detail-email">-</div>
                            </div>
                        </div>
                    </div>

                    <div class="pt-4 border-t font-typewriter">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm text-green-700">Harga Dasar</span>
                            <span class="text-sm" id="harga-dasar">Rp 0</span>
                        </div>
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-sm text-green-700">Tambahan</span>
                            <span class="text-sm" id="tambahan-harga">Rp 0</span>
                        </div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-lg font-bold text-green-900">Total Harga</span>
                            <span class="text-lg font-bold text-green-900" id="total-harga">Rp 0</span>
                        </div>
                        
                        <div class="flex items-center mb-4 font-typewriter">
                            <input type="checkbox" id="syarat" name="syarat" class="mr-2 accent-green-600" required form="reservasi-form">
                            <label for="syarat" class="text-sm text-green-800">Saya menyetujui syarat & ketentuan yang
                                berlaku</label>
                        </div>
                        <button type="submit" form="reservasi-form"
                            class="w-full py-3 font-semibold text-white transition bg-green-600 rounded hover:bg-green-700 font-typewriter">Pesan
                            Sekarang</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.areaUnits = @json($areaUnits);
        window.prices = @json($prices);
        window.bookedDates = @json($bookedDates);
    </script>
@endsection