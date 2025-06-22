@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="relative h-[320px] pt-[120px] flex items-center justify-center">
        <img src="{{ asset('images/' . $data['hero']) }}" alt="{{ $data['title'] }}"
            class="absolute top-0 left-0 z-0 object-cover w-full h-full">
        <div class="relative z-10 flex flex-col items-center justify-center w-full h-full">
            <h1 class="text-5xl font-bold text-center text-white md:text-6xl lg:text-7xl jp-brush drop-shadow-lg">
                {{ strtoupper($data['title']) }}
            </h1>
        </div>
    </section>

    <!-- Denah Section -->
    <section class="py-10 text-center bg-white">
        <h2 class="mb-2 text-4xl font-bold text-green-700 jp-brush">Denah</h2>
        <p class="mb-6 text-gray-600 font-typewriter">Denah area {{ $data['title'] }} untuk memudahkan pengunjung memahami
            lokasi fasilitas.</p>
        <img src="{{ asset('images/' . $data['denah']) }}" class="max-w-2xl mx-auto rounded-lg shadow"
            alt="Denah {{ $data['title'] }}">
    </section>

    <!-- Fasilitas Section -->
    <section class="bg-[#0d2c25] text-white py-16 px-4 font-typewriter">
        <h2 class="mb-10 text-4xl font-bold text-center jp-brush">Fasilitas</h2>
        <div class="max-w-6xl mx-auto">
            <div class="mb-8">
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
                <div>
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
                <div>
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
    <section class="py-12 bg-white font-typewriter">
        <h2 class="mb-8 text-4xl font-bold text-center text-green-700 jp-brush">Harga</h2>
        <div class="max-w-4xl mx-auto text-lg text-center">
            <div class="flex flex-col justify-center gap-8 md:flex-row">
                <div>
                    <div class="font-bold">Hari Biasa</div>
                    <div>
                        {{ isset($data['harga_biasa']) && $data['harga_biasa'] !== '-' ? $data['harga_biasa'] . '/deck/malam' : '-' }}
                    </div>
                </div>
                <div>
                    <div class="font-bold">Hari Libur</div>
                    <div>
                        {{ isset($data['harga_libur']) && $data['harga_libur'] !== '-' ? $data['harga_libur'] . '/deck/malam' : '-' }}
                    </div>
                </div>
                <div>
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

    <!-- Fasilitas Visual Section -->
    @if (!empty($data['visual']) && count($data['visual']))
        <section class="bg-[#f4fff4] py-12 font-typewriter">
            <h2 class="mb-10 text-4xl font-bold text-center text-green-700 jp-brush">Fasilitas Visual</h2>
            <div class="grid max-w-6xl gap-8 px-4 mx-auto md:grid-cols-3">
                @foreach ($data['visual'] as $item)
                    <div class="text-center">
                        <img src="{{ asset('images/' . $item['gambar']) }}" class="mb-2 rounded-lg shadow"
                            alt="{{ $item['judul'] }}">
                        <h3 class="font-bold">{{ $item['judul'] }}</h3>
                        <p class="text-base text-gray-600">{{ $item['deskripsi'] }}</p>
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    <!-- Galeri Section -->
    @if (!empty($data['galeri']) && count($data['galeri']))
        <section class="py-12 bg-[#0d2c25] font-typewriter">
            <h2 class="mb-10 text-4xl font-bold text-center text-white jp-brush">Galeri</h2>
            <div class="grid max-w-6xl gap-6 px-4 mx-auto md:grid-cols-3">
                @foreach ($data['galeri'] as $gambar)
                    <img src="{{ asset('images/' . $gambar) }}" class="rounded-lg shadow"
                        alt="Galeri {{ $loop->iteration }}">
                @endforeach
            </div>
        </section>
    @endif

    <!-- Reservasi Section -->
    <section class="relative">
        <img src="{{ asset('images/reservasi.jpg') }}" class="w-full h-[300px] object-cover">
        <div
            class="absolute inset-0 flex flex-col items-center justify-center px-4 text-center text-white bg-black bg-opacity-50">
            <h2 class="mb-4 text-4xl font-bold jp-brush">Reservasi</h2>
            <p class="mb-4 font-typewriter">Pesan sekarang untuk merasakan pengalaman camping di pinggir sungai!</p>
            <a href="/reservasi"
                class="px-6 py-3 text-lg text-white bg-green-600 rounded hover:bg-green-700 font-typewriter">Booking</a>
        </div>
    </section>
@endsection
