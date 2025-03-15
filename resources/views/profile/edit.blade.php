<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight text-center">
            {{ __('Pengaturan Akun') }}
        </h2>
    </x-slot>

    <div class="flex items-center justify-center min-h-screen bg-gradient-to-br from-blue-50 to-yellow-50">
        <div class="max-w-4xl w-full bg-white dark:bg-gray-800 shadow-xl rounded-2xl overflow-hidden p-8">
            <!-- Header Profile -->
            <div class="flex items-center justify-between mb-8">
                <div class="flex items-center space-x-4">
                    <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}" alt="Avatar"
                         class="w-14 h-14 rounded-full object-cover border">
                    <div>
                        <h3 class="text-xl font-semibold text-gray-800 dark:text-white">{{ Auth::user()->name }}</h3>
                        <p class="text-gray-500 dark:text-gray-400 text-sm">Email: {{ Auth::user()->email }}</p>
                    </div>
                </div>
                <button class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-5 py-2 rounded-lg">
                    Edit
                </button>
            </div>

            <!-- Profile Info -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Update Info -->
                <div class="bg-white dark:bg-gray-700 rounded-xl p-6 shadow-md border">
                    <h4 class="text-lg font-semibold text-gray-700 dark:text-white mb-4">Informasi Profil</h4>
                    @include('profile.partials.update-profile-information-form')
                </div>

                <!-- Update Password -->
                <div class="bg-white dark:bg-gray-700 rounded-xl p-6 shadow-md border">
                    <h4 class="text-lg font-semibold text-gray-700 dark:text-white mb-4">Ubah Password</h4>
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Delete Account -->
            <div class="bg-red-50 dark:bg-gray-900 mt-8 p-6 rounded-xl shadow-md border border-red-200 dark:border-gray-700">
                <h4 class="text-lg font-semibold text-red-600 dark:text-red-400 mb-4">Hapus Akun</h4>
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>
