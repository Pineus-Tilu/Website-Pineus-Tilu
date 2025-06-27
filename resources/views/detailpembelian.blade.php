@extends('layouts.app')

@section('title', 'Detail Pembelian')

@section('content')
    <div class="flex items-center justify-center min-h-screen py-8 bg-green-600">
        <div class="w-full max-w-2xl px-6 py-8 mx-auto bg-white rounded-lg shadow-md">
            <!-- Breadcrumb -->
            <nav class="flex items-center mb-6 space-x-2 text-sm text-green-700">
                <span class="font-semibold text-green-900">Informasi Reservasi</span>
                <span>&gt;</span>
                <span class="font-semibold text-green-900">Detail Pembelian</span>
                <span>&gt;</span>
                <span>Pembayaran</span>
            </nav>

            <h2 class="mb-6 text-xl font-bold text-center text-green-900">Detail Pembelian</h2>

            <div class="mb-6">
                <h3 class="mb-2 font-semibold text-green-800">Data Reservasi</h3>
                <div class="grid grid-cols-2 gap-4 text-green-900">
                    <div>
                        <div class="text-sm text-green-700">Tanggal Check-in</div>
                        <div class="font-medium">{{ $bookingDetail->check_in ?? ($tanggal_kunjungan ?? '-') }}</div>
                    </div>
                    <div>
                        <div class="text-sm text-green-700">Tanggal Check-out</div>
                        <div class="font-medium">{{ $bookingDetail->check_out ?? '-' }}</div>
                    </div>
                    <div>
                        <div class="text-sm text-green-700">Area</div>
                        <div class="font-medium">{{ $fasilitas ?? '-' }}</div>
                    </div>
                    <div>
                        <div class="text-sm text-green-700">Deck</div>
                        <div class="font-medium">{{ $deck ?? '-' }}</div>
                    </div>
                    <div>
                        <div class="text-sm text-green-700">Jumlah Orang</div>
                        <div class="font-medium">{{ $jumlah_orang ?? '-' }}</div>
                    </div>
                </div>
            </div>

            <div class="mb-6">
                <h3 class="mb-2 font-semibold text-green-800">Data Pengunjung</h3>
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
                </div>
            </div>

            <div class="pt-4 mb-6 border-t">
                <div class="flex justify-between font-semibold text-green-800">
                    <span>Subtotal</span>
                    <span>Rp {{ number_format($subtotal ?? 0, 0, ',', '.') }}</span>
                </div>
            </div>

            <form action="{{ route('pembayaran') }}" method="GET">
                <input type="hidden" name="nama" value="{{ $nama }}">
                <input type="hidden" name="email" value="{{ $email }}">
                <input type="hidden" name="subtotal" value="{{ $subtotal }}">
                <button class="w-full py-2 font-semibold text-white transition bg-green-600 rounded hover:bg-green-700">
                    Lanjut ke Pembayaran
                </button>
            </form>
        </div>
    </div>
@endsection
