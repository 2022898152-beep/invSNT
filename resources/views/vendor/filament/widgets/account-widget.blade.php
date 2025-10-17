<x-filament::widget class="filament-account-widget">
    <x-filament::card>
        @php
            $user = \Filament\Facades\Filament::auth()->user();
        @endphp

        <div class="flex items-center space-x-4 rtl:space-x-reverse">
            <div class="bg-gradient-to-br from-primary-600 to-primary-800 p-1.5 rounded-full shadow-lg">
                <x-filament::user-avatar :user="$user" class="h-10 w-10 border-2 border-white" />
            </div>

            <div>
                <h2 class="text-lg font-bold tracking-tight text-gray-900 sm:text-xl">
                    {{ __('filament::widgets/account-widget.welcome', ['user' => \Filament\Facades\Filament::getUserName($user)]) }}
                </h2>

                <form
                    action="{{ route('filament.auth.logout') }}"
                    method="post"
                    class="text-sm mt-1"
                >
                    @csrf

                    <button
                        type="submit"
                        class="text-gray-600 outline-none hover:text-primary-600 focus:underline inline-flex items-center transition-colors duration-200"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd" />
                        </svg>
                        {{ __('filament::widgets/account-widget.buttons.logout.label') }}
                    </button>
                </form>
            </div>
        </div>
    </x-filament::card>
</x-filament::widget>
