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

                    <div class="flex-1 pr-8">

                        <h1 class="text-xl">{{ $user->name }}</h1>

                        <div class="mt-8">
                            @forelse ($posts as $post)
                                <x-post-item :post="$post"></x-post-item>
                            @empty
                                <div class="text-center text-gray-400 py-16">
                                    <p class=" ">No posts found.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    {{-- SIDEBAR --}}
                   <x-follow-ctr :user="$user">
                        <x-user-profile :user="$user" size="w-24 h-24" />
                        <h3 class="mt-2">{{ $user->name }}</h3>
                        <p class="text-gray-400">
                            <span x-text="followers"></span> 
                                followers
                        </p>
                        <p class="">{{ $user->bio }}</p>

                        @if (auth()->user() && !auth()->user()->is($user))
                            <div class="mt-4">
                                <button @click="follow()" class="rounded-full px-4 py-2"
                                    x-text=" following ? 'Unfollow' : 'Follow' "
                                    :class="following ? 'bg-red-700 hover:bg-red-800' : 'bg-emerald-700 hover:bg-emereald-700'">
                                    ">
                                </button>
                            </div>
                        @endif
                    </x-follow-ctr>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
