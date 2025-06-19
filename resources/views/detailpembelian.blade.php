@extends('layouts.app')

@section('title', 'Detail Pembelian')

@section('content')
<div class="min-h-screen bg-green-600 flex items-center justify-center py-8">
    <div class="max-w-2xl w-full mx-auto px-6 py-8 bg-white rounded-lg shadow-md">
        <!-- Breadcrumb -->
        <nav class="text-sm mb-6 text-green-700 flex items-center space-x-2">
            <span class="font-semibold text-green-900">Informasi Reservasi</span>
            <span>&gt;</span>
            <span class="font-semibold text-green-900">Detail Pembelian</span>
            <span>&gt;</span>
            <span>Pembayaran</span>
        </nav>

        <h2 class="text-xl font-bold mb-6 text-green-900 text-center">Detail Pembelian</h2>
        
        <div class="mb-6">
            <h3 class="font-semibold text-green-800 mb-2">Data Reservasi</h3>
            <div class="grid grid-cols-2 gap-4 text-green-900">
                <div>
                    <div class="text-sm text-green-700">Tanggal Kunjungan</div>
                    <div class="font-medium">{{ $tanggal_kunjungan ?? '-' }}</div>
                </div>
                <div>
                    <div class="text-sm text-green-700">Fasilitas</div>
                    <div class="font-medium">{{ $fasilitas ?? '-' }}</div>
                </div>
            </div>
        </div>

        <div class="mb-6">
            <h3 class="font-semibold text-green-800 mb-2">Data Pengunjung</h3>
            <div class="grid grid-cols-2 gap-4 text-green-900">
                <div>
                    <div class="text-sm text-green-700">Nama Lengkap</div>
                    <div class="font-medium">{{ $nama ?? '-' }}</div>
                </div>
                <div>
                    <div class="text-sm text-green-700">Nomor Telepon</div>
                    <div class="font-medium">{{ $telepon ?? '-' }}</div>
                </div>
                <div>
                    <div class="text-sm text-green-700">Email</div>
                    <div class="font-medium">{{ $email ?? '-' }}</div>
                </div>
                <div>
                    <div class="text-sm text-green-700">Kode Promo</div>
                    <div class="font-medium">{{ $kode_promo ?? '-' }}</div>
                </div>
            </div>
        </div>

        <div class="mb-6 border-t pt-4">
            <div class="flex justify-between text-green-800 font-semibold">
                <span>Subtotal</span>
                <span>Rp {{ number_format($subtotal ?? 0, 0, ',', '.') }}</span>
            </div>
        </div>

        <form action="{{ route('pembayaran') }}" method="GET">
            <input type="hidden" name="nama" value="{{ $nama }}">
            <input type="hidden" name="email" value="{{ $email }}">
            <input type="hidden" name="subtotal" value="{{ $subtotal }}">
            <button class="w-full bg-green-600 text-white py-2 rounded font-semibold hover:bg-green-700 transition">
                Lanjut ke Pembayaran
            </button>
        </form>
    </div>
</div>
@endsection