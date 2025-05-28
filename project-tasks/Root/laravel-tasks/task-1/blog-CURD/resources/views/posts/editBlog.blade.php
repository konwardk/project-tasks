<x-app-layout>


    <div class="container">
    <h2>Edit Blog Post</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('posts.update', $post->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}" required
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
            </div>

            <div>
                <label for="body" class="block text-sm font-medium text-gray-700">Body</label>
                <textarea name="body" id="body" rows="5" required
                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">{{ old('body', $post->body) }}</textarea>
            </div>

            <div class="flex items-center space-x-4">
                <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-dark border font-semibold rounded hover:bg-blue-700 transition">
                    Update
                </button>
                <a href="{{ route('posts.index') }}"
                   class="px-4 py-2 bg-gray-300 text-gray-800 border font-semibold rounded hover:bg-gray-400 transition">
                    Cancel
                </a>
            </div>
        </form>

    
</div>

    
</x-app-layout>


