<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::latest();

        if ($request->has('category')) {
            $query->where('category', $request->category);
        }

        $posts = $query->paginate(6);
        $categories = Post::select('category')->distinct()->whereNotNull('category')->get();

        return view('blog.index', compact('posts', 'categories'));
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)->with(['comments' => function($query) {
            $query->where('is_approved', true)->latest();
        }])->firstOrFail();
        
        $post->increment('views');
        
        $relatedPosts = Post::where('category', $post->category)
            ->where('id', '!=', $post->id)
            ->limit(3)
            ->get();

        return view('blog.show', compact('post', 'relatedPosts'));
    }

    public function comment(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'comment' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $post = Post::findOrFail($id);
        $post->comments()->create($request->all());

        return back()->with('success', 'Your comment has been submitted and is awaiting approval.');
    }
}
