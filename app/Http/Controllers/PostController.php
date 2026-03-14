<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
 
class PostController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();

        $posts = Post::query()
            ->with('user')
            ->withCount('likes')
            ->withExists([
                'likes as liked_by_me' => function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                },
            ])
            ->latest()
            ->get();

        return view('posts.index', [
            'posts' => $posts,
            'user' => $user,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'body' => ['required', 'string', 'max:1000'],
        ]);

        $request->user()->posts()->create([
            'body' => trim($validated['body']),
        ]);

        return redirect()->route('posts.index');
    }

    public function edit(Post $post): View
    {
        $this->authorize('update', $post);

        return view('posts.edit', [
            'post' => $post,
        ]);
    }

    public function update(Request $request, Post $post): RedirectResponse
    {
        $this->authorize('update', $post);

        $validated = $request->validate([
            'body' => ['required', 'string', 'max:1000'],
        ]);

        $post->update([
            'body' => trim($validated['body']),
        ]);

        return redirect()->route('posts.index');
    }

    public function destroy(Request $request, Post $post): RedirectResponse
    {
        $this->authorize('delete', $post);

        $post->delete();

        

        return redirect()->route('posts.index');
    }
}
