<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('page-title', 'Dashboard Direktur - SIM RS')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            background: #f1f6ff;
            font-family: Arial, sans-serif;
            color: #183153;
        }

        .sidebar {
            width: 210px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: linear-gradient(180deg, #1877f2, #0860d5);
            color: white;
            z-index: 1000;
        }

        .brand {
            height: 90px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            gap: 5px;
            border-bottom: 1px solid rgba(255,255,255,.15);
        }

        .brand i { font-size: 27px; }
        .brand span { font-size: 19px; font-weight: bold; }

        .sidebar-menu { padding: 20px 10px; }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 12px 15px;
            margin-bottom: 8px;
            border-radius: 11px;
            color: white;
            text-decoration: none;
            font-size: 14px;
            transition: .2s;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background: rgba(255,255,255,.22);
        }

        .main-wrapper {
            margin-left: 210px;
            min-height: 100vh;
        }

        .topbar {
            height: 62px;
            background: white;
            padding: 0 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #e4ebf6;
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .topbar-title {
            font-size: 15px;
            font-weight: 600;
            margin: 0;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-avatar {
            width: 33px;
            height: 33px;
            background: #dceaff;
            color: #1673ed;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            font-size: 16px;
        }

        .user-role { font-size: 13px; font-weight: 600; }

        .btn-logout {
            background: #e83b50;
            color: white;
            border: none;
            padding: 8px 13px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
        }

        .btn-logout:hover {
            background: #c9273d;
            color: white;
        }

        .content { padding: 24px; }

        @media (max-width: 768px) {
            .sidebar { width: 65px; }
            .brand { height: 75px; }
            .brand span { display: none; }
            .sidebar-menu { padding: 15px 7px; }

            .sidebar-menu a {
                justify-content: center;
                padding: 13px 5px;
                font-size: 0;
            }

            .sidebar-menu a i { font-size: 18px; }
            .main-wrapper { margin-left: 65px; }
            .content { padding: 15px; }
            .topbar { padding: 0 12px; }
            .topbar-title { font-size: 13px; }
            .user-avatar { display: none; }
            .user-role { font-size: 11px; }

            .btn-logout {
                padding: 7px 9px;
                font-size: 11px;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

    <div class="sidebar">

        <div class="brand">
            <i class="fas fa-hospital"></i>
            <span>SIM RS</span>
        </div>

        <div class="sidebar-menu">

            <a href="{{ route('dashboard') }}"
               class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="fas fa-house"></i>
                Dashboard
            </a>

            <a href="{{ route('direktur.laporan') }}"
               class="{{ request()->routeIs('direktur.laporan') ? 'active' : '' }}">
                <i class="fas fa-chart-column"></i>
                Laporan
            </a>

        </div>
    </div>

    <div class="main-wrapper">

        <div class="topbar">

            <div>
                <h1 class="topbar-title">
                    @yield('navbar-title', 'Dashboard Direktur')
                </h1>
            </div>

            <div class="topbar-right">

                <div class="user-avatar">
                    <i class="fas fa-user"></i>
                </div>

                <span class="user-role">
                    {{ Auth::user()->name ?? 'Direktur' }}
                </span>

                <form action="{{ route('logout') }}" method="POST" class="m-0">
                    @csrf

                    <button type="submit" class="btn-logout"
                        onclick="return confirm('Apakah Anda yakin ingin keluar?')">
                        <i class="fas fa-right-from-bracket me-1"></i>
                        Logout
                    </button>
                </form>

            </div>
        </div>

        <div class="content">
            @yield('content')
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')

</body>
</html>