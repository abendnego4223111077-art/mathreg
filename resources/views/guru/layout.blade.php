<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Guru - MathReg</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #020617;
            color: white;
        }

        a {
            text-decoration: none;
        }

        .teacher-layout {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 260px;
            background: #0f172a;
            border-right: 1px solid #1e293b;
            padding: 24px;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
        }

        .brand {
            font-size: 24px;
            font-weight: bold;
            color: #22d3ee;
            margin-bottom: 6px;
        }

        .role {
            color: #94a3b8;
            margin-bottom: 30px;
            font-size: 14px;
        }

        .menu {
            display: grid;
            gap: 10px;
        }

        .menu a,
        .logout-btn {
            display: block;
            width: 100%;
            background: #111827;
            border: 1px solid #263244;
            color: #cbd5e1;
            padding: 13px 14px;
            border-radius: 12px;
            text-align: left;
            cursor: pointer;
            font-weight: bold;
        }

        .menu a:hover,
        .logout-btn:hover {
            background: rgba(34, 211, 238, 0.12);
            border-color: #22d3ee;
            color: #67e8f9;
        }

        .logout-form {
            margin-top: 20px;
        }

        .logout-btn {
            background: rgba(239, 68, 68, 0.12);
            border-color: rgba(239, 68, 68, 0.4);
            color: #fca5a5;
        }

        .main {
            margin-left: 260px;
            width: calc(100% - 260px);
            padding: 32px;
        }

        .page-header {
            background: linear-gradient(135deg, #0f172a, #111827);
            border: 1px solid #1e293b;
            border-radius: 22px;
            padding: 28px;
            margin-bottom: 26px;
        }

        .page-header h1 {
            margin: 0 0 8px;
            color: #e5e7eb;
        }

        .page-header p {
            margin: 0;
            color: #94a3b8;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 18px;
            margin-bottom: 26px;
        }

        .stat-card {
            background: #0f172a;
            border: 1px solid #1e293b;
            border-radius: 18px;
            padding: 22px;
        }

        .stat-card span {
            color: #94a3b8;
            font-size: 14px;
        }

        .stat-card h2 {
            color: #22d3ee;
            margin: 10px 0 0;
            font-size: 34px;
        }

        .content-card {
            background: #0f172a;
            border: 1px solid #1e293b;
            border-radius: 20px;
            padding: 24px;
            margin-bottom: 24px;
        }

        .content-card h2 {
            margin-top: 0;
            color: #e5e7eb;
        }

        .table-wrapper {
            overflow-x: auto;
            border-radius: 14px;
            border: 1px solid #1e293b;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #111827;
        }

        th {
            background: #0b1220;
            color: #67e8f9;
            padding: 14px;
            text-align: left;
            border-bottom: 1px solid #1e293b;
            white-space: nowrap;
        }

        td {
            padding: 14px;
            color: #cbd5e1;
            border-bottom: 1px solid #1e293b;
            vertical-align: top;
        }

        tr:last-child td {
            border-bottom: none;
        }

        .badge {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 999px;
            background: rgba(34, 211, 238, 0.12);
            color: #67e8f9;
            font-size: 12px;
            font-weight: bold;
        }

        .score-good {
            color: #86efac;
            font-weight: bold;
        }

        .score-mid {
            color: #fde68a;
            font-weight: bold;
        }

        .score-low {
            color: #fca5a5;
            font-weight: bold;
        }

        .answer-box {
            background: rgba(15, 23, 42, 0.8);
            border: 1px solid #263244;
            border-radius: 12px;
            padding: 12px;
            margin-bottom: 10px;
            line-height: 1.6;
        }

        @media (max-width: 900px) {
            .sidebar {
                position: relative;
                width: 100%;
            }

            .teacher-layout {
                display: block;
            }

            .main {
                margin-left: 0;
                width: 100%;
            }

            .stats-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 600px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }

            .main {
                padding: 18px;
            }
        }
    </style>
</head>
<body>

<div class="teacher-layout">

    <aside class="sidebar">
        <div class="brand">MathReg</div>
        <div class="role">Dashboard Guru</div>

        <nav class="menu">
            <a href="{{ route('guru.dashboard') }}">📊 Ringkasan</a>
            <a href="{{ route('guru.students') }}">👥 Siswa</a>
            <a href="{{ route('guru.pemantik') }}">💡 Pemantik</a>
            <a href="{{ route('guru.presentations') }}">🖼️ Presentasi</a>
            <a href="{{ route('guru.lkpds') }}">📘 LKPD</a>
            <a href="{{ route('guru.quizzes') }}">📝 Kuis</a>
            <a href="{{ route('guru.reflections') }}">🌱 Refleksi Akhir</a>
        </nav>

        <form action="{{ route('guru.logout') }}" method="POST" class="logout-form">
            @csrf
            <button class="logout-btn" type="submit">Logout Guru</button>
        </form>
    </aside>

    <main class="main">
        @yield('content')
    </main>

</div>

</body>
</html>