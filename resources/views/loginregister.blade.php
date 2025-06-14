<x-app-layout>
  <div class="flex items-center justify-center min-h-screen bg-gray-50" id="app-container">
    <div class="max-w-4xl w-full bg-white rounded-2xl shadow-lg p-8">
      <h2 class="text-3xl font-semibold text-gray-700 text-center mb-8">Pengaturan Website</h2>

      <div class="space-y-6">
        <!-- Email Kontak -->
        <div>
          <label for="contact_email" class="block text-sm font-medium text-gray-700 mb-1">Email Kontak</label>
          <input type="email" id="contact_email" name="contact_email" value="support@getyourtrip.com"
                 class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" disabled>
        </div>

        <!-- Pilihan Bahasa -->
        <div>
          <label for="language" class="block text-sm font-medium text-gray-700 mb-1">Bahasa</label>
          <select id="language" name="language"
                  class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" disabled>
            <option value="id">Bahasa Indonesia</option>
            <option value="en">English</option>
          </select>
        </div>

        <!-- Pilihan Mode Tema -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Mode Tema</label>
          <div class="flex space-x-3">
            <button id="light-mode" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md shadow-sm">Light</button>
            <button id="dark-mode" class="px-4 py-2 bg-gray-800 text-white rounded-md shadow-sm">Dark</button>
          </div>
        </div>

        <!-- Tombol Simpan -->
        <div class="text-center">
          <button id="save-settings" class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-md shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
            Simpan Perubahan
          </button>
        </div>

        <!-- Info -->
        <div class="text-sm text-gray-500 italic text-center">
          *Pengaturan hanya bisa diubah oleh admin.
        </div>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const lightModeBtn = document.getElementById("light-mode");
      const darkModeBtn = document.getElementById("dark-mode");
      const appContainer = document.getElementById("app-container");
      const saveSettingsBtn = document.getElementById("save-settings");

      // Cek preferensi mode yang tersimpan
      if (localStorage.getItem("theme") === "dark") {
        document.documentElement.classList.add("dark");
        appContainer.classList.add("bg-gray-900", "text-white");
      }

      // Event listener untuk mode light
      lightModeBtn.addEventListener("click", function () {
        document.documentElement.classList.remove("dark");
        appContainer.classList.remove("bg-gray-900", "text-white");
        localStorage.setItem("theme", "light");
      });

      // Event listener untuk mode dark
      darkModeBtn.addEventListener("click", function () {
        document.documentElement.classList.add("dark");
        appContainer.classList.add("bg-gray-900", "text-white");
        localStorage.setItem("theme", "dark");
      });

      // Event listener untuk simpan perubahan
      saveSettingsBtn.addEventListener("click", function () {
        Swal.fire({
          icon: "success",
          title: "Perubahan Tersimpan!",
          text: "Pengaturan Anda telah berhasil disimpan.",
          showConfirmButton: false,
          timer: 1500
        });
      });
    });
  </script>
</x-app-layout>