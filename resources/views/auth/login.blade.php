@extends('layouts.app')

@section('content')
    <div class="card">
        <h2>Welcome back</h2>

        @if ($errors->any())
            <div class="error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login.submit') }}">
            @csrf
            <div style="margin-bottom: 12px;">
                <label for="email">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required>
            </div>
            <div style="margin-bottom: 18px;">
                <label for="password">Password</label>
                <input id="password" name="password" type="password" required>
            </div>
            <div class="actions">
                <button class="btn" type="submit">Login</button>
                <a class="btn btn-secondary" href="{{ route('register') }}">Create an account</a>
            </div>
        </form>
    </div>
@endsection
