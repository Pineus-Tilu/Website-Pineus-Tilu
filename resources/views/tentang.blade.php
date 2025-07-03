@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="relative flex items-center justify-center h-[85vh] px-6 text-white bg-center bg-cover"
        style="background-image: url('/images/tentang-hero.jpg')">
        <div class="absolute inset-0 bg-black bg-opacity-60"></div>
        <div class="relative z-10 text-center">
            <h1 class="text-4xl font-bold md:text-6xl jp-brush animate-fade-in">Tentang Kami Untuk Lebih Lanjut</h1>
            <p class="mt-4 text-lg md:text-xl font-typewriter opacity-90">Dapatkan informasi lengkap tentang layanan camping terbaik kami</p>
        </div>
    </section>

    <!-- Kontak Kami -->
    <section class="bg-gradient-to-r from-[#00291F] to-[#004030] text-white px-6 py-16">
        <div class="max-w-4xl mx-auto text-center">
            <div class="mb-8">
                <h2 class="mb-4 text-3xl font-bold md:text-4xl jp-brush">Kontak Kami</h2>
                <div class="w-24 h-1 mx-auto bg-green-400 rounded"></div>
            </div>
            <p class="max-w-2xl mx-auto mb-8 text-lg font-typewriter opacity-90">
                Hubungi kami untuk informasi lebih lanjut tentang pengalaman camping yang kami tawarkan. Kami siap membantu
                Anda dengan segala pertanyaan dan kebutuhan Anda.
            </p>
            <div class="flex flex-col items-center justify-center gap-6 md:flex-row">
                <a href="https://wa.me/nomor1" target="_blank"
                    class="flex items-center gap-3 px-8 py-4 text-green-800 transition-all duration-300 bg-white shadow-lg rounded-xl hover:bg-green-50 hover:shadow-xl hover:-translate-y-1 font-typewriter">
                    <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.893 3.386"/>
                    </svg>
                    WhatsApp Admin 1
                </a>
                <a href="https://wa.me/nomor2" target="_blank"
                    class="flex items-center gap-3 px-8 py-4 text-green-800 transition-all duration-300 bg-white shadow-lg rounded-xl hover:bg-green-50 hover:shadow-xl hover:-translate-y-1 font-typewriter">
                    <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.893 3.386"/>
                    </svg>
                    WhatsApp Admin 2
                </a>
            </div>
        </div>
    </section>

    <!-- Peraturan & Ketentuan -->
    <section class="px-6 py-20 text-green-900 bg-gray-50">
        <div class="max-w-6xl mx-auto">
            <div class="mb-12 text-center">
                <h2 class="mb-4 text-3xl font-bold md:text-4xl jp-brush">Peraturan & Ketentuan</h2>
                <div class="w-24 h-1 mx-auto bg-green-600 rounded"></div>
                <p class="mt-4 text-lg text-gray-600 font-typewriter">Pastikan Anda memahami dan mematuhi semua peraturan berikut</p>
            </div>

            <!-- Peraturan Umum -->
            <div class="mb-16">
                <h3 class="mb-6 text-2xl font-bold text-center jp-brush text-green-800">📋 Peraturan Umum</h3>
                <div class="grid gap-8 md:grid-cols-2">
                    <div class="p-6 bg-white border-l-4 border-green-600 shadow-md rounded-lg">
                        <ul class="space-y-3 text-sm md:text-base font-typewriter">
                            <li class="flex items-start gap-2">
                                <span class="text-green-600">✓</span>
                                <span>Check-in pukul 14.00 WIB & Check-out pukul 12.00 WIB</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="text-green-600">✓</span>
                                <span>Jaga Kebersihan di Area</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="text-green-600">✓</span>
                                <span>Jaga Keamanan Barang Bawaan Anda</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="text-green-600">✓</span>
                                <span>Utamakan Keselamatan & Berhati-hati di Area</span>
                            </li>
                        </ul>
                    </div>
                    <div class="p-6 bg-white border-l-4 border-red-500 shadow-md rounded-lg">
                        <ul class="space-y-3 text-sm md:text-base font-typewriter">
                            <li class="flex items-start gap-2">
                                <span class="text-red-500">✗</span>
                                <span>Dilarang Menggunakan Narkoba & Alkohol</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="text-red-500">✗</span>
                                <span>Dilarang Melakukan Kegiatan Asusila</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="text-red-500">✗</span>
                                <span>Hewan Peliharaan Tidak Diizinkan</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="text-red-500">✗</span>
                                <span>Dilarang Membawa Daging Babi & Daging Anjing pada Peralatan BBQ & Api Unggun</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Peraturan Lingkungan -->
            <div class="mb-16">
                <h3 class="mb-6 text-2xl font-bold text-center jp-brush text-green-800">🌿 Peraturan Lingkungan & Suara</h3>
                <div class="p-6 bg-white shadow-md rounded-lg">
                    <div class="grid gap-6 md:grid-cols-2">
                        <ul class="space-y-3 text-sm md:text-base font-typewriter">
                            <li class="flex items-start gap-2">
                                <span class="text-orange-500">⚠️</span>
                                <span>Tidak merokok di dalam tenda</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="text-green-600">♻️</span>
                                <span>Memilah sampah organik dan anorganik</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="text-red-500">🔇</span>
                                <span>Tidak boleh ada pengeras suara atau speaker</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="text-red-500">🎵</span>
                                <span>Tidak boleh ada suara musik, kecuali hanya terdengar di tendanya sendiri</span>
                            </li>
                        </ul>
                        <ul class="space-y-3 text-sm md:text-base font-typewriter">
                            <li class="flex items-start gap-2">
                                <span class="text-red-500">🎸</span>
                                <span>Tidak boleh membawa alat musik yang bersuara keras</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="text-red-500">🎤</span>
                                <span>Tidak boleh membawa alat karaoke</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="text-red-500">🔊</span>
                                <span>Tidak boleh membuat suara yang terdengar mengganggu tenda tetangga dan suara alam</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Penjadwalan & Pembatalan -->
            <div class="grid gap-8 md:grid-cols-2">
                <div class="p-6 bg-white border-t-4 border-blue-500 shadow-md rounded-lg">
                    <h3 class="mb-4 text-xl font-bold text-center jp-brush text-blue-700">📅 Penjadwalan Ulang</h3>
                    <ul class="space-y-3 text-sm md:text-base font-typewriter">
                        <li class="flex justify-between p-2 bg-green-50 rounded">
                            <span>Sebelum H-7</span>
                            <span class="font-bold text-green-600">GRATIS</span>
                        </li>
                        <li class="flex justify-between p-2 bg-yellow-50 rounded">
                            <span>H-7 s.d H-3</span>
                            <span class="font-bold text-yellow-600">Tambahan biaya</span>
                        </li>
                        <li class="flex justify-between p-2 bg-orange-50 rounded">
                            <span>H-2 to H-1</span>
                            <span class="font-bold text-orange-600">+250rb/tenda</span>
                        </li>
                        <li class="flex justify-between p-2 bg-red-50 rounded">
                            <span>H (hari H)</span>
                            <span class="font-bold text-red-600">Sesuai harga tenda</span>
                        </li>
                    </ul>
                </div>
                <div class="p-6 bg-white border-t-4 border-red-500 shadow-md rounded-lg">
                    <h3 class="mb-4 text-xl font-bold text-center jp-brush text-red-700">❌ Pembatalan</h3>
                    <ul class="space-y-3 text-sm md:text-base font-typewriter">
                        <li class="flex justify-between p-2 bg-green-50 rounded">
                            <span>Sebelum H-7</span>
                            <span class="font-bold text-green-600">Potong 25%</span>
                        </li>
                        <li class="flex justify-between p-2 bg-yellow-50 rounded">
                            <span>H-7 to H-4</span>
                            <span class="font-bold text-yellow-600">Potong 50%</span>
                        </li>
                        <li class="flex justify-between p-2 bg-orange-50 rounded">
                            <span>H-3 to H-2</span>
                            <span class="font-bold text-orange-600">Potong 75%</span>
                        </li>
                        <li class="flex justify-between p-2 bg-red-50 rounded">
                            <span>H-1 to H</span>
                            <span class="font-bold text-red-600">Potong 100%</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <!-- Keterangan -->
            <div class="p-6 mt-8 bg-blue-50 border border-blue-200 rounded-lg">
                <h4 class="mb-3 text-lg font-bold text-blue-800 jp-brush">📌 Keterangan Penting:</h4>
                <ul class="space-y-2 text-sm text-blue-700 font-typewriter">
                    <li>• Kelebihan biaya/refund akan ditransfer paling lambat 14 hari kerja setelah pengiriman informasi rekening penerima</li>
                    <li>• Refund karena gagal reservasi maksimal diproses paling lambat 3 hari kerja setelah pengiriman informasi rekening</li>
                    <li>• Apabila terjadi suatu hal yang di luar kuasa kami, contoh: PPKM yang membuat kami terpaksa harus tutup, biaya refund dipotong 50%</li>
                    <li>• Untuk penjadwalan ulang dan pembatalan harap hubungi admin kami yang telah kami sediakan di bagian kontak</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Biaya Parkir -->
    <section class="px-6 py-20 text-green-900 bg-white">
        <div class="max-w-4xl mx-auto">
            <div class="mb-12 text-center">
                <h2 class="mb-4 text-3xl font-bold md:text-4xl jp-brush">🚗 Informasi Biaya Parkir</h2>
                <div class="w-24 h-1 mx-auto bg-green-600 rounded"></div>
            </div>
            
            <div class="grid gap-8 md:grid-cols-2">
                <div class="p-6 bg-gradient-to-br from-blue-50 to-blue-100 border border-blue-200 rounded-lg shadow-md">
                    <h3 class="mb-4 text-xl font-bold text-center jp-brush text-blue-800">🌙 Parkir Menginap</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between p-3 bg-white rounded-lg shadow-sm">
                            <span class="font-typewriter">🚗 Mobil & Mini Bus</span>
                            <span class="font-bold text-blue-600">60K/malam</span>
                        </div>
                        <div class="flex justify-between p-3 bg-white rounded-lg shadow-sm">
                            <span class="font-typewriter">🚌 Bus Medium</span>
                            <span class="font-bold text-blue-600">100K/malam</span>
                        </div>
                    </div>
                </div>
                
                <div class="p-6 bg-gradient-to-br from-green-50 to-green-100 border border-green-200 rounded-lg shadow-md">
                    <h3 class="mb-4 text-xl font-bold text-center jp-brush text-green-800">☀️ Parkir Transit</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between p-3 bg-white rounded-lg shadow-sm">
                            <span class="font-typewriter">🚗 Mobil & Mini Bus</span>
                            <span class="font-bold text-green-600">10K/hari</span>
                        </div>
                        <div class="flex justify-between p-3 bg-white rounded-lg shadow-sm">
                            <span class="font-typewriter">🚌 Bus Medium</span>
                            <span class="font-bold text-green-600">30K/hari</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-4 mt-8 text-center bg-yellow-50 border border-yellow-200 rounded-lg">
                <p class="text-sm italic text-yellow-800 font-typewriter">
                    ⚠️ <strong>Penting:</strong> Harga tenda tidak termasuk biaya parkir. Biaya parkir dibayarkan langsung ke pengelola parkir ketika sampai di lokasi.
                </p>
            </div>
        </div>
    </section>

    <!-- Asuransi -->
    <section class="px-6 py-20 text-green-900 bg-gray-50">
        <div class="max-w-4xl mx-auto">
            <div class="mb-12 text-center">
                <h2 class="mb-4 text-3xl font-bold md:text-4xl jp-brush">🛡️ Informasi Asuransi</h2>
                <div class="w-24 h-1 mx-auto bg-green-600 rounded"></div>
            </div>
            
            <div class="overflow-hidden bg-white shadow-xl rounded-xl">
                <div class="bg-gradient-to-r from-[#006C43] to-[#008854] text-white text-center py-6">
                    <h3 class="text-xl font-bold jp-brush">📋 PERNYATAAN PERSETUJUAN</h3>
                    <p class="mt-2 text-sm opacity-90">Berlaku untuk semua pengunjung mulai Januari 2022</p>
                </div>
                
                <div class="p-8">
                    <div class="mb-6">
                        <p class="mb-4 leading-relaxed text-gray-700 font-typewriter">
                            Setiap pengunjung yang camping di <strong class="text-green-700">Pineus Tilu Camping Ground</strong> wajib menyetujui bahwa apabila terjadi kecelakaan/musibah atau bencana selama camping, tidak akan menuntut pengelola, kecuali mendapatkan hak tanggungan asuransi yang telah bekerja sama dengan Perhutani.
                        </p>
                    </div>

                    <div class="p-4 mb-6 bg-blue-50 border border-blue-200 rounded-lg">
                        <h4 class="mb-2 font-bold text-blue-800 jp-brush">🏢 Penyedia Asuransi</h4>
                        <p class="text-sm text-blue-700 font-typewriter">
                            <strong>ASURANSI SYARIAH AMANAH GITHA</strong><br>
                            Polis Induk No. <strong>8009000050100188</strong>
                        </p>
                    </div>

                    <h4 class="mb-4 text-lg font-bold text-green-800 jp-brush">💰 Besaran Jaminan Asuransi:</h4>
                    <div class="space-y-3">
                        <div class="flex justify-between p-4 bg-red-50 border border-red-200 rounded-lg">
                            <span class="font-typewriter">☠️ Meninggal Dunia akibat kecelakaan (1 x 24 Jam)</span>
                            <span class="font-bold text-red-600">Rp. 15.000.000,-</span>
                        </div>
                        <div class="flex justify-between p-4 bg-orange-50 border border-orange-200 rounded-lg">
                            <span class="font-typewriter">💀 Meninggal Dunia bukan akibat kecelakaan</span>
                            <span class="font-bold text-orange-600">Rp. 3.000.000,-</span>
                        </div>
                        <div class="flex justify-between p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                            <span class="font-typewriter">♿ Cacat tetap sesuai persentase (maksimum)</span>
                            <span class="font-bold text-yellow-600">Rp. 20.000.000,-</span>
                        </div>
                        <div class="flex justify-between p-4 bg-green-50 border border-green-200 rounded-lg">
                            <span class="font-typewriter">🏥 Biaya Perawatan/Pengobatan akibat kecelakaan</span>
                            <span class="font-bold text-green-600">Rp. 3.000.000,-</span>
                        </div>
                    </div>

                    <div class="p-4 mt-6 bg-gray-100 border border-gray-300 rounded-lg">
                        <p class="text-xs text-gray-600 font-typewriter">
                            <strong>Catatan:</strong> Jaminan asuransi berlaku sejak memasuki pintu masuk hingga keluar dari lokasi camping.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection