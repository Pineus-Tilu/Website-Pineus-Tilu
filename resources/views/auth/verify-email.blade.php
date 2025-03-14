<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-[#2b2a6e] via-[#16222A] to-[#3a6073] py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl w-full bg-white rounded-xl shadow-lg overflow-hidden flex flex-col md:flex-row">
            <!-- Left Side -->
            <div class="md:w-1/2 bg-gradient-to-br from-[#3a6073] to-[#16222A] p-10 text-white flex flex-col justify-center">
                <h2 class="text-2xl font-bold mb-4">Verify Your Email</h2>
                <p>To activate your account, please check your email inbox and click on the verification link we've sent you.</p>
            </div>

            <!-- Right Side (Verification Message and Actions) -->
            <div class="md:w-1/2 p-8 bg-white">
                <div class="flex justify-center mb-6">
                    <div class="bg-[#1e3c72] rounded-full p-4">
                        <svg class="w-8 h-8 text-white" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.89 2 1.99 2H20c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                        </svg>
                    </div>
                </div>

                <div class="mb-4 text-sm text-gray-600">
                    {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                </div>

                @if (session('status') == 'verification-link-sent')
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                    </div>
                @endif

                <div class="mt-4 flex items-center justify-between">
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <x-primary-button class="bg-gradient-to-r from-[#2a5298] to-[#1e3c72] hover:from-[#3a70b0] hover:to-[#2a3a80]">
                            {{ __('Resend Verification Email') }}
                        </x-primary-button>
                    </form>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Log Out') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
