<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-[#2b2a6e] via-[#16222A] to-[#3a6073] py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl w-full bg-white rounded-xl shadow-lg overflow-hidden flex flex-col md:flex-row">
            <!-- Left Side -->
            <div class="md:w-1/2 bg-gradient-to-br from-[#3a6073] to-[#16222A] p-10 text-white flex flex-col justify-center">
                <h2 class="text-2xl font-bold mb-4">Forgot Password?</h2>
                <p>Enter your registered email address and we’ll send you a link to reset your password.</p>
            </div>

            <!-- Right Side (Reset Password Form) -->
            <div class="md:w-1/2 p-8 bg-white">
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <div class="flex justify-center mb-6">
                    <div class="bg-[#1e3c72] rounded-full p-4">
                        <svg class="w-8 h-8 text-white" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M12 12c2.7 0 5-2.3 5-5s-2.3-5-5-5-5 2.3-5 5 2.3 5 5 5zm0 2c-3.3 0-10 1.7-10 5v3h20v-3c0-3.3-6.7-5-10-5z"/>
                        </svg>
                    </div>
                </div>

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <x-primary-button class="w-full bg-gradient-to-r from-[#2a5298] to-[#1e3c72] hover:from-[#3a70b0] hover:to-[#2a3a80]">
                            {{ __('Send Password Reset Link') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
