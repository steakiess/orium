<x-app-layout>
    <div class="py-4">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-white border-2 border-black overflow-hidden shadow-sm sm:rounded-lg p-8">
                <h1 class="text-2xl text-black mb-4 font-bold ">{{ $post->title }}</h1>

                {{-- User Profile --}}

                <div class="flex gap-4">
                    <x-user-profile :user="$post->user" />

                    {{-- Profile Section --}}

                    <div class="text-black">
                        <x-follow-ctr :user="$post->user" class="flex gap-2">
                            <a href="{{ route('profile.show', $post->user) }}"
                                class="hover:underline">{{ $post->user->name }}</a>

                            @auth


                                @if (!auth()->user()->is($post->user))
                                    &middot;
                                    <a href="#" x-text="following ? 'UnFollow' : 'Follow'" @click="follow()"
                                        :class="following ? 'text-red-500 hover:underline' : 'text-emerald-500 hover:underline'">

                                    </a>
                                @endif

                            @endauth
                        </x-follow-ctr>
                        <div class="flex gap-2 text-gray-400 text-sm">
                            {{ $post->readTime() }} min read
                            &middot;
                            {{ $post->published_at}}
                        </div>

                    </div>

                </div>

                {{-- Like Section --}}
                @if ($post->user_id === Auth::id())
                    <div class="py-4 mt-8 border-t border-b border-black">

                        <x-primary-button href="{{ route('post.edit', $post->slug) }}">
                            Edit Post
                        </x-primary-button>



                        <form class="inline-block" action="{{ route('post.delete', $post) }}" method="post">
                            @csrf
                            @method('delete')

                            <x-danger-button>
                                Delete Post
                            </x-danger-button>
                        </form>

                    </div>
                @endif



                <x-clap-button :post="$post">

                </x-clap-button>


                {{-- Content Section --}}
                <div class="mt-4">
                    <img src="{{ $post->imageUrl() }}" alt="{{ $post->title }}"
                        class="w-full h-full object-cover rounded-lg">

                    <div class="mt-4 text-black">
                        <p>{{ $post->content }}</p>
                    </div>
                </div>

                <div class="mt-8 text-black">
                    <span class="px-4 py-2 bg-gray-500 rounded-lg">
                        {{ $post->category->name }}
                    </span>
                </div>


            </div>
        </div>
    </div>

</x-app-layout>
