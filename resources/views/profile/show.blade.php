<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg text-white">
                <div class="flex">
                    <div class="flex-1">

                    </div>

                    {{-- SIDEBAR --}}
                    <div class="w-[320px] border-l px-8">
                        <x-user-profile :user="$user" size="w-24 h-24" />
                        <h3 class="mt-2">{{ $user->name }}</h3>
                        <p class="text-gray-400">25k followers</p>
                        <p class="">{{ $user->bio }}</p>
                        
                        @if (!Auth::user()->is($user))
                            <div class="mt-4">
                                <button class="bg-emerald-600 rounded-full px-4 py-2 hover:bg-emerald-700">
                                    Follow
                                </button>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
