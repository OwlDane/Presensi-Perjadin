<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Perjalanan Dinas</title>
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

        .login-container {
            background: var(--color-white);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-xl);
            padding: var(--spacing-3xl);
            width: 100%;
            max-width: 420px;
        }

        .login-header {
            text-align: center;
            margin-bottom: var(--spacing-2xl);
        }

        .login-header h1 {
            font-size: var(--font-size-2xl);
            color: var(--color-primary-dark);
            margin-bottom: var(--spacing-sm);
        }

        .login-header p {
            color: var(--color-gray-500);
            font-size: var(--font-size-sm);
        }

        .form-group {
            margin-bottom: var(--spacing-lg);
        }

        .form-group label {
            display: block;
            margin-bottom: var(--spacing-sm);
            font-weight: 500;
            color: var(--color-gray-700);
            font-size: var(--font-size-sm);
        }

        .form-group input {
            width: 100%;
            padding: var(--spacing-md) var(--spacing-lg);
            border: 2px solid var(--color-gray-200);
            border-radius: var(--radius-md);
            font-size: var(--font-size-base);
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .form-group input:focus {
            outline: none;
            border-color: var(--color-primary);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .error-message {
            color: var(--color-error);
            font-size: var(--font-size-sm);
            margin-top: var(--spacing-xs);
        }

        .alert {
            background-color: #fef2f2;
            color: #7f1d1d;
            padding: var(--spacing-lg);
            border-radius: var(--radius-md);
            margin-bottom: var(--spacing-lg);
            border-left: 4px solid var(--color-error);
        }

        .btn-login {
            width: 100%;
            padding: var(--spacing-md) var(--spacing-lg);
            background-color: var(--color-primary);
            color: var(--color-white);
            border: none;
            border-radius: var(--radius-md);
            font-size: var(--font-size-base);
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .btn-login:hover {
            background-color: var(--color-primary-light);
        }

        .btn-login:active {
            background-color: var(--color-primary-dark);
        }

        @media (max-width: 480px) {
            .login-container {
                padding: var(--spacing-2xl);
            }

            .login-header h1 {
                font-size: var(--font-size-xl);
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h1>📋 Login</h1>
            <p>Sistem Perjalanan Dinas ASN/Guru</p>
        </div>

        @if ($errors->any())
            <div class="alert">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
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
                    required 
                    autofocus
                    placeholder="Masukkan NIP Anda"
                >
                @error('nip')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="name">Nama</label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    value="{{ old('name') }}" 
                    required
                    placeholder="Masukkan Nama Anda"
                >
                @error('name')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn-login">Login</button>
        </form>
    </div>
</body>
</html>
