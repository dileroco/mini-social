@extends('layouts.app')

@section('content')
    <div class="card">
        <h2>Edit post</h2>

        @if ($errors->any())
            <div class="error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('posts.update', $post) }}">
            @csrf
            @method('PUT')
            <label for="body">Your post</label>
            <textarea id="body" name="body">{{ old('body', $post->body) }}</textarea>
            <div class="actions" style="margin-top: 12px;">
                <button class="btn" type="submit">Save changes</button>
                <a class="btn btn-secondary" href="{{ route('posts.index') }}">Cancel</a>
            </div>
        </form>
    </div>
@endsection
