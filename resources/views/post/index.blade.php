<x-app-layout>
    <div class="py-4">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-2 border-black">
                <div class="p-4 text-gray-900 dark:text-gray-100">
                    <!-- User Stories Section -->
                    <div class="mb-6 pb-4 border-b-2 border-gray-200">
                        <div class="flex overflow-x-auto gap-4 pb-2 scrollbar-hide">
                            @foreach ($users as $user)
                                <a href="{{ route('profile.show', $user->username) }}"
                                    class="flex-shrink-0 flex flex-col items-center group">
                                    <div class="relative">
                                        <!-- Gradient Ring -->
                                        <div
                                            class="w-16 h-16 rounded-full bg-gradient-to-tr from-black via-black to-black p-[2px]">
                                            <!-- White padding -->
                                            <div class="w-full h-full bg-white rounded-full p-[2px]">
                                                <!-- User Avatar -->
                                                <img src="{{ $user->imageUrl() }}" alt="{{ $user->name }}"
                                                    class="w-full h-full rounded-full object-cover">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Username -->
                                    <span
                                        class="text-xs mt-1 text-black dark:text-black text-center max-w-[70px] truncate group-hover:text-pink-500 transition">
                                        {{ $user->name }}
                                    </span>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- Category Tabs -->
                    <x-category-tabs>
                        No Categories
                    </x-category-tabs>
                </div>
            </div>

            <!-- Posts Section -->
            <div class="mt-8 dark:text-gray-100 text-gray-900">
                @forelse ($posts as $post)
                    <x-post-item :post="$post"></x-post-item>
                @empty
                    <div>
                        <p class="text-center text-gray-400">No posts found.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div>
                {{ $posts->links() }}
            </div>
        </div>
    </div>

    <!-- Add custom CSS for hiding scrollbar -->
    <style>
        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
    </style>
</x-app-layout>
