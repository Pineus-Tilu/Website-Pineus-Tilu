@extends('layouts.app')

@section('content')
<div class="max-w-full overflow-hidden">
    @include('partials.fasilitas.hero-fasilitas-section', ['data' => $data])
    @include('partials.fasilitas.denah-fasilitas-section', ['data' => $data])
    @include('partials.fasilitas.fasilitas-fasilitas-section', ['data' => $data])
    @include('partials.fasilitas.harga-fasilitas-section', ['data' => $data])
    @if (!empty($data['galeri']) && count($data['galeri']))
        @include('partials.fasilitas.galeri-fasilitas-section', ['data' => $data])
    @endif
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