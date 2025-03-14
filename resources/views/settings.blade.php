<x-app-layout>
  <div class="py-16 bg-gray-50 min-h-screen">
    <div class="max-w-4xl mx-auto px-6">
      <h2 class="text-3xl font-semibold text-gray-700 text-center mb-8">Pengaturan Website</h2>

      <div class="bg-white rounded-lg shadow-md p-6 space-y-6">
        <!-- Contoh: Ganti Nama Website -->
        <div>
          <label for="site_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Website</label>
          <input type="text" id="site_name" name="site_name" value="GetYourTrip.com"
                 class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" disabled>
        </div>

        <!-- Contoh: Ganti Email Kontak -->
        <div>
          <label for="contact_email" class="block text-sm font-medium text-gray-700 mb-1">Email Kontak</label>
          <input type="email" id="contact_email" name="contact_email" value="support@getyourtrip.com"
                 class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" disabled>
        </div>

        <!-- Contoh: Ganti Bahasa (non-aktif, placeholder) -->
        <div>
          <label for="language" class="block text-sm font-medium text-gray-700 mb-1">Bahasa</label>
          <select id="language" name="language"
                  class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" disabled>
            <option value="id">Bahasa Indonesia</option>
            <option value="en">English</option>
          </select>
        </div>

        <!-- Info -->
        <div class="text-sm text-gray-500 italic">
          *Pengaturan hanya bisa diubah oleh admin.
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
