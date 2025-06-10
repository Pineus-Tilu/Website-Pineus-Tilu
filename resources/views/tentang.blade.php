@extends('layouts.app') {{-- Pastikan layout Anda sudah punya navbar & footer --}}

@section('content')
<!-- Hero Section -->
<section class="relative flex items-center justify-center h-[85vh] px-6 text-white bg-center bg-cover" style="background-image: url('/images/tentang-hero.jpg')">
    <div class="absolute inset-0 bg-black bg-opacity-60"></div>
    <div class="relative z-10 text-center">
        <h1 class="text-4xl font-bold md:text-6xl jp-brush">Tentang Kami Untuk Lebih Lanjut</h1>
    </div>
</section>

<!-- Kontak Kami -->
<section class="bg-[#00291F] text-white px-6 py-12 text-center">
    <h2 class="mb-4 text-3xl font-bold md:text-4xl jp-brush">Kontak Kami</h2>
    <p class="max-w-2xl mx-auto mb-6 font-typewriter">
        Hubungi kami untuk informasi lebih lanjut tentang pengalaman camping di Pineus Tilu Riverside Camp.
    </p>
    <div class="flex flex-col justify-center gap-6 md:flex-row">
        <a href="https://wa.me/nomor1" target="_blank" class="px-6 py-3 text-green-800 bg-white shadow-md rounded-xl font-typewriter">Whatsapp 1</a>
        <a href="https://wa.me/nomor2" target="_blank" class="px-6 py-3 text-green-800 bg-white shadow-md rounded-xl font-typewriter">Whatsapp 2</a>
    </div>
</section>

<!-- Peraturan & Ketentuan -->
<section class="px-6 py-16 text-green-900 bg-white">
    <h2 class="mb-8 text-3xl font-bold text-center md:text-4xl jp-brush">Peraturan & Ketentuan</h2>
    <div class="grid gap-8 text-sm md:grid-cols-2 md:text-base font-typewriter">
        <ul class="space-y-2 list-disc list-inside">
            <li>Check-in pukul 14:00 WIB & Check-out pukul 12:00 WIB</li>
            <li>Keep Clean in the Area</li>
            <li>Keep Your Belongings Safe</li>
            <li>No Drugs & Alcohol</li>
            <li>No Pets Allowed</li>
            <!-- tambahkan lainnya sesuai gambar -->
        </ul>
        <ul class="space-y-2 list-disc list-inside">
            <li>No Smoking Inside the Tent</li>
            <li>Soft Organic & Inorganic Trash</li>
            <li>Tidak boleh ada pengasuh suara atau speaker</li>
            <li>Tidak boleh membahas atau memutar musik yg berunsur keras</li>
            <!-- tambahkan lainnya sesuai gambar -->
        </ul>
    </div>

    <!-- Penjadwalan & Pembatalan -->
    <div class="grid gap-8 mt-12 text-sm md:grid-cols-2 font-typewriter md:text-base">
        <div>
            <h3 class="mb-2 text-lg font-bold jp-brush">&gt; Penjadwalan Ulang</h3>
            <ul class="space-y-1 list-disc list-inside">
                <li>Sebelum H-7 free / tidak ada tambahan biaya</li>
                <li>H-7 s.d H-3 tambahan biaya</li>
                <!-- sesuai gambar -->
            </ul>
        </div>
        <div>
            <h3 class="mb-2 text-lg font-bold jp-brush">&gt; Pembatalan</h3>
            <ul class="space-y-1 list-disc list-inside">
                <li>Sebelum H-7 potongan biaya</li>
                <li>H-3 potongan biaya</li>
                <!-- sesuai gambar -->
            </ul>
        </div>
    </div>
    <p class="mt-6 text-sm italic text-red-600">*keterangan: ...</p>
</section>

<!-- Biaya Parkir -->
<section class="px-6 py-16 text-green-900 bg-gray-100">
    <h2 class="mb-8 text-3xl font-bold text-center md:text-4xl jp-brush">Informasi Biaya Parkir</h2>
    <div class="grid gap-12 text-sm md:grid-cols-2 md:text-base font-typewriter">
        <div>
            <h3 class="mb-2 font-bold jp-brush">&gt; Parkir Menginap</h3>
            <ul class="list-disc list-inside">
                <li>Mobil & Mini Bus 60K/malam</li>
                <li>Bus Medium 100K/malam</li>
                <!-- dst -->
            </ul>
        </div>
        <div>
            <h3 class="mb-2 font-bold jp-brush">&gt; Parkir Transit</h3>
            <ul class="list-disc list-inside">
                <li>Mobil & Mini Bus 10K/hari</li>
                <li>Bus Medium 30K/hari</li>
                <!-- dst -->
            </ul>
        </div>
    </div>
    <p class="mt-4 text-sm italic text-red-600">*Harga tidak termasuk biaya parkir tenda...</p>
</section>

<!-- Asuransi -->
<section class="px-6 py-16 text-green-900 bg-white">
    <h2 class="mb-8 text-3xl font-bold text-center md:text-4xl jp-brush">Informasi Asuransi</h2>
    <div class="max-w-3xl p-6 mx-auto text-sm bg-gray-100 rounded-lg shadow font-typewriter md:text-base">
        <h3 class="bg-[#006C43] text-white font-bold text-center rounded px-4 py-2 mb-4">PERNYATAAN PERSETUJUAN</h3>
        {{-- <p class="mb-4">Mulai Januari 2022, setiap pengunjung ... (isi sesuai gambar)</p>
        <ul class="space-y-2">
            <li>a. Meninggal Dunia akibat kecelakaan ... Rp. 15.000.000,-</li>
            <li>b. Meninggal Dunia ... Rp. 3.000.000,-</li>
            <li>c. Cacat tetap ... Rp. 20.000.000,-</li>
            <li>d. Biaya Perawatan ... Rp. 3.000.000,-</li> --}}
        </ul>
    </div>
</section>
@endsection
