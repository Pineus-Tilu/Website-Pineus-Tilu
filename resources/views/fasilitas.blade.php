@extends('layouts.app')

@section('content')
<div class="max-w-full overflow-hidden">
    <!-- Hero Section -->
    <section class="relative h-[50vh] pt-[120px] flex items-center justify-center" data-aos="fade-down">
        <img src="{{ asset('images/' . $data['hero']) }}" alt="{{ $data['title'] }}"
            class="absolute top-0 left-0 z-0 object-cover w-full h-full">
        <div class="relative z-10 flex flex-col items-center justify-center w-full h-full">
            <h1 class="text-5xl font-bold text-center text-white md:text-6xl lg:text-7xl jp-brush drop-shadow-lg">
                {{ strtoupper($data['title']) }}
            </h1>
        </div>
    </section>

    <!-- Denah Section -->
    <section class="py-10 text-center bg-white" x-data="{ showDenah: false }">
        <h2 class="mb-2 text-4xl font-bold text-green-700 jp-brush" data-aos="fade-right">Denah</h2>
        <p class="mb-6 text-gray-600 font-typewriter" data-aos="fade-left">
            Denah area {{ $data['title'] }} untuk memudahkan pengunjung memahami lokasi fasilitas.
        </p>
        <div class="relative flex items-center justify-center">
            <img src="{{ asset('images/' . $data['denah']) }}"
                class="w-full max-w-2xl mx-auto transition-transform duration-300 rounded-lg shadow cursor-pointer hover:scale-105"
                alt="Denah {{ $data['title'] }}" data-aos="zoom-in" @click="showDenah = true">
        </div>
        <!-- Modal Denah -->
        <div x-show="showDenah" x-transition @click.self="showDenah = false"
            class="fixed inset-0 z-[99999] flex items-center justify-center bg-black bg-opacity-80" style="display: none;">
            <button @click="showDenah = false"
                class="absolute top-4 right-4 z-[100000] p-2 text-white bg-black bg-opacity-50 rounded-full hover:bg-opacity-75">
                ✕
            </button>
            <img src="{{ asset('images/' . $data['denah']) }}" alt="Denah {{ $data['title'] }}"
                class="max-h-[90vh] max-w-[90vw] object-contain rounded-lg shadow-xl bg-white" />
        </div>
    </section>

    <!-- Fasilitas Section -->
    <section class="bg-[#0d2c25] text-white py-16 px-4 font-typewriter" data-aos="fade-up">
        <h2 class="mb-10 text-4xl font-bold text-center jp-brush" data-aos="fade-down">Fasilitas</h2>
        <div class="max-w-6xl mx-auto">
            <div class="mb-8" data-aos="fade-up" data-aos-delay="100">
                <h3 class="mb-2 text-2xl font-bold jp-brush">Kapasitas</h3>
                <p class="mb-2">
                    {{ isset($data['kapasitas']) ? $data['kapasitas'] : '-' }}
                </p>
                @if (!empty($data['extra_charge']) && $data['extra_charge'] > 0)
                    <p class="text-base text-red-300">
                        Rp.{{ number_format($data['extra_charge'], 0, ',', '.') }}/orang (anak di atas 2 tahun sudah
                        terhitung)
                    </p>
                @endif
            </div>
            <div class="grid gap-8 md:grid-cols-2">
                <div data-aos="fade-right" data-aos-delay="200">
                    <h3 class="mb-2 text-2xl font-bold jp-brush">Fasilitas Pribadi</h3>
                    @if (!empty($data['fasilitas_pribadi']) && count($data['fasilitas_pribadi']))
                        <ul class="space-y-1 text-base list-disc list-inside">
                            @foreach ($data['fasilitas_pribadi'] as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-base text-gray-300">Tidak ada fasilitas pribadi.</p>
                    @endif
                </div>
                <div data-aos="fade-left" data-aos-delay="200">
                    <h3 class="mb-2 text-2xl font-bold jp-brush">Fasilitas Umum</h3>
                    @if (!empty($data['fasilitas_umum']) && count($data['fasilitas_umum']))
                        <ul class="space-y-1 text-base list-disc list-inside">
                            @foreach ($data['fasilitas_umum'] as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-base text-gray-300">Tidak ada fasilitas umum.</p>
                    @endif
                    @if (!empty($data['catatan']))
                        <p class="mt-4 text-base text-red-400">{{ $data['catatan'] }}</p>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Harga Section -->
    <section class="py-12 bg-white font-typewriter" data-aos="fade-up">
        <h2 class="mb-8 text-4xl font-bold text-center text-green-700 jp-brush">Harga</h2>
        <div class="max-w-4xl mx-auto text-lg text-center">
            <div class="flex flex-col justify-center gap-8 md:flex-row">
                <div data-aos="fade-up" data-aos-delay="100">
                    <div class="font-bold">Hari Biasa</div>
                    <div>
                        {{ isset($data['harga_biasa']) && $data['harga_biasa'] !== '-' ? $data['harga_biasa'] . '/deck/malam' : '-' }}
                    </div>
                </div>
                <div data-aos="fade-up" data-aos-delay="200">
                    <div class="font-bold">Hari Libur</div>
                    <div>
                        {{ isset($data['harga_libur']) && $data['harga_libur'] !== '-' ? $data['harga_libur'] . '/deck/malam' : '-' }}
                    </div>
                </div>
                <div data-aos="fade-up" data-aos-delay="300">
                    <div class="font-bold">High Season</div>
                    <div>
                        {{ isset($data['harga_highseason']) && $data['harga_highseason'] !== '-' ? $data['harga_highseason'] . '/deck/malam' : '-' }}
                    </div>
                </div>
            </div>
            @if (!empty($data['harga_catatan']))
                <p class="mt-4 text-base text-gray-500">
                    {{ $data['harga_catatan'] }}
                </p>
            @endif

        </div>
    </section>

    <!-- Galeri Section -->
    @if (!empty($data['galeri']) && count($data['galeri']))
        <section class="py-12 bg-[#0d2c25] font-typewriter" x-data="{ showModal: false, modalImg: '' }">
            <h2 class="mb-10 text-4xl font-bold text-center text-white jp-brush" data-aos="fade-down">Galeri</h2>
            <p class="mb-8 text-center text-white" data-aos="fade-up" data-aos-delay="100">Nikmati momen tak terlupakan di
                {{ $data['title'] }} Riverside Camp.</p>
            <div class="grid max-w-6xl gap-6 px-4 mx-auto md:grid-cols-3">
                @foreach ($data['galeri'] as $gambar)
                    <img src="{{ asset('images/' . $gambar) }}"
                        class="object-cover w-full h-64 transition-transform duration-300 rounded-lg shadow cursor-pointer hover:scale-105"
                        alt="Galeri {{ $loop->iteration }}" data-aos="zoom-in" data-aos-delay="{{ 100 * $loop->index }}"
                        @click="showModal = true; modalImg = '{{ asset('images/' . $gambar) }}'">
                @endforeach
            </div>
            <!-- Modal Preview Galeri -->
            <div x-show="showModal" x-transition @click.self="showModal = false"
                class="fixed inset-0 z-[99999] flex items-center justify-center bg-black bg-opacity-80"
                style="display: none;">
                <button @click="showModal = false"
                    class="absolute top-4 right-4 z-[100000] p-2 text-white bg-black bg-opacity-50 rounded-full hover:bg-opacity-75">
                    ✕
                </button>
                <img :src="modalImg" alt="Preview Galeri"
                    class="max-h-[90vh] max-w-[90vw] object-contain rounded-lg shadow-xl bg-white" />
            </div>
        </section>
    @endif

    <!-- Reservasi Section -->
    <section class="relative" data-aos="fade-up">
        <img src="{{ asset('images/reservasi.jpg') }}" class="w-full h-[300px] object-cover" alt="Reservasi">
        <div
            class="absolute inset-0 flex flex-col items-center justify-center px-4 text-center text-white bg-black bg-opacity-50">
            <h2 class="mb-4 text-4xl font-bold jp-brush">Reservasi</h2>
            <p class="mb-4 font-typewriter">Pesan sekarang untuk merasakan pengalaman camping di pinggir sungai!</p>
            <a href="/reservasi"
                class="px-6 py-3 text-lg text-white bg-green-600 rounded hover:bg-green-700 font-typewriter">Booking</a>
        </div>
    </section>
</div>
@endsection
