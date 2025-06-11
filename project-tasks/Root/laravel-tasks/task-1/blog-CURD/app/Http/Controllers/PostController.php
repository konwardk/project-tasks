<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//use the Post model
use App\Models\Post;

class PostController extends Controller
{

    // function for tha home page with user
    public function index()
    {
        $posts = Post::with('user')->latest()->get();

        // dd(auth()->id());

        return view('posts.index', compact('posts'));
    }

    // function for the create page
    public function create()
    {
        return view('posts.createNewBlog');
    }

    //function for storing blog post
    public function store(Request $request)
    {
        $user = $request->user();
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        Post::create([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => $user->id,
        ]);

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    // function for the edit page
    public function edit(Post $post)
    {
        return view('posts.editBlog', compact('post'));
    }

    // function for updating blog post
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $post->update([
            'title' => $request->title,
            'body' => $request->body,
        ]);

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    // function for deleting blog post
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
}
