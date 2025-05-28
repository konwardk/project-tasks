<x-app-layout>
    
    <div class="max-w-2xl mx-auto p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Write a New Blog</h2>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="{{ route('posts.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Post Title</label>
                <input type="text" name="title" id="title" required
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
            </div>

            <div>
                <label for="body" class="block text-sm font-medium text-gray-700">Body</label>
                <textarea name="body" id="body" rows="5" required
                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"></textarea>
            </div>

            <div class="flex items-center space-x-4">
                <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-dark border font-semibold rounded hover:bg-blue-700 transition">
                    Create
                </button>
                <a href="{{ route('posts.index') }}"
                   class="px-4 py-2 bg-gray-300 text-gray-800 border font-semibold rounded hover:bg-gray-400 transition">
                    Back to All Posts
                </a>
            </div>
        </form>
    </div>
</x-app-layout>
