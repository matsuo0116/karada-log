<x-guest-layout>
    <h2>新規登録</h2>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="form_item">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2 error_message" />
        </div>

        <!-- Email Address -->
        <div class="form_item">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 error_message"  />
        </div>

        <!-- Password -->
        <div class="form_item">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2 error_message" />
        </div>

        <!-- Confirm Password -->
        <div class="form_item">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 error_message" />
        </div>

        <div class="flex items-center justify-end mt-4">
            

            <x-primary-button class="green_btn">
                {{ __('Register') }}
            </x-primary-button>
            <a class="login_link underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>
        </div>
    </form>
</x-guest-layout>
