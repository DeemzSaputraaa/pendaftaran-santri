<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') — Pesantren CMI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background: #f0f2f5; }
        .sidebar { width: 260px; height: 100vh; position: fixed; top: 0; left: 0; overflow-y: auto; background: #1a2332; transition: left .3s; z-index: 1040; }
        .sidebar .brand { padding: 1.25rem 1.5rem; border-bottom: 1px solid rgba(255,255,255,.08); }
        .sidebar .brand-icon { width: 36px; height: 36px; border-radius: 10px; background: linear-gradient(135deg, #0d6efd, #0dcaf0); display: flex; align-items: center; justify-content: center; color: #fff; font-weight: 700; font-size: .8rem; }
        .sidebar .nav-label { font-size: .7rem; text-transform: uppercase; letter-spacing: .1em; color: rgba(255,255,255,.3); padding: .75rem 1.5rem .5rem; font-weight: 600; }
        .sidebar .nav-link { color: rgba(255,255,255,.6); padding: .6rem 1.5rem; font-size: .875rem; font-weight: 500; display: flex; align-items: center; gap: .75rem; transition: all .2s; border-left: 3px solid transparent; }
        .sidebar .nav-link:hover { color: #fff; background: rgba(255,255,255,.05); }
        .sidebar .nav-link.active { color: #fff; background: rgba(13,110,253,.15); border-left-color: #0d6efd; }
        .sidebar .nav-link.active i { color: #4facfe; }
        .sidebar .nav-link i { font-size: 1.1rem; width: 20px; text-align: center; }
        .topbar { background: #fff; border-bottom: 1px solid #e5e7eb; padding: 1rem 2rem; }
        .main-content { padding: 2rem; }
        .sidebar-footer { padding: 1rem 1.5rem; border-top: 1px solid rgba(255,255,255,.08); margin-top: auto; }
        .main-wrapper { margin-left: 260px; min-height: 100vh; display: flex; flex-direction: column; width: calc(100% - 260px); transition: margin-left .3s, width .3s; }
        @media (max-width: 768px) {
            .sidebar { left: -260px; z-index: 1050; }
            .sidebar.show { left: 0; }
            .main-wrapper { margin-left: 0; width: 100%; }
        }
    </style>
</head>
<body>
    <!-- Sidebar Admin -->
    <aside class="sidebar d-flex flex-column flex-shrink-0" id="sidebar">
        <div class="brand d-flex align-items-center gap-3">
            <div class="brand-icon">ADM</div>
            <div>
                <div class="text-white fw-bold" style="font-size:.9rem">Admin Panel</div>
                <div style="font-size:.65rem; color:rgba(255,255,255,.4)">Pesantren CMI</div>
            </div>
        </div>

        <div class="nav-label">Kelola</div>
        <nav class="nav flex-column">
            <a href="/admin" class="nav-link {{ request()->is('admin') && !request()->is('admin/*') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
            <a href="/admin/pendaftar" class="nav-link {{ request()->is('admin/pendaftar*') || request()->is('admin/verifikasi*') || request()->is('admin/seleksi*') ? 'active' : '' }}">
                <i class="bi bi-people-fill"></i> Data Pendaftar
            </a>
        </nav>

        <div class="sidebar-footer">
            <div class="d-flex align-items-center gap-2 mb-3" style="color:rgba(255,255,255,.5); font-size:.8rem">
                <i class="bi bi-shield-lock-fill" style="font-size:1.5rem"></i>
                <div>
                    <div class="text-white fw-semibold" style="font-size:.85rem">{{ auth()->user()->name }}</div>
                    <div style="font-size:.7rem; color:rgba(255,255,255,.4);">Administrator</div>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-danger w-100">
                    <i class="bi bi-box-arrow-left me-1"></i> Keluar
                </button>
            </form>
        </div>
    </aside>

    <div class="main-wrapper">
        <header class="topbar d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-3">
                <button class="btn btn-sm btn-light d-md-none" onclick="document.getElementById('sidebar').classList.toggle('show')">
                    <i class="bi bi-list"></i>
                </button>
                <h5 class="mb-0 fw-bold text-dark">@yield('header')</h5>
            </div>
            <span class="badge bg-light text-dark border"><i class="bi bi-shield-lock-fill me-1 text-primary"></i> {{ auth()->user()->name }}</span>
        </header>

        <main class="main-content flex-grow-1">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4"><i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show mb-4"><i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
            @endif
            @yield('content')
        </main>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
