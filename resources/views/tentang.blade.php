@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="relative flex items-center justify-center h-[85vh] px-6 text-white bg-center bg-cover"
        style="background-image: url('/images/tentang-hero.jpg')">
        <div class="absolute inset-0 bg-black bg-opacity-60"></div>
        <div class="relative z-10 text-center">
            <h1 class="text-4xl font-bold md:text-6xl jp-brush">Tentang Kami Untuk Lebih Lanjut</h1>
        </div>
    </section>

    <!-- Kontak Kami -->
    <section class="bg-[#00291F] text-white px-6 py-12">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="mb-4 text-3xl font-bold md:text-4xl jp-brush">Kontak Kami</h2>
            <p class="max-w-2xl mx-auto mb-6 font-typewriter">
                Hubungi kami untuk informasi lebih lanjut tentang pengalaman camping yang kami tawarkan. Kami siap membantu
                Anda dengan segala pertanyaan dan kebutuhan Anda.
            </p>
            <div class="flex flex-col items-center justify-center gap-6 md:flex-row">
                <a href="https://wa.me/nomor1" target="_blank"
                    class="px-6 py-3 text-green-800 bg-white shadow-md rounded-xl font-typewriter">Whatsapp 1</a>
                <a href="https://wa.me/nomor2" target="_blank"
                    class="px-6 py-3 text-green-800 bg-white shadow-md rounded-xl font-typewriter">Whatsapp 2</a>
            </div>
        </div>
    </section>

    <!-- Peraturan & Ketentuan -->
    <section class="px-6 py-16 text-green-900 bg-white">
        <div class="max-w-5xl mx-auto text-center">
            <h2 class="mb-8 text-3xl font-bold md:text-4xl jp-brush">Peraturan & Ketentuan</h2>

            <!-- List peraturan -->
            <div class="flex flex-wrap justify-center gap-16 text-sm text-left md:text-base font-typewriter">
                <ul class="space-y-2 list-disc list-inside w-96">
                    <li>Check-in pukul 14.00 WIB & Check-out pukul 12.00 WIB</li>
                    <li>Jaga Kebersihan di Area</li>
                    <li>Jaga Keamanan Barang Bawaan Anda</li>
                    <li>Utamakan Keselamatan & Berhati-hati di Area</li>
                    <li>Dilarang Menggunakan Narkoba & Alkohol</li>
                    <li>Dilarang Melakukan Kegiatan Asusila</li>
                    <li>Hewan Peliharaan Tidak Diizinkan</li>
                    <li>Dilarang Membawa Daging Babi & Daging Anjing pada Peralatan BBQ & Api Unggun</li>
                </ul>
                <ul class="space-y-2 list-disc list-inside w-96">
                    <li>Tidak merokok di dalam tenda</li>
                    <li>Memilah sampah organik dan anorganik</li>
                    <li>Tidak boleh ada pengeras suara atau speaker</li>
                    <li>Tidak boleh ada suara musik, kecuali hanya terdengar di tendanya sendiri.</li>
                    <li>Tidak boleh membawa alat musik yg bersuara keras.</li>
                    <li>Tidak boleh membawa alat karaoke.</li>
                    <li>Tidak boleh membuat suara yang terdengar mengganggu tenda tetangga dan suara alam dan lingkungannya.
                    </li>
                </ul>
            </div>

            <!-- Penjadwalan & Pembatalan -->
            <div class="flex flex-wrap justify-center gap-16 mt-12 text-sm text-left md:text-base font-typewriter">
                <div class="w-96">
                    <h3 class="mb-2 text-lg font-bold jp-brush">&gt; Penjadwalan Ulang</h3>
                    <ul class="space-y-1 list-disc list-inside">
                        <li>Sebelum H-7 free / tidak ada tambahan biaya</li>
                        <li>H-7 s.d H-3 tambahan biaya</li>
                        <li>H-2 to H1 tambahan biaya 250rb/tenda</li>
                        <li>H tambahan biaya sesuai harga tenda</li>
                    </ul>
                </div>
                <div class="w-96">
                    <h3 class="mb-2 text-lg font-bold jp-brush">&gt; Pembatalan</h3>
                    <ul class="space-y-1 list-disc list-inside">
                        <li>Sebelum H-7 pemotongan biaya 25%/tenda</li>
                        <li>H-7 to H-4 pemotongan biaya 50%/tenda</li>
                        <li>H-3 to H-2 pemotongan biaya 75%/tenda</li>
                        <li>H-1 to H pemotongan biaya 100%/tenda</li>
                    </ul>
                </div>
            </div>
            
            <!-- Keterangan tengah -->
            <div class="w-full max-w-3xl mx-auto mt-6 text-sm italic text-center text-red-600">
                <p class="mb-2">*Keterangan:</p>
                <ul class="not-italic font-normal text-left text-gray-700 list-disc list-inside">
                    <li>Kelebihan biaya/refund akan ditransfer paling lambat 14 hari kerja setelah pengiriman informasi
                        rekening penerima.</li>
                    <li>Refund karena gagal reservasi maksimal diproses paling lambat 3 hari kerja setelah pengiriman
                        informasi rekening.</li>
                    <li>Apabila terjadi suatu hal yang di luar kuasa kami, contoh: PPKM yang membuat kami terpaksa harus
                        tutup, biaya refund dipotong 50%.</li>
                    <li>Untuk penjadwalan ulang dan pembatalan harap hubungi admin kami yang telah kami sediakan di bagian
                        kontak.</li>
                </ul>
            </div>

        </div>
    </section>

    <!-- Biaya Parkir -->
    <section class="px-6 py-16 text-green-900 bg-gray-100">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="mb-8 text-3xl font-bold md:text-4xl jp-brush">Informasi Biaya Parkir</h2>
            <div class="flex flex-wrap justify-center gap-16 text-sm text-left md:text-base font-typewriter">
                <div class="w-72">
                    <h3 class="mb-2 font-bold jp-brush">&gt; Parkir Menginap</h3>
                    <ul class="list-disc list-inside">
                        <li>Mobil & Mini Bus 60K/malam</li>
                        <li>Bus Medium 100K/malam</li>
                    </ul>
                </div>
                <div class="w-72">
                    <h3 class="mb-2 font-bold jp-brush">&gt; Parkir Transit</h3>
                    <ul class="list-disc list-inside">
                        <li>Mobil & Mini Bus 10K/hari</li>
                        <li>Bus Medium 30K/hari</li>
                    </ul>
                </div>
            </div>

            <!-- Keterangan tengah -->
            <p class="w-full mx-auto mt-4 text-sm italic text-center text-red-600">*Harga tenda tidak termasuk biaya parkir.
                Biaya parkir dibayarkan langsung ke pengelola parkir ketika sampai di lokasi.</p>
        </div>
    </section>

    <!-- Asuransi -->
    <section class="px-6 py-16 text-green-900 bg-white">
    <div class="max-w-3xl mx-auto text-center">
        <h2 class="mb-8 text-3xl font-bold md:text-4xl jp-brush">Informasi Asuransi</h2>
        <div class="p-6 text-sm text-left bg-gray-100 rounded-lg shadow md:text-base font-typewriter">
            <h3 class="bg-[#006C43] text-white font-bold text-center rounded px-4 py-2 mb-4">PERNYATAAN PERSETUJUAN</h3>
            <p class="mb-4">
                Mulai Januari 2022, setiap pengunjung yang camping di <strong>Pineus Tilu Camping Ground</strong> wajib menyampaikan pernyataan berikut ini. 
                Bahwa saya selaku penanggung jawab pribadi dan rombongan/grup menyatakan bahwa apabila terjadi kecelakaan/musibah atau bencana 
                yang terjadi selama kami camping di area <strong>Pineus Tilu Camping Ground</strong> tidak akan menuntut apa pun kepada pengelola, 
                kecuali akan mendapatkan hak tanggungan asuransi yang telah bekerja sama dengan pihak Perhutani sesuai dengan detail jumlah 
                pertanggungjawaban sebagai berikut:
            </p>
            <p class="mb-4">
                Mendapat jaminan asuransi kecelakaan diri pengunjung dari <strong>ASURANSI SYARIAH AMANAH GITHA</strong> Polis induk 
                <strong>No. 8009000050100188</strong> untuk kecelakaan yang dialami sejak memasuki pintu masuk selama berada di dalam lokasi berakhir 
                pada saat keluar. Besarnya Jaminan Asuransi:
            </p>
            <ul class="space-y-2 list-disc list-inside">
                <li>a. Meninggal Dunia akibat kecelakaan (1 x 24 Jam) .......................................... <strong>Rp. 15.000.000,-</strong></li>
                <li>b. Meninggal Dunia di tempat wisata bukan akibat kecelakaan ..................... <strong>Rp. 3.000.000,-</strong></li>
                <li>c. Cacat tetap sesuai persentase (%) sesuai syarat umum polis maksimum ....... <strong>Rp. 20.000.000,-</strong></li>
                <li>d. Biaya Perawatan/Pengobatan akibat kecelakaan maksimum ..................... <strong>Rp. 3.000.000,-</strong></li>
            </ul>
        </div>
    </div>
</section>

@endsection
