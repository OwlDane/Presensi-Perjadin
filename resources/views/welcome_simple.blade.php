<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perjalanan Dinas - Home</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 1rem;
        }
        .welcome-container {
            background: white;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            padding: 3rem;
            width: 100%;
            max-width: 600px;
            text-align: center;
        }
        .welcome-header {
            margin-bottom: 2rem;
        }
        .welcome-header h1 {
            font-size: 2.5rem;
            color: #2c3e50;
            margin-bottom: 0.5rem;
        }
        .welcome-header p {
            font-size: 1.1rem;
            color: #7f8c8d;
        }
        .button-group {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
            margin-bottom: 2rem;
        }
        .btn {
            display: inline-block;
            padding: 0.875rem 2rem;
            border-radius: 8px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 600;
            transition: all 0.3s;
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
        }
        .btn-secondary {
            background: #ecf0f1;
            color: #2c3e50;
        }
        .btn-secondary:hover {
            background: #bdc3c7;
            transform: translateY(-2px);
        }
        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 2px solid #ecf0f1;
        }
        .feature {
            padding: 1.5rem;
            background: #f8f9fa;
            border-radius: 10px;
            transition: all 0.3s;
        }
        .feature:hover {
            background: #e8f4f8;
            transform: translateY(-5px);
        }
        .feature-icon {
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }
        .feature h3 {
            color: #2c3e50;
            font-size: 1rem;
            margin-bottom: 0.5rem;
        }
        .feature p {
            color: #7f8c8d;
            font-size: 0.85rem;
        }
        @media (max-width: 600px) {
            .welcome-container {
                padding: 2rem;
            }
            .welcome-header h1 {
                font-size: 1.8rem;
            }
            .button-group {
                flex-direction: column;
            }
            .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="welcome-container">
        <div class="welcome-header">
            <h1>📋 Perjadin</h1>
            <p>Sistem Manajemen Perjalanan Dinas ASN/Guru</p>
        </div>

        <div class="button-group">
            @if (auth()->check())
                <a href="{{ route('perjadian.create') }}" class="btn btn-primary">➕ Buat Form Baru</a>
                <a href="{{ route('perjadian.history') }}" class="btn btn-secondary">📚 Lihat Riwayat</a>
                @if(auth()->user()->role === 'admin')
                    <a href="/admin" class="btn btn-secondary">⚙️ Admin Dashboard</a>
                @endif
            @else
                <a href="{{ route('login') }}" class="btn btn-primary">🔐 Login</a>
            @endif
        </div>

        <div class="features">
            <div class="feature">
                <div class="feature-icon">📋</div>
                <h3>Form Mudah</h3>
                <p>Isi formulir dengan interface yang user-friendly</p>
            </div>
            <div class="feature">
                <div class="feature-icon">📊</div>
                <h3>Riwayat</h3>
                <p>Kelola dan pantau status form Anda</p>
            </div>
            <div class="feature">
                <div class="feature-icon">📈</div>
                <h3>Rekap</h3>
                <p>Export data dalam format Excel</p>
            </div>
        </div>
    </div>
</body>
</html>
