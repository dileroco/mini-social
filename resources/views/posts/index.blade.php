@extends('layouts.app')

@section('content')
    <div class="card">
        <h2>New post</h2>

        @if ($errors->any())
            <div class="error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('posts.store') }}">
            @csrf
            <label for="body">What is on your mind?</label>
            <textarea id="body" name="body" placeholder="Share something...">{{ old('body') }}</textarea>
            <div style="margin-top: 12px;">
                <button class="btn" type="submit">Publish</button>
            </div>
        </form>
    </div>

    @foreach ($posts as $post)
        <div class="card" data-post="{{ $post->id }}">
            <div class="post-meta">
                <strong>{{ $post->user->name }}</strong>
                <span>{{ $post->created_at->diffForHumans() }}</span>
                <span class="like-count">
                    {{ $post->likes()->count() }} like{{ $post->likes()->count() === 1 ? '' : 's' }}
                </span>
            </div>
            <div class="post-body">{{ $post->body }}</div>
            <div class="actions" style="margin-top: 12px;">
                <form method="POST" action="{{ route('posts.like', $post) }}">
                    @csrf
                    <button class="btn {{ $post->liked_by_me ? 'liked' : '' }}" type="submit">
                        {{ $post->liked_by_me ? 'Liked' : 'Like' }}
                    </button>
                </form>
                @can('update', $post)
                    <a class="btn btn-secondary" href="{{ route('posts.edit', $post) }}">Edit</a>
                @endcan
                @can('delete', $post)
                    <form method="POST" action="{{ route('posts.destroy', $post) }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-secondary" type="submit">Delete</button>
                    </form>
                @endcan
            </div>
        </div>
    @endforeach
@endsection