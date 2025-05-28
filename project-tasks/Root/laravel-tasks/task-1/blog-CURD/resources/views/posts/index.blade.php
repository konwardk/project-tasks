<h1>All Posts</h1>
<a href="{{ route('posts.create') }}">Create New</a>
@foreach($posts as $post)
    <div>
        <h2>{{ $post->title }}</h2>
        <p>{{ $post->body }}</p>
        <small>By {{ $post->user->name }}</small>
        <a href="{{ route('posts.edit', $post) }}">Edit</a>
        <form method="POST" action="{{ route('posts.destroy', $post) }}">
            @csrf @method('DELETE')
            <button type="submit">Delete</button>
        </form>
    </div>
@endforeach
