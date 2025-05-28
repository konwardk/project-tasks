<x-app-layout>
    <div class="max-w-4xl mx-auto py-8">
        <div class="flex items-center justify-between mb-6">
            <h1 class="font-bold text-gray-800">All Posts</h1>
            <a href="{{ route('posts.create') }}" class="px-4 py-2 bg-blue-600 text-dark rounded-lg hover:bg-blue-700 transition">
                + Create New
            </a>
        </div>

        @forelse($posts as $post)
            <div class="bg-white shadow-md rounded-lg p-6 mb-6">
                <h2 class="text-xl font-semibold text-gray-900">{{ $post->title }}</h2>
                <p class="text-gray-700 mt-2">{{ $post->body }}</p>
                <div class="mt-4 text-sm text-gray-500">
                    By <span class="font-medium">{{ $post->user->name }}</span>
                </div>
                <div class="mt-4 flex space-x-3">
                    <a href="{{ route('posts.edit', $post) }}" class="text-blue-600 hover:underline">Edit</a> | 
                    <form method="POST" action="{{ route('posts.destroy', $post) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Delete</button>
                    </form>
                </div>
            </div>
        @empty
            <p class="text-center text-gray-500">No posts found.</p>
        @endforelse
    </div>
</x-app-layout>
