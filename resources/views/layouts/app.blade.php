<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Mini Social</title>
    <style>
        :root {
            color-scheme: light;
            --bg: #f6f0e6;
            --panel: #fff9f0;
            --ink: #241a12;
            --accent: #d9534f;
            --accent-dark: #b13f3b;
            --muted: #7a6a5d;
            --border: #e7d9c8;
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: "Georgia", "Times New Roman", serif;
            color: var(--ink);
            background: radial-gradient(circle at top, #fff7ec 0%, var(--bg) 55%, #f0e6d8 100%);
            min-height: 100vh;
        }
        header {
            background: var(--panel);
            border-bottom: 1px solid var(--border);
            padding: 16px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        header h1 {
            margin: 0;
            font-size: 24px;
            letter-spacing: 1px;
            text-transform: uppercase;
        }
        header nav {
            display: flex;
            gap: 12px;
            align-items: center;
        }
        header nav span {
            font-size: 14px;
            color: var(--muted);
        }
        .container {
            max-width: 880px;
            margin: 32px auto;
            padding: 0 16px 64px;
        }
        .card {
            background: var(--panel);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 10px 30px rgba(36, 26, 18, 0.08);
        }
        label { display: block; font-weight: bold; margin-bottom: 8px; }
        input, textarea {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid var(--border);
            border-radius: 8px;
            font-size: 16px;
            font-family: inherit;
            background: #fff;
        }
        textarea { min-height: 120px; resize: vertical; }
        .btn {
            border: none;
            background: var(--accent);
            color: #fff;
            padding: 10px 16px;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
        }
        .btn:hover { background: var(--accent-dark); }
        .btn-secondary {
            background: transparent;
            color: var(--ink);
            border: 1px solid var(--border);
        }
        .btn-secondary:hover { background: #f2e7da; }
        .actions { display: flex; gap: 10px; flex-wrap: wrap; }
        .post-meta {
            display: flex;
            gap: 16px;
            align-items: center;
            font-size: 14px;
            color: var(--muted);
            margin-bottom: 8px;
        }
        .post-body { font-size: 17px; line-height: 1.6; }
        .error {
            background: #ffe4e4;
            border: 1px solid #f1b4b4;
            color: #7a2d2d;
            padding: 10px 12px;
            border-radius: 8px;
            margin-bottom: 12px;
        }
        .link {
            color: var(--ink);
            text-decoration: none;
            font-weight: bold;
        }
        .like-btn {
            background: #fff;
            color: var(--accent-dark);
            border: 1px solid var(--accent-dark);
        }
        .like-btn.liked {
            background: var(--accent);
            color: #fff;
            border-color: var(--accent);
        }
        @media (max-width: 720px) {
            header { flex-direction: column; gap: 12px; align-items: flex-start; }
            header nav { flex-wrap: wrap; }
        }
    </style>
</head>
<body>
    <header>
        <h1>Mini Social</h1>
        <nav>
            @auth
                <span>Signed in as {{ auth()->user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-secondary" type="submit">Logout</button>
                </form>
            @else
                <a class="link" href="{{ route('login') }}">Login</a>
                <a class="link" href="{{ route('register') }}">Register</a>
            @endauth
        </nav>
    </header>

    <main class="container">
        @yield('content')
    </main>


</body>
</html>
