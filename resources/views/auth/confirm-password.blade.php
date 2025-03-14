<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-[#2b2a6e] via-[#16222A] to-[#3a6073] py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl w-full bg-white rounded-xl shadow-lg overflow-hidden flex flex-col md:flex-row">
            <!-- Left Side -->
            <div class="md:w-1/2 bg-gradient-to-br from-[#3a6073] to-[#16222A] p-10 text-white flex flex-col justify-center">
                <h2 class="text-2xl font-bold mb-4">Confirm Password</h2>
                <p>This is a secure area of the application. Please confirm your password before continuing.</p>
            </div>

            <!-- Right Side (Confirm Password Form) -->
            <div class="md:w-1/2 p-8 bg-white">
                <!-- Session Status -->
                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="flex justify-center mb-6">
                    <div class="bg-[#1e3c72] rounded-full p-4">
                        <svg class="w-8 h-8 text-white" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M12 12c2.7 0 5-2.3 5-5s-2.3-5-5-5-5 2.3-5 5 2.3 5 5 5zm0 2c-3.3 0-10 1.7-10 5v3h20v-3c0-3.3-6.7-5-10-5z"/>
                        </svg>
                    </div>
                </div>

                <form method="POST" action="{{ route('password.confirm') }}">
                    @csrf

                    <!-- Password -->
                    <div>
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="flex justify-end mt-6">
                        <x-primary-button class="w-full bg-gradient-to-r from-[#2a5298] to-[#1e3c72] hover:from-[#3a70b0] hover:to-[#2a3a80]">
                            {{ __('Confirm') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
