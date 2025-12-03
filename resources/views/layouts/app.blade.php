<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Perjalanan Dinas') - Sistem Perjalanan Dinas</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            color: #333;
        }
        .navbar {
            background-color: #2c3e50;
            padding: 1rem 2rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .navbar a {
            color: white;
            text-decoration: none;
            font-weight: 500;
        }
        .navbar .brand {
            font-size: 1.5rem;
            font-weight: bold;
        }
        .navbar .nav-links {
            display: flex;
            gap: 2rem;
            align-items: center;
        }
        .navbar .nav-links a:hover {
            color: #3498db;
        }
        .navbar .nav-links span {
            color: #ecf0f1;
            font-weight: 600;
            text-shadow: 0 1px 2px rgba(0,0,0,0.3);
        }
        .navbar .nav-links span strong {
            color: #ffffff;
            font-weight: 700;
        }
        .hamburger {
            display: none;
            flex-direction: column;
            cursor: pointer;
            gap: 0.4rem;
        }
        .hamburger span {
            width: 25px;
            height: 3px;
            background-color: white;
            border-radius: 2px;
            transition: all 0.3s ease;
        }
        .hamburger.active span:nth-child(1) {
            transform: rotate(45deg) translate(8px, 8px);
        }
        .hamburger.active span:nth-child(2) {
            opacity: 0;
        }
        .hamburger.active span:nth-child(3) {
            transform: rotate(-45deg) translate(7px, -7px);
        }
        .mobile-menu {
            display: none;
            position: absolute;
            top: 60px;
            right: 0;
            background-color: #2c3e50;
            width: 100%;
            flex-direction: column;
            padding: 1rem 2rem;
            gap: 1rem;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            z-index: 1000;
        }
        .mobile-menu.active {
            display: flex;
        }
        .mobile-menu a,
        .mobile-menu form {
            color: white;
            text-decoration: none;
            padding: 0.75rem 0;
            border-bottom: 1px solid #34495e;
        }
        .mobile-menu a:last-child,
        .mobile-menu form:last-child {
            border-bottom: none;
        }
        .mobile-menu button {
            width: 100%;
            text-align: left;
        }
        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }
        .card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            padding: 2rem;
            margin-bottom: 2rem;
        }
        .btn {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            border-radius: 4px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-size: 1rem;
            transition: all 0.3s;
        }
        .btn-primary {
            background-color: #3498db;
            color: white;
        }
        .btn-primary:hover {
            background-color: #2980b9;
        }
        .btn-secondary {
            background-color: #95a5a6;
            color: white;
        }
        .btn-secondary:hover {
            background-color: #7f8c8d;
        }
        .btn-danger {
            background-color: #e74c3c;
            color: white;
        }
        .btn-danger:hover {
            background-color: #c0392b;
        }
        .btn-success {
            background-color: #27ae60;
            color: white;
        }
        .btn-success:hover {
            background-color: #229954;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }
        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
            font-family: inherit;
        }
        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }
        .alert {
            padding: 1rem;
            border-radius: 4px;
            margin-bottom: 1rem;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .alert-info {
            background-color: #d1ecf1;
            color: #0c5460;
            border: 1px solid #bee5eb;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }
        .table th {
            background-color: #34495e;
            color: white;
            padding: 1rem;
            text-align: left;
        }
        .table td {
            padding: 1rem;
            border-bottom: 1px solid #ddd;
        }
        .table tr:hover {
            background-color: #f9f9f9;
        }
        .badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.875rem;
            font-weight: 500;
        }
        .badge-draft {
            background-color: #95a5a6;
            color: white;
        }
        .badge-submitted {
            background-color: #3498db;
            color: white;
        }
        .badge-approved {
            background-color: #27ae60;
            color: white;
        }
        .badge-rejected {
            background-color: #e74c3c;
            color: white;
        }
        .badge-dalam_kota {
            background-color: #f39c12;
            color: white;
        }
        .badge-luar_kota {
            background-color: #9b59b6;
            color: white;
        }
        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }
        .action-buttons a,
        .action-buttons button {
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
        }
        .pagination {
            display: flex;
            gap: 0.5rem;
            justify-content: center;
            margin-top: 2rem;
        }
        .pagination a,
        .pagination span {
            padding: 0.5rem 0.75rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            text-decoration: none;
            color: #3498db;
        }
        .pagination a:hover {
            background-color: #3498db;
            color: white;
        }
        .pagination .active {
            background-color: #3498db;
            color: white;
            border-color: #3498db;
        }
        .errors {
            background-color: #f8d7da;
            color: #721c24;
            padding: 1rem;
            border-radius: 4px;
            margin-bottom: 1rem;
        }
        .errors ul {
            margin: 0;
            padding-left: 1.5rem;
        }
        .errors li {
            margin-bottom: 0.5rem;
        }
        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
            }
            .navbar {
                position: relative;
                padding: 1rem;
            }
            .navbar .brand {
                font-size: 1.2rem;
            }
            .hamburger {
                display: flex;
            }
            .navbar .nav-links {
                display: none;
            }
            .table {
                font-size: 0.875rem;
            }
            .table th,
            .table td {
                padding: 0.5rem;
            }
        }
    </style>
</head>
<body>
    @auth
    <nav class="navbar">
        <div class="brand">
            <a href="/" style="color: white; text-decoration: none;">📋 Perjadin</a>
        </div>
        <div class="nav-links">
            <span>Halo, <strong>{{ auth()->user()->name }}</strong></span>
            <a href="{{ route('perjadin.create') }}">Form Baru</a>
            <a href="{{ route('perjadin.history') }}">Riwayat</a>
            @if(auth()->user()->role === 'admin')
                <a href="/admin" target="_blank">Admin Dashboard</a>
            @endif
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-secondary" style="padding: 0.5rem 1rem;">Logout</button>
            </form>
        </div>
        <div class="hamburger" id="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </nav>
    <div class="mobile-menu" id="mobileMenu">
        <span style="color: #95a5a6; font-size: 0.9rem;">Halo, <strong>{{ auth()->user()->name }}</strong></span>
        <a href="{{ route('perjadin.create') }}">📝 Form Baru</a>
        <a href="{{ route('perjadin.history') }}">📚 Riwayat</a>
        @if(auth()->user()->role === 'admin')
            <a href="/admin" target="_blank">⚙️ Admin Dashboard</a>
        @endif
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" style="background: none; border: none; color: white; cursor: pointer; padding: 0; font-size: 1rem;">🚪 Logout</button>
        </form>
    </div>
    @endauth

    <div class="container">
        @if ($errors->any())
            <div class="errors">
                <strong>Terjadi kesalahan:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </div>

    <script>
        // Hamburger menu toggle
        const hamburger = document.getElementById('hamburger');
        const mobileMenu = document.getElementById('mobileMenu');

        if (hamburger) {
            hamburger.addEventListener('click', function() {
                hamburger.classList.toggle('active');
                mobileMenu.classList.toggle('active');
            });

            // Close menu when clicking on a link
            const menuLinks = mobileMenu.querySelectorAll('a');
            menuLinks.forEach(link => {
                link.addEventListener('click', function() {
                    hamburger.classList.remove('active');
                    mobileMenu.classList.remove('active');
                });
            });

            // Close menu when clicking outside
            document.addEventListener('click', function(event) {
                if (!event.target.closest('.navbar') && !event.target.closest('.mobile-menu')) {
                    hamburger.classList.remove('active');
                    mobileMenu.classList.remove('active');
                }
            });
        }
    </script>
</body>
</html>
