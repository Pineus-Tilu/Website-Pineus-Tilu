<!-- update-profile-information-form.blade.php -->
<section>
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" class="text-[#006C43] font-semibold" />
            <x-text-input
                id="name"
                name="name"
                type="text"
                class="mt-2 block w-full bg-gray-50 border-2 border-[#006C43]/20 focus:border-[#006C43] focus:ring-[#006C43] rounded-xl shadow-sm"
                :value="old('name', $user->name)"
                required
                autofocus
                autocomplete="name"
            />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>        
            <x-input-label for="email" :value="__('Email')" class="text-[#006C43] font-semibold" />
            <x-text-input
                id="email"
                name="email"
                type="{{ $isGoogleUser ? 'hidden' : 'email' }}"
                class="mt-2 block w-full bg-gray-50 border-2 border-[#006C43]/20 focus:border-[#006C43] focus:ring-[#006C43] rounded-xl shadow-sm"
                :value="old('email', $user->email)"
                required
                autocomplete="username"
            />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($isGoogleUser)
                <p class="text-sm text-gray-600 mt-2 font-typewriter bg-yellow-50 p-3 rounded-lg border border-yellow-200">
                    {{ __('You are logged in using a Google account. Email cannot be changed.') }}
                </p>
            @endif

            @if (!$isGoogleUser && $user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-4 p-4 bg-yellow-50 rounded-xl border border-yellow-200">
                    <p class="text-sm text-yellow-800 font-typewriter">
                        {{ __('Your email address is unverified.') }}
                        <button form="send-verification"
                                class="underline text-sm text-[#006C43] hover:text-[#00844D] font-semibold">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button type="submit" class="bg-gradient-to-r from-[#006C43] via-[#00844D] to-[#005A36] text-white px-6 py-3 rounded-xl font-semibold hover:opacity-90 transform hover:scale-105 transition-all duration-200 shadow-lg">
                {{ __('Save') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600 font-typewriter bg-green-50 px-3 py-2 rounded-lg"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>