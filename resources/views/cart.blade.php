<x-app-layout>
  <div class="py-20 bg-gray-50 min-h-screen">
    <div class="max-w-5xl mx-auto px-6">
      
      <!-- Judul -->
      <div class="flex items-center justify-center mb-8">
        <!-- Icon keranjang -->
        <svg class="w-10 h-10 text-blue-600 mr-2" fill="none" stroke="currentColor" stroke-width="2"
             viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round"
                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-1.293 2.293a1 1 0 00.217 1.32l.09.068a1 1 0 001.32-.217L9 15h6l1.293 1.464a1 1 0 001.32.217l.09-.068a1 1 0 00.217-1.32L17 13M9 21h.01M15 21h.01"/>
        </svg>
        <h2 class="text-3xl font-bold text-gray-700">Keranjang Anda</h2>
      </div>

      <!-- Tabel Kosong -->
      <div class="bg-white shadow-md rounded-lg overflow-x-auto">
        <table class="min-w-full table-auto">
          <thead class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
            <tr>
              <th class="py-3 px-6 text-left">Paket</th>
              <th class="py-3 px-6 text-left">Harga</th>
              <th class="py-3 px-6 text-center">Jumlah</th>
              <th class="py-3 px-6 text-center">Subtotal</th>
              <th class="py-3 px-6 text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td colspan="5" class="py-10 text-center text-gray-400">
                <p class="text-lg mb-4">Keranjang Anda masih kosong.</p>
                <a href="/tour" class="inline-block text-blue-600 hover:underline text-sm">
                  Lihat Paket Wisata
                </a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

    </div>
  </div>
</x-app-layout>
