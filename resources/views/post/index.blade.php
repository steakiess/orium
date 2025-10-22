<x-app-layout>



    <div class="py-4">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-2 border-black">
                <div class="p-4 text-gray-900 dark:text-gray-100">
                    <x-category-tabs>
                        No Categories
                    </x-category-tabs>
                </div>
            </div>

            <div class=" mt-8 dark:text-gray-100 text-gray-900">
                @forelse ($posts as $post)
                    <x-post-item :post="$post"></x-post-item>
                @empty
                    <div>
                        <p class="text-center text-gray-400">No posts found.</p>
                    </div>
                @endforelse

            </div>

            <div>
                {{ $posts->links() }}
            </div>


        </div>
    </div>
    </div>
</x-app-layout>
