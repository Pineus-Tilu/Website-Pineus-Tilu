@extends('layouts.app')

@section('title', 'Detail Booking - Pineus Tilu')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Header --}}
        <div class="bg-white rounded-lg shadow-sm border p-6 mb-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Detail Booking</h1>
                    <p class="text-gray-600 mt-1">Booking ID: #{{ $booking->id }}</p>
                </div>
                <div class="text-right">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                        @if($booking->status->name === 'success') bg-green-100 text-green-800
                        @elseif($booking->status->name === 'pending') bg-yellow-100 text-yellow-800
                        @else bg-red-100 text-red-800 @endif">
                        {{ ucfirst($booking->status->name) }}
                    </span>
                </div>
            </div>
        </div>

        {{-- Guest Information --}}
        <div class="bg-white rounded-lg shadow-sm border p-6 mb-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Informasi Tamu</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $booking->bookingDetail->nama ?? $booking->user->name ?? 'N/A' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $booking->bookingDetail->email ?? $booking->user->email ?? 'N/A' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Telepon</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $booking->bookingDetail->telepon ?? $booking->user->phone ?? 'N/A' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Jumlah Tamu</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $booking->bookingDetail->number_of_people ?? 1 }} orang</p>
                </div>
            </div>
        </div>

        {{-- Booking Details --}}
        <div class="bg-white rounded-lg shadow-sm border p-6 mb-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Detail Reservasi</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Area</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $booking->unit->area->name ?? 'N/A' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Deck</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $booking->unit->unit_name ?? 'N/A' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Check-in</label>
                    <p class="mt-1 text-sm text-gray-900">{{ \Carbon\Carbon::parse($booking->bookingDetail->check_in)->format('d F Y') }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Check-out</label>
                    <p class="mt-1 text-sm text-gray-900">{{ \Carbon\Carbon::parse($booking->bookingDetail->check_out)->format('d F Y') }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Tanggal Booking</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $booking->created_at->format('d F Y H:i') }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Invoice Number</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $booking->invoice_number ?? 'INV-' . str_pad($booking->id, 6, '0', STR_PAD_LEFT) }}</p>
                </div>
            </div>
        </div>

        {{-- Payment Information --}}
        <div class="bg-white rounded-lg shadow-sm border p-6 mb-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Informasi Pembayaran</h2>
            <div class="space-y-3">
                <div class="flex justify-between">
                    <span class="text-sm text-gray-600">Harga Dasar</span>
                    <span class="text-sm text-gray-900">Rp {{ number_format(($booking->bookingDetail->total_price - $booking->bookingDetail->extra_charge), 0, ',', '.') }}</span>
                </div>
                @if($booking->bookingDetail->extra_charge > 0)
                <div class="flex justify-between">
                    <span class="text-sm text-gray-600">Extra Charge</span>
                    <span class="text-sm text-gray-900">Rp {{ number_format($booking->bookingDetail->extra_charge, 0, ',', '.') }}</span>
                </div>
                @endif
                <div class="border-t pt-3 flex justify-between">
                    <span class="font-medium text-gray-900">Total</span>
                    <span class="font-bold text-lg text-green-600">Rp {{ number_format($booking->bookingDetail->total_price, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        {{-- Invoice Actions --}}
        <div class="bg-white rounded-lg shadow-sm border p-6 mb-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Invoice</h2>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('invoice.preview', $booking->id) }}" 
                   target="_blank"
                   class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                    Preview Invoice
                </a>
                
                <a href="{{ route('invoice', $booking->id) }}" 
                   target="_blank"
                   class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                    </svg>
                    Generate PDF
                </a>
                
                <a href="{{ route('invoice.download', $booking->id) }}" 
                   class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Download PDF
                </a>
            </div>
            
            <div class="mt-4 p-4 bg-blue-50 rounded-lg">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-blue-800">Informasi Invoice</h3>
                        <div class="mt-2 text-sm text-blue-700">
                            <p>• <strong>Preview:</strong> Melihat invoice dalam format HTML</p>
                            <p>• <strong>Generate PDF:</strong> Membuka invoice PDF di browser</p>
                            <p>• <strong>Download PDF:</strong> Mendownload file invoice PDF</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Navigation --}}
        <div class="flex justify-between">
            <a href="{{ url()->previous() }}" 
               class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali
            </a>
            
            @auth
            <a href="{{ route('my.bookings') }}" 
               class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
                My Bookings
            </a>
            @endauth
        </div>
    </div>
</div>
@endsection
