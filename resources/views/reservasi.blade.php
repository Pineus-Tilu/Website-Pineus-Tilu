@extends('layouts.app')

@section('title', 'Reservasi')

@section('content')
<div class="min-h-screen bg-green-700 flex items-center justify-center py-8">
    <div class="max-w-4xl w-full mx-auto px-4 py-8 bg-white rounded-lg shadow-md">
        <!-- Breadcrumb -->
        <nav class="text-sm mb-6 text-green-700 flex items-center space-x-2">
            <span class="font-semibold text-green-900">Informasi Reservasi</span>
            <span>&gt;</span>
            <span>Detail Pembelian</span>
            <span>&gt;</span>
            <span>Pembayaran</span>
        </nav>

        <form action="{{ route('detailpembelian') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @csrf
            <!-- Informasi Reservasi -->
            <div>
                <h2 class="text-lg font-bold mb-4 text-green-900">Informasi Reservasi</h2>
                <div class="mb-4">
                    <label class="block mb-1 font-medium text-green-800">Tanggal Kunjungan</label>
                    <input name="tanggal_kunjungan" type="date" class="w-full border border-green-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-green-500" placeholder="Pilih tanggal kunjungan" required>
                </div>
                <div>
                    <label class="block mb-1 font-medium text-green-800">Opsi Fasilitas</label>
                    <select name="fasilitas" class="w-full border border-green-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-green-500" required>
                        <option value="">Pilih Fasilitas</option>
                        <option value="Camping">Camping</option>
                        <option value="Outbound">Outbound</option>
                        <!-- Tambahkan opsi destinasi lain jika perlu -->
                    </select>
                </div>
            </div>

            <!-- Informasi Pengunjung -->
            <div>
                <h2 class="text-lg font-bold mb-4 text-green-900">Informasi Pengunjung</h2>
                <div class="mb-4">
                    <label class="block mb-1 font-medium text-green-800">Nama Lengkap</label>
                    <input 
                        name="nama"
                        type="text" 
                        class="w-full border border-green-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-green-500 bg-gray-100" 
                        placeholder="Nama Lengkap"
                        value="{{ Auth::check() ? Auth::user()->name : '' }}"
                        @if(Auth::check()) readonly @endif
                        required
                    >
                </div>
                <div class="mb-4">
                    <label class="block mb-1 font-medium text-green-800">Nomor Telepon</label>
                    <input 
                        name="telepon"
                        type="text" 
                        class="w-full border border-green-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-green-500" 
                        placeholder="Telepon"
                        value="{{ Auth::check() ? Auth::user()->phone ?? '' : '' }}"
                        required
                    >
                </div>
                <div class="mb-4">
                    <label class="block mb-1 font-medium text-green-800">Email</label>
                    <input 
                        name="email"
                        type="email" 
                        class="w-full border border-green-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-green-500 bg-gray-100" 
                        placeholder="Email"
                        value="{{ Auth::check() ? Auth::user()->email : '' }}"
                        @if(Auth::check()) readonly @endif
                        required
                    >
                </div>
                <div class="mb-4">
                    <label class="block mb-1 font-medium text-green-800">Kode Promo (Opsional)</label>
                    <div class="flex">
                        <input 
                            name="kode_promo" 
                            type="text" 
                            class="w-full border border-green-300 rounded-l px-3 py-2 focus:outline-none focus:ring focus:border-green-500" 
                            placeholder="Masukan Kode Promo"
                        >
                        <button 
                            type="button" 
                            class="bg-green-700 text-white px-4 rounded-r hover:bg-green-700 transition flex items-center"
                            style="height: 42px;"
                        >&#10003;</button>
                    </div>
                </div>
                <div class="mb-2 text-right text-sm text-green-700">SubTotal</div>
                <div class="mb-2 text-right text-lg font-bold text-green-900">Rp 0</div>
                <div class="flex items-center mb-4">
                    <input type="checkbox" id="syarat" name="syarat" class="mr-2 accent-green-700" required>
                    <label for="syarat" class="text-sm text-green-800">Saya menyetujui syarat & ketentuan yang berlaku</label>
                </div>
                <button type="submit" class="w-full bg-green-700 text-white py-2 rounded font-semibold hover:bg-green-700 transition">Pesan Sekarang</button>
            </div>
        </form>
    </div>
</div>
@endsection