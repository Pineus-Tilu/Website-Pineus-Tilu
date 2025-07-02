@extends('layouts.app')

@section('content')
    <div class="max-w-full overflow-hidden">
        <!-- Hero Section -->
        <section class="relative flex items-center justify-center h-[60vh] px-6 text-white bg-center bg-cover"
            style="background-image: url('/images/tentang.jpg')" data-aos="fade-in" data-aos-duration="1200">
            <div class="absolute inset-0 bg-black bg-opacity-60"></div>
            <div class="relative z-10 text-center" data-aos="fade-up" data-aos-delay="300">
                <h1 class="text-4xl font-bold md:text-6xl jp-brush">Tentang Kami Untuk Lebih Lanjut</h1>
            </div>
        </section>

        <!-- Kontak Kami -->
        <section class="bg-[#006C43] h-[40vh] text-white px-4 py-10 md:py-14 lg:py-16 relative flex items-center justify-center" data-aos="fade-up"
            data-aos-duration="1000">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="mb-4 text-2xl font-bold md:text-3xl lg:text-4xl jp-brush" data-aos="fade-down"
                    data-aos-delay="200">
                    Kontak Kami</h2>
                <p class="max-w-2xl mx-auto mb-6 text-base md:text-lg lg:text-xl font-typewriter" data-aos="fade-up"
                    data-aos-delay="400">
                    Hubungi kami untuk informasi lebih lanjut tentang pengalaman camping yang kami tawarkan. Kami siap
                    membantu
                    Anda dengan segala pertanyaan dan kebutuhan Anda.
                </p>
                <div class="flex flex-col items-center justify-center gap-4 sm:flex-row sm:gap-6" data-aos="zoom-in-up"
                    data-aos-delay="600">
                    <a href="https://wa.me/nomor1" target="_blank"
                        class="px-6 py-3 text-sm text-green-800 bg-white shadow-md md:text-base rounded-xl font-typewriter hover:bg-gray-200">Whatsapp
                        1</a>
                    <a href="https://wa.me/nomor2" target="_blank"
                        class="px-6 py-3 text-sm text-green-800 bg-white shadow-md md:text-base rounded-xl font-typewriter hover:bg-gray-200">Whatsapp
                        2</a>
                </div>
            </div>
        </section>

        <!-- Peraturan, Parkir, dan Asuransi - Dalam 1 Box -->
        <section class="px-6 py-16 text-green-900 bg-white" data-aos="fade-up" data-aos-duration="1000">
            <div class="max-w-6xl mx-auto text-center">
                <h2 class="mb-8 text-3xl font-bold md:text-4xl jp-brush" data-aos="fade-right" data-aos-delay="200">
                    Peraturan,
                    Ketentuan, Parkir & Asuransi</h2>

                <!-- Peraturan -->
                <div class="flex flex-wrap justify-center gap-16 text-base text-left font-typewriter md:text-lg"
                    data-aos="fade-up" data-aos-delay="300">
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
                        <li>Tidak boleh membuat suara yang terdengar mengganggu tenda tetangga dan suara alam dan
                            lingkungannya.
                        </li>
                    </ul>
                </div>

                <!-- Penjadwalan & Pembatalan -->
                <div class="flex flex-wrap justify-center gap-16 mt-12 text-base text-left font-typewriter md:text-lg">
                    <div class="w-96" data-aos="fade-left" data-aos-delay="200">
                        <h3 class="mb-2 text-lg font-bold jp-brush">&gt; Penjadwalan Ulang</h3>
                        <ul class="space-y-1 list-disc list-inside">
                            <li>Sebelum H-7 free / tidak ada tambahan biaya</li>
                            <li>H-7 s.d H-3 tambahan biaya</li>
                            <li>H-2 to H1 tambahan biaya 250rb/tenda</li>
                            <li>H tambahan biaya sesuai harga tenda</li>
                        </ul>
                    </div>
                    <div class="w-96" data-aos="fade-right" data-aos-delay="200">
                        <h3 class="mb-2 text-lg font-bold jp-brush">&gt; Pembatalan</h3>
                        <ul class="space-y-1 list-disc list-inside">
                            <li>Sebelum H-7 pemotongan biaya 25%/tenda</li>
                            <li>H-7 to H-4 pemotongan biaya 50%/tenda</li>
                            <li>H-3 to H-2 pemotongan biaya 75%/tenda</li>
                            <li>H-1 to H pemotongan biaya 100%/tenda</li>
                        </ul>
                    </div>
                </div>

                <!-- Keterangan -->
                <div class="w-full max-w-3xl mx-auto mt-6 text-base italic text-center text-red-600 font-typewriter md:text-lg"
                    data-aos="fade-up" data-aos-delay="300">
                    <p class="mb-2">*Keterangan:</p>
                    <ul class="not-italic font-normal text-left text-gray-700 list-disc list-inside">
                        <li>Kelebihan biaya/refund akan ditransfer paling lambat 14 hari kerja setelah pengiriman informasi
                            rekening penerima.</li>
                        <li>Refund karena gagal reservasi maksimal diproses paling lambat 3 hari kerja setelah pengiriman
                            informasi rekening.</li>
                        <li>Apabila terjadi suatu hal yang di luar kuasa kami, contoh: PPKM yang membuat kami terpaksa harus
                            tutup, biaya refund dipotong 50%.</li>
                        <li>Untuk penjadwalan ulang dan pembatalan harap hubungi admin kami yang telah kami sediakan di
                            bagian
                            kontak.</li>
                    </ul>
                </div>

                <!-- Biaya Parkir -->
                <div class="mt-12 text-base text-left font-typewriter md:text-lg" data-aos="fade-up" data-aos-delay="400">
                    <h3 class="mb-4 text-lg font-bold text-center jp-brush">Informasi Biaya Parkir</h3>
                    <div class="flex flex-wrap justify-center gap-16">
                        <div class="w-72">
                            <h4 class="mb-2 font-bold jp-brush">&gt; Parkir Menginap</h4>
                            <ul class="list-disc list-inside">
                                <li>Mobil & Mini Bus 60K/malam</li>
                                <li>Bus Medium 100K/malam</li>
                            </ul>
                        </div>
                        <div class="w-72">
                            <h4 class="mb-2 font-bold jp-brush">&gt; Parkir Transit</h4>
                            <ul class="list-disc list-inside">
                                <li>Mobil & Mini Bus 10K/hari</li>
                                <li>Bus Medium 30K/hari</li>
                            </ul>
                        </div>
                    </div>
                    <p class="w-full mx-auto mt-4 italic font-bold text-center text-red-600">*Harga tenda tidak termasuk
                        biaya
                        parkir. Biaya parkir dibayarkan langsung ke pengelola parkir ketika sampai di lokasi.</p>
                </div>

                <!-- Asuransi -->
                <div class="p-6 mt-12 text-base text-left bg-gray-100 rounded shadow font-typewriter md:text-lg"
                    data-aos="fade-up" data-aos-delay="500">
                    <h3 class="mb-4 text-lg font-bold text-center jp-brush">Informasi Asuransi</h3>
                    <p class="mb-4">
                        Mulai Januari 2022, setiap pengunjung yang camping di <strong>Pineus Tilu Camping Ground</strong>
                        wajib
                        menyampaikan pernyataan berikut ini. Bahwa saya selaku penanggung jawab pribadi dan rombongan/grup
                        menyatakan bahwa apabila terjadi kecelakaan/musibah atau bencana yang terjadi selama kami camping di
                        area <strong>Pineus Tilu Camping Ground</strong> tidak akan menuntut apa pun kepada pengelola,
                        kecuali
                        akan mendapatkan hak tanggungan asuransi yang telah bekerja sama dengan pihak Perhutani sesuai
                        dengan
                        detail jumlah pertanggungjawaban sebagai berikut:
                    </p>
                    <p class="mb-4">
                        Mendapat jaminan asuransi kecelakaan diri pengunjung dari <strong>ASURANSI SYARIAH AMANAH
                            GITHA</strong>
                        Polis induk <strong>No. 8009000050100188</strong> untuk kecelakaan yang dialami sejak memasuki pintu
                        masuk selama berada di dalam lokasi berakhir pada saat keluar. Besarnya Jaminan Asuransi:
                    </p>
                    <ul class="space-y-2 list-disc list-inside">
                        <li>a. Meninggal Dunia akibat kecelakaan (1 x 24 Jam) <strong>Rp. 15.000.000,-</strong></li>
                        <li>b. Meninggal Dunia di tempat wisata bukan akibat kecelakaan <strong>Rp. 3.000.000,-</strong>
                        </li>
                        <li>c. Cacat tetap sesuai persentase (%) sesuai syarat umum polis maksimum <strong>Rp.
                                20.000.000,-</strong></li>
                        <li>d. Biaya Perawatan/Pengobatan akibat kecelakaan maksimum <strong>Rp. 3.000.000,-</strong></li>
                    </ul>
                </div>
            </div>
        </section>
    </div>
@endsection
