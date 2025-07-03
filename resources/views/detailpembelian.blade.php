@extends('layouts.app')

@section('title', 'Detail Pembelian')

@section('content')
    <div class="flex items-center justify-center min-h-screen px-4 pt-24 pb-8"
        style="background-image: url('/images/reservasi.jpg'); background-size: cover; background-position: center;">
        <div class="w-full max-w-2xl px-4 py-8 mx-auto bg-white rounded-lg shadow-md sm:px-6 font-typewriter">

            <!-- Breadcrumb -->
            <nav class="flex flex-wrap items-center mb-6 space-x-2 text-sm text-green-700">
                <span class="font-semibold text-green-900">Informasi Reservasi</span>
                <span>&gt;</span>
                <span class="font-semibold text-green-900">Detail Pembelian</span>
                <span>&gt;</span>
                <span>Pembayaran</span>
            </nav>

            <h2 class="mb-6 text-xl font-bold text-center text-green-900">Detail Pembelian</h2>

            <!-- Data Reservasi -->
            <div class="mb-6">
                <h3 class="mb-2 text-lg font-bold text-green-800">Data Reservasi</h3>
                <div class="grid grid-cols-1 gap-4 text-green-900 sm:grid-cols-2">
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
                    <div>
                        <div class="text-sm text-green-700">Status</div>
                        <div class="font-medium">
                            <span class="px-2 py-1 text-xs rounded {{ ($status ?? 'pending') === 'confirmed' ? 'bg-green-100 text-green-800' : (($status ?? 'pending') === 'cancelled' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                {{ ucfirst($status ?? 'pending') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Data Pengunjung -->
            <div class="mb-6">
                <h3 class="mb-2 text-lg font-bold text-green-800">Data Pengunjung</h3>
                <div class="grid grid-cols-1 gap-4 text-green-900 sm:grid-cols-2">
                    <div>
                        <div class="text-sm text-green-700">Nama Lengkap</div>
                        <div class="font-medium">{{ $nama ?? '-' }}</div>
                    </div>
                    <div>
                        <div class="text-sm text-green-700">Nomor Telepon</div>
                        <div class="font-medium">{{ $telepon ?? '-' }}</div>
                    </div>
                    <div class="sm:col-span-2">
                        <div class="text-sm text-green-700">Email</div>
                        <div class="font-medium break-words">{{ $email ?? '-' }}</div>
                    </div>
                </div>
            </div>

            <!-- Subtotal -->
            <div class="pt-4 mb-6 border-t">
                <div class="flex justify-between text-base font-semibold text-green-800">
                    <span>Subtotal</span>
                    <span>Rp {{ number_format($subtotal ?? 0, 0, ',', '.') }}</span>
                </div>
            </div>

            <!-- Button -->
            <form action="{{ route('pembayaran') }}" method="GET">
                <input type="hidden" name="nama" value="{{ $nama }}">
                <input type="hidden" name="email" value="{{ $email }}">
                <input type="hidden" name="telepon" value="{{ $telepon }}">
                <input type="hidden" name="subtotal" value="{{ $subtotal }}">
                <input type="hidden" name="status" value="{{ $status ?? 'pending' }}">
                <input type="hidden" name="fasilitas" value="{{ $fasilitas }}">
                <input type="hidden" name="deck" value="{{ $deck }}">
                <input type="hidden" name="tanggal_kunjungan" value="{{ $tanggal_kunjungan }}">
                <input type="hidden" name="jumlah_orang" value="{{ $jumlah_orang }}">
                <button class="w-full py-2 font-semibold text-white transition bg-green-600 rounded hover:bg-green-700">
                    Lanjut ke Pembayaran
                </button>
            </form>

        </div>
    </div>
@endsection