<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Delete Account') }}
        </h2>

        {{--<p class="mt-1 text-sm text-gray-600">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>--}}
    </header>

    

    
    <div id="app" v-cloak>
    <x-danger-button v-on:click="modalOpen" class="red_btn" x-data="">{{ __('Delete Account') }}</x-danger-button>
    <div v-show="modal" class="window delete_confirm">
        <div v-on:click="modalClose" class="window_bg"></div>
        <div class="window_content">
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Password') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="error_message" />
            </div>

            <div class="mt-6 flex justify-end">
            <x-danger-button class="ml-3 red_btn">
                    {{ __('Delete Account') }}
                </x-danger-button>
                <x-secondary-button v-on:click="modalClose" x-on:click="$dispatch('close')" class="green_btn">
                    {{ __('Cancel') }}
                </x-secondary-button>

                
            </div>
        </form>
        </div>
    
    </div>
    
    </div>
    <!-- <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable> -->
    <!-- </x-modal> -->
</section>
