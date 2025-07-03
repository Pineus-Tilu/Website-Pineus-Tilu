<!-- Hero Section -->
<section class="relative h-[400px] pt-[120px] flex items-center justify-center" data-aos="fade-down">
    <img src="{{ asset('images/' . $data['hero']) }}" alt="{{ $data['title'] }}"
        class="absolute top-0 left-0 z-0 object-cover w-full h-full">
    <div class="absolute inset-0 bg-black bg-opacity-30"></div>
    <div class="relative z-10 flex flex-col items-center justify-center w-full h-full px-4">
        <h1 class="text-4xl font-bold text-center text-white md:text-5xl lg:text-6xl jp-brush drop-shadow-2xl">
            {{ strtoupper($data['title']) }}
        </h1>
        <div class="w-24 h-1 mt-4 bg-green-500"></div>
    </div>
</section>