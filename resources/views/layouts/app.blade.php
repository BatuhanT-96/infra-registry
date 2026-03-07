<!doctype html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Envanter Yönetimi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f5f7fb; }
        .sidebar { min-height: 100vh; background: #0f172a; }
        .sidebar a { color: #cbd5e1; }
        .sidebar a.active, .sidebar a:hover { color: #fff; background: #1e293b; border-radius: .5rem; }
        .card-stat { border: none; box-shadow: 0 0.5rem 1.2rem rgba(15, 23, 42, .06); }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <aside class="col-md-2 p-3 sidebar">
            <h5 class="text-white mb-4">Envanter Paneli</h5>
            <nav class="nav flex-column gap-1">
                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">Dashboard</a>
                <a class="nav-link {{ request()->routeIs('applications.*') ? 'active' : '' }}" href="{{ route('applications.index') }}">Uygulamalar</a>
                <a class="nav-link {{ request()->routeIs('servers.*') ? 'active' : '' }}" href="{{ route('servers.index') }}">Sunucular</a>
                @if(auth()->user()?->isAdmin())
                    <a class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}">Kullanıcı Yönetimi</a>
                @endif
            </nav>
            <form action="{{ route('logout') }}" method="POST" class="mt-4">
                @csrf
                <button class="btn btn-outline-light btn-sm w-100">Çıkış Yap</button>
            </form>
        </aside>
        <main class="col-md-10 p-4">
            @if(session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @yield('content')
        </main>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
