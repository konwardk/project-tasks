<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//use the Post model
use App\Models\Post;

use App\Models\User;



class PostController extends Controller
{
    //

    // index function for tha home page with user
    public function index()
    {
        $posts = Post::with('user')->latest()->get();

        // dd(auth()->id());

        return view('posts.index', compact('posts'));
    }

    // create function for the create page
    public function create()
    {
        return view('posts.createNewBlog');
    }

    //store function for storing blog post
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        Post::create([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => auth()?->id(),
        ]);

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    // edit function for the edit page
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    // update function for updating blog post
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

    // destroy function for deleting blog post
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
}
