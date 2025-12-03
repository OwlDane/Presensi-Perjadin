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

        .login-form {
            background: var(--color-primary-bg);
            padding: var(--spacing-2xl);
            border-radius: var(--radius-md);
            margin-top: var(--spacing-2xl);
            text-align: left;
        }

        .form-group {
            margin-bottom: var(--spacing-lg);
        }

        .form-group label {
            display: block;
            margin-bottom: var(--spacing-sm);
            color: var(--color-gray-700);
            font-weight: 500;
            font-size: var(--font-size-base);
        }

        .form-group input {
            width: 100%;
            padding: var(--spacing-md);
            border: 1px solid var(--color-gray-300);
            border-radius: var(--radius-md);
            font-size: var(--font-size-base);
            transition: all 0.2s ease;
            box-sizing: border-box;
        }

        .form-group input:focus {
            outline: none;
            border-color: var(--color-primary);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .form-errors {
            background-color: #fee;
            border: 1px solid #fcc;
            color: #c33;
            padding: var(--spacing-md);
            border-radius: var(--radius-md);
            margin-bottom: var(--spacing-lg);
            font-size: var(--font-size-sm);
        }

        .form-errors ul {
            margin: 0;
            padding-left: var(--spacing-lg);
        }

        .form-errors li {
            margin-bottom: var(--spacing-sm);
        }

        .login-button {
            width: 100%;
            padding: var(--spacing-md);
            background-color: var(--color-primary);
            color: var(--color-white);
            border: none;
            border-radius: var(--radius-md);
            font-size: var(--font-size-base);
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .login-button:hover {
            background-color: var(--color-primary-light);
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
            <h1>Perjalanan Dinas</h1>
            <p>Sistem Manajemen Perjalanan Dinas ASN/Guru</p>
        </div>

        @if (auth()->check())
            <div class="button-group">
                <a href="{{ route('perjadin.create') }}" class="btn btn-primary">➕ Buat Form Baru</a>
                <a href="{{ route('perjadin.history') }}" class="btn btn-secondary">📚 Lihat Riwayat</a>
                @if(auth()->user()->role === 'admin')
                    <a href="/admin" class="btn btn-secondary">⚙️ Admin Dashboard</a>
                @endif
            </div>
        @else
            <div class="login-form">
                @if ($errors->any())
                    <div class="form-errors">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    
                    <div class="form-group">
                        <label for="nip">NIP</label>
                        <input 
                            type="text" 
                            id="nip" 
                            name="nip" 
                            value="{{ old('nip') }}"
                            placeholder="Masukkan NIP Anda"
                            required
                            autofocus
                        >
                    </div>

                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input 
                            type="text" 
                            id="name" 
                            name="name" 
                            value="{{ old('name') }}"
                            placeholder="Masukkan Nama Anda"
                            required
                        >
                    </div>

                    <button type="submit" class="login-button">Login</button>
                </form>
            </div>
        @endif

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
