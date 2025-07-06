@extends('layouts.app')

@section('title', $data['title'] . ' - Pineus Tilu')

@section('content')
<div class="max-w-full overflow-hidden">
    @include('partials.fasilitas.hero-fasilitas-section', ['data' => $data])
    @include('partials.fasilitas.denah-fasilitas-section', ['data' => $data])
    @include('partials.fasilitas.fasilitas-fasilitas-section', ['data' => $data])
    @include('partials.fasilitas.harga-fasilitas-section', ['data' => $data])
    
    {{-- SELALU TAMPILKAN GALERI SECTION TANPA KONDISI --}}
    @include('partials.fasilitas.galeri-fasilitas-section', ['data' => $data])
    
    @include('partials.fasilitas.reservasi-fasilitas-section')
</div>

<!-- Add custom styles for better interaction -->
<style>
    .modal-image {
        cursor: grab;
    }
    .modal-image:active {
        cursor: grabbing;
    }
    .modal-image.zoomed {
        cursor: move;
    }
</style>
@endsection