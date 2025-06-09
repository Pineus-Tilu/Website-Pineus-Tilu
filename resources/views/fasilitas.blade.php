@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="relative">
    <img src="{{ asset('images/' . $data['hero']) }}" alt="{{ $data['title'] }}" class="w-full h-[300px] object-cover">
    <h1 class="absolute text-4xl font-bold text-white transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 md:text-6xl drop-shadow-lg">
        {{ strtoupper($data['title']) }}
    </h1>
</section>

<!-- Denah Section -->
<section class="py-10 text-center bg-white">
    <h2 class="mb-2 text-3xl font-semibold text-green-700">Denah</h2>
    <p class="mb-6 text-gray-600">Demi kejelasan calon pengunjung, berikut kami lampirkan denah area {{ $data['title'] }} dengan beberapa penjelasannya</p>
    <img src="{{ asset('images/' . $data['denah']) }}" class="max-w-md mx-auto" alt="Denah {{ $data['title'] }}">
</section>

<!-- Fasilitas Section -->
<section class="bg-[#0d2c25] text-white py-12 px-4">
    <h2 class="mb-10 text-3xl font-semibold text-center">Fasilitas</h2>

    <div class="grid max-w-6xl gap-10 mx-auto md:grid-cols-2">
        <div>
            <h3 class="mb-2 text-xl font-bold">Kapasitas</h3>
            <p class="mb-4">{{ $data['kapasitas'] }}<br><small>*anak di atas 5 tahun sudah terhitung</small></p>

            <h3 class="mb-2 text-xl font-bold">Fasilitas Pribadi</h3>
            <ul class="space-y-1 text-sm list-disc list-inside">
                @foreach ($data['fasilitas_pribadi'] as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ul>
        </div>

        <div>
            <h3 class="mb-2 text-xl font-bold">Fasilitas Umum</h3>
            <ul class="space-y-1 text-sm list-disc list-inside">
                @foreach ($data['fasilitas_umum'] as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ul>

            @if (!empty($data['catatan']))
                <p class="mt-4 text-sm text-red-400">{{ $data['catatan'] }}</p>
            @endif
        </div>
    </div>
</section>

<!-- Harga Section -->
<section class="py-10 bg-white">
    <h2 class="mb-8 text-3xl font-semibold text-center text-green-700">Harga</h2>

    <div class="max-w-4xl mx-auto text-lg text-center">
        <p><strong>Hari Biasa:</strong> {{ $data['harga_biasa'] }}/deck/malam</p>
        <p><strong>Hari Libur:</strong> {{ $data['harga_libur'] }}/deck/malam</p>
        <p class="mt-4 text-sm text-gray-500">{{ $data['harga_catatan'] }}</p>
    </div>
</section>

<!-- Fasilitas Visual Section -->
<section class="bg-[#f4fff4] py-10">
    <h2 class="mb-10 text-3xl font-semibold text-center text-green-700">Fasilitas</h2>

    <div class="grid max-w-6xl gap-6 px-4 mx-auto md:grid-cols-3">
        @foreach ($data['visual'] as $item)
        <div class="text-center">
            <img src="{{ asset('images/' . $item['gambar']) }}" class="mb-2 rounded-lg shadow" alt="{{ $item['judul'] }}">
            <h3 class="font-bold">{{ $item['judul'] }}</h3>
            <p class="text-sm text-gray-600">{{ $item['deskripsi'] }}</p>
        </div>
        @endforeach
    </div>
</section>

<!-- Galeri Section -->
<section class="py-10 text-white bg-green-900">
    <h2 class="mb-10 text-3xl font-semibold text-center">Galeri</h2>

    <div class="grid max-w-6xl gap-6 px-4 mx-auto md:grid-cols-3">
        @foreach ($data['galeri'] as $gambar)
            <img src="{{ asset('images/' . $gambar) }}" class="rounded-lg shadow" alt="Galeri {{ $loop->iteration }}">
        @endforeach
    </div>
</section>

<!-- Reservasi Section -->
<section class="relative">
    <img src="{{ asset('images/reservasi.jpg') }}" class="w-full h-[300px] object-cover">
    <div class="absolute inset-0 flex flex-col items-center justify-center px-4 text-center text-white bg-black bg-opacity-50">
        <h2 class="mb-4 text-3xl font-bold">Reservasi</h2>
        <p class="mb-4">Pesan sekarang untuk merasakan pengalaman camping di pinggir sungai!</p>
        <a href="/reservasi" class="px-6 py-3 text-lg text-white bg-green-600 rounded hover:bg-green-700">Booking</a>
    </div>
</section>
@endsection
