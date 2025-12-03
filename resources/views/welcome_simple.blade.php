<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perjalanan Dinas - Home</title>
    <link rel="stylesheet" href="/css/design-system.css">
    <style>
        body {
            background: linear-gradient(135deg, var(--color-primary-bg) 0%, var(--color-primary-light) 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: var(--spacing-lg);
        }

        .welcome-container {
            background: var(--color-white);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-xl);
            padding: var(--spacing-3xl);
            width: 100%;
            max-width: 640px;
            text-align: center;
        }

        .welcome-header {
            margin-bottom: var(--spacing-2xl);
        }

        .welcome-header h1 {
            font-size: var(--font-size-3xl);
            color: var(--color-primary-dark);
            margin-bottom: var(--spacing-sm);
        }

        .welcome-header p {
            font-size: var(--font-size-lg);
            color: var(--color-gray-500);
        }

        .button-group {
            display: flex;
            gap: var(--spacing-lg);
            justify-content: center;
            flex-wrap: wrap;
            margin-bottom: var(--spacing-2xl);
        }

        .btn {
            display: inline-block;
            padding: var(--spacing-md) var(--spacing-2xl);
            border-radius: var(--radius-md);
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-size: var(--font-size-base);
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .btn-primary {
            background-color: var(--color-primary);
            color: var(--color-white);
        }

        .btn-primary:hover {
            background-color: var(--color-primary-light);
        }

        .btn-secondary {
            background-color: var(--color-gray-200);
            color: var(--color-gray-700);
        }

        .btn-secondary:hover {
            background-color: var(--color-gray-300);
        }

        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
            gap: var(--spacing-lg);
            margin-top: var(--spacing-2xl);
            padding-top: var(--spacing-2xl);
            border-top: 2px solid var(--color-gray-200);
        }

        .feature {
            padding: var(--spacing-lg);
            background: var(--color-primary-bg);
            border-radius: var(--radius-md);
            transition: all 0.2s ease;
        }

        .feature:hover {
            background: var(--color-gray-50);
            box-shadow: var(--shadow-md);
        }

        .feature-icon {
            font-size: var(--font-size-3xl);
            margin-bottom: var(--spacing-md);
        }

        .feature h3 {
            color: var(--color-primary-dark);
            font-size: var(--font-size-base);
            margin-bottom: var(--spacing-sm);
        }

        .feature p {
            color: var(--color-gray-600);
            font-size: var(--font-size-sm);
            line-height: var(--line-height-normal);
        }

        @media (max-width: 768px) {
            .welcome-container {
                padding: var(--spacing-2xl);
            }

            .welcome-header h1 {
                font-size: var(--font-size-2xl);
            }

            .button-group {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }
        }

        @media (max-width: 480px) {
            .welcome-container {
                padding: var(--spacing-lg);
            }

            .welcome-header h1 {
                font-size: var(--font-size-xl);
            }

            .welcome-header p {
                font-size: var(--font-size-base);
            }

            .features {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="welcome-container">
        <div class="welcome-header">
            <h1>📋 Perjalanan Dinas</h1>
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
