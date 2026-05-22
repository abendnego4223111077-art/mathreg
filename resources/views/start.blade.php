<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MathReg - Mulai</title>
    <style>
        :root {
            --bg: radial-gradient(circle at top, rgba(56, 189, 248, 0.15), transparent 25%),
                   linear-gradient(180deg, #020617 0%, #020617 45%, #051222 100%);
            --sky: #38bdf8;
            --teal: #06d6c7;
            --muted: rgba(255, 255, 255, 0.45);
            --ink: #ffffff;
            --gold: #fbbf24;
            --trans: all 0.2s ease;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            background: #020617;
            color: var(--ink);
            font-family: 'Sora', Arial, sans-serif;
        }

        #s-login {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            overflow: hidden;
            background: var(--bg);
        }

        #s-login::before {
            content: '';
            position: absolute;
            inset: 0;
            z-index: 1;
            pointer-events: none;
            background: radial-gradient(circle at 20% 20%, rgba(56, 189, 248, 0.16), transparent 18%),
                        radial-gradient(circle at 85% 15%, rgba(6, 214, 199, 0.12), transparent 16%),
                        radial-gradient(circle at 50% 80%, rgba(96, 165, 250, 0.08), transparent 22%);
            opacity: 0.95;
            animation: glowPulse 12s ease-in-out infinite alternate;
        }

        @keyframes glowPulse {
            0% { opacity: 0.95; transform: scale(1); }
            100% { opacity: 0.82; transform: scale(1.01); }
        }

        #login-canvas {
            position: absolute;
            inset: 0;
            z-index: 0;
        }

        .login-card {
            position: relative;
            z-index: 2;
            background: rgba(5, 15, 40, 0.85);
            border: 1px solid rgba(56, 189, 248, 0.2);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border-radius: 22px;
            padding: 3rem 2.6rem;
            width: 100%;
            max-width: 460px;
            margin: 1rem;
            box-shadow: 0 0 60px rgba(6, 214, 199, 0.08), 0 30px 60px rgba(0, 0, 0, 0.5);
        }

        .login-logo {
            text-align: center;
            margin-bottom: 2.2rem;
        }

        .logo-ring {
            width: 72px;
            height: 72px;
            border-radius: 18px;
            background: linear-gradient(135deg, var(--sky), var(--teal));
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin-bottom: 1rem;
            box-shadow: 0 0 30px rgba(56, 189, 248, 0.4);
            animation: logoPulse 3s ease-in-out infinite;
        }

        @keyframes logoPulse {
            0%, 100% { box-shadow: 0 0 30px rgba(56, 189, 248, 0.4); }
            50% { box-shadow: 0 0 50px rgba(6, 214, 199, 0.6); }
        }

        .login-logo h1 {
            font-size: 1.8rem;
            font-weight: 800;
            background: linear-gradient(90deg, var(--sky), var(--teal));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin: 0;
        }

        .login-logo p {
            font-size: 0.78rem;
            color: rgba(255, 255, 255, 0.45);
            margin-top: 0.3rem;
        }

        .error-text {
            margin-bottom: 16px;
            padding: 14px 16px;
            border-radius: 12px;
            background: #fee2e2;
            color: #b91c1c;
            font-size: 14px;
        }

        .l-label {
            display: block;
            font-size: 0.72rem;
            font-weight: 700;
            color: var(--muted);
            margin-bottom: 0.45rem;
            letter-spacing: 0.8px;
            text-transform: uppercase;
        }

        .l-input {
            width: 100%;
            padding: 0.8rem 1.1rem;
            border-radius: 9px;
            background: rgba(255, 255, 255, 0.06);
            border: 1.5px solid rgba(255, 255, 255, 0.12);
            color: var(--ink);
            font-family: 'Sora', sans-serif;
            font-size: 0.9rem;
            transition: var(--trans);
            margin-bottom: 1.1rem;
        }

        .l-input:focus {
            outline: none;
            border-color: var(--teal);
            box-shadow: 0 0 0 3px rgba(6, 214, 199, 0.15);
        }

        .l-input::placeholder {
            color: rgba(255, 255, 255, 0.28);
        }

        .login-pertemuan {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.7rem;
            margin-bottom: 1.2rem;
        }

        .p-card {
            padding: 0.9rem 0.7rem;
            border-radius: 10px;
            border: 1.5px solid rgba(255, 255, 255, 0.1);
            background: rgba(255, 255, 255, 0.03);
            cursor: pointer;
            transition: var(--trans);
            text-align: center;
        }

        .p-card:hover {
            background: rgba(56, 189, 248, 0.1);
            border-color: var(--sky);
        }

        .p-card.sel {
            background: rgba(6, 214, 199, 0.12);
            border-color: var(--teal);
            box-shadow: 0 0 16px rgba(6, 214, 199, 0.2);
        }

        .p-card .p-num {
            font-size: 1.4rem;
            font-weight: 800;
            color: var(--gold);
        }

        .p-card .p-lbl {
            font-size: 0.7rem;
            color: rgba(255, 255, 255, 0.5);
            margin-top: 0.25rem;
            line-height: 1.4;
        }

        .p-card .p-soon {
            font-size: 0.6rem;
            color: var(--sky);
            font-weight: 700;
            margin-top: 0.3rem;
        }

        .btn-login {
            width: 100%;
            padding: 0.9rem;
            border-radius: 10px;
            border: none;
            background: linear-gradient(135deg, var(--sky), var(--teal));
            color: white;
            font-family: 'Sora', sans-serif;
            font-size: 0.95rem;
            font-weight: 700;
            cursor: pointer;
            transition: var(--trans);
            letter-spacing: 0.5px;
            box-shadow: 0 4px 24px rgba(6, 214, 199, 0.35);
            margin-top: 0.3rem;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 32px rgba(6, 214, 199, 0.5);
        }

        .btn-login:active {
            transform: none;
        }

        .meeting-card input {
            display: none;
        }
    </style>
</head>
<body>
    <div id="s-login">
        <canvas id="login-canvas"></canvas>
        <div class="login-card">
            <div class="login-logo">
                <div class="logo-ring">M</div>
                <h1>MathReg</h1>
                <p>Pembelajaran Regresi Linear</p>
            </div>

            @if ($errors->any())
                <div class="error-text">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('start.store') }}" method="POST" class="login-form">
                @csrf

                <label class="l-label" for="full_name">Nama Lengkap</label>
                <input
                    id="full_name"
                    type="text"
                    name="full_name"
                    class="l-input"
                    placeholder="Masukkan nama lengkap..."
                    value="{{ old('full_name') }}"
                    required
                >

                <div class="login-pertemuan">
                    <label class="p-card">
                        <input type="radio" name="meeting" value="Pertemuan 1">
                        <div class="p-num">1</div>
                        <div class="p-lbl">Regresi Linear &amp;<br>Kuadrat Terkecil</div>
                    </label>

                    <label class="p-card">
                        <input type="radio" name="meeting" value="Pertemuan 2">
                        <div class="p-num">2</div>
                        <div class="p-lbl">Interpolasi &amp;<br>Ekstrapolasi</div>
                    </label>
                </div>

                <button type="submit" class="btn-login">
                    Mulai Pembelajaran
                </button>
            </form>
        </div>
    </div>

    <script>
        (function() {
            const canvas = document.getElementById('login-canvas');
            if (!canvas || !canvas.getContext) return;

            const ctx = canvas.getContext('2d');
            let width = 0;
            let height = 0;

            const stars = Array.from({ length: 80 }, () => ({
                x: Math.random(),
                y: Math.random(),
                r: 0.5 + Math.random() * 1.3,
                phase: Math.random() * Math.PI * 2,
                speed: 0.001 + Math.random() * 0.002
            }));

            function resize() {
                width = canvas.clientWidth;
                height = canvas.clientHeight;
                canvas.width = width * window.devicePixelRatio;
                canvas.height = height * window.devicePixelRatio;
                ctx.setTransform(window.devicePixelRatio, 0, 0, window.devicePixelRatio, 0, 0);
            }

            function draw(time) {
                ctx.clearRect(0, 0, width, height);
                stars.forEach(star => {
                    const alpha = 0.18 + 0.18 * Math.sin(star.phase + time * star.speed);
                    ctx.beginPath();
                    ctx.fillStyle = `rgba(255, 255, 255, ${alpha})`;
                    ctx.arc(star.x * width, star.y * height, star.r, 0, Math.PI * 2);
                    ctx.fill();
                });
                requestAnimationFrame(draw);
            }

            window.addEventListener('resize', resize);
            resize();
            requestAnimationFrame(draw);
        })();
    </script>
</body>
</html>
