<x-app-layout>
    <div class="max-w-4xl mx-auto py-8">
        <div class="flex items-center justify-between mb-6">
            <h1 class="font-bold">All Posts</h1>
            <a href="{{ route('posts.create') }}" class="px-4 py-2">
                + Create New
            </a>
        </div>

        @forelse($posts as $post)
            <div class="p-6 mt-6 border shadow-sm bg-white">
                <h2 class="text-xl">{{ $post->title }}</h2>
                <p class=" mt-2">{{ $post->body }}</p>
                
                <div class="mt-4 flex space-x-3">
                    <a href="{{ route('posts.edit', $post) }}">Edit</a> | 
                    <form method="POST" action="{{ route('posts.destroy', $post) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </div>
            </div>
        @empty
            <p class="text-center">No posts found.</p>
        @endforelse
    </div>
</x-app-layout>
