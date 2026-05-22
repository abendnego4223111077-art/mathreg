<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Guru - MathReg</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #020617;
            color: white;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            width: 420px;
            max-width: 92%;
            background: #0f172a;
            border: 1px solid #1e293b;
            border-radius: 22px;
            padding: 30px;
        }

        h1 {
            color: #22d3ee;
            margin: 0 0 8px;
        }

        p {
            color: #94a3b8;
        }

        input {
            width: 100%;
            background: #111827;
            border: 1px solid #334155;
            color: white;
            padding: 14px;
            border-radius: 12px;
            margin-top: 14px;
        }

        button {
            width: 100%;
            background: linear-gradient(90deg, #22d3ee, #14b8a6);
            border: none;
            color: #001;
            padding: 14px;
            border-radius: 12px;
            margin-top: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        .error {
            background: rgba(239, 68, 68, 0.12);
            border: 1px solid rgba(239, 68, 68, 0.4);
            color: #fca5a5;
            padding: 12px;
            border-radius: 12px;
            margin-top: 14px;
        }
    </style>
</head>
<body>

<div class="login-card">
    <h1>Login Guru</h1>
    <p>Masuk untuk melihat data pembelajaran siswa.</p>

    @if(session('error'))
        <div class="error">{{ session('error') }}</div>
    @endif

    @if ($errors->any())
        <div class="error">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form action="{{ route('guru.login.submit') }}" method="POST">
        @csrf

        <input type="password" name="password" placeholder="Password Guru" required>

        <button type="submit">Masuk Dashboard</button>
    </form>
</div>

</body>
</html>