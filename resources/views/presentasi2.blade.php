@extends('layouts.app')

@section('content')
<div class="page">

    <div class="hero-card">
        <div class="badge">GALLERY WALK</div>

        <h1>Presentasi Hasil Kelompok</h1>

        <p>
            Publikasikan hasil diskusi kelompokmu, lalu lihat hasil kelompok lain.
            Kamu juga bisa memberi apresiasi dengan tombol suka.
        </p>
    </div>

    @if ($errors->any())
        <div class="alert-error">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="content-card presentation-wizard">
        <div class="steps-pill">
            <button type="button" class="step-pill active" data-step="1" onclick="goSubStep(1)">1. Hipotesis Awal</button>
            <button type="button" class="step-pill" data-step="2" onclick="goSubStep(2)">2. Diagram Pencar</button>
            <button type="button" class="step-pill" data-step="3" onclick="goSubStep(3)">3. Identifikasi Masalah</button>
        </div>

        <form action="{{ route('presentasi.store') }}" method="POST" id="presentationForm">
            @csrf

            <div class="sub-page active" id="sp-1">
                <div class="ph" style="background:linear-gradient(135deg,rgba(7,18,37,.9),rgba(6,214,199,.06));border:1px solid rgba(6,214,199,.1);">
                    <div class="ph-tag">💬 Langkah 2 — Hipotesis Awal</div>
                    <div class="ph-title">Apa Dugaanmu?</div>
                    <div class="ph-sub">Berdasarkan skenario dan data di atas, tuliskan hipotesis awalmu. Apa yang kamu duga akan terjadi?</div>
                </div>

                <div class="gcard">
                    <div class="gcard-head"><div class="gcard-title">📝 Hipotesis Kelompok</div></div>
                    <div class="gcard-body">
                        <div class="fgroup">
                            <label class="flabel">Hipotesis awal kelompokmu tentang hubungan kecepatan dan jarak</label>
                            <textarea class="finput" id="hip-input" name="hypothesis" rows="4"
                                placeholder="Kelompok kami menduga bahwa semakin tinggi kecepatan sepeda, maka..." required>{{ old('hypothesis', $myPresentation->hypothesis ?? '') }}</textarea>
                        </div>
                        <button type="button" class="btn btn-teal btn-block" onclick="goSubStep(2)">📤 Lanjut ke Diagram Pencar</button>
                    </div>
                </div>
            </div>

            <div class="sub-page" id="sp-2">
                <div class="ph" style="background:linear-gradient(135deg,rgba(7,18,37,.9),rgba(251,191,36,.06));border:1px solid rgba(251,191,36,.1);">
                    <div class="ph-tag">📊 Langkah 3 — Diagram Pencar</div>
                    <div class="ph-title">Visualisasikan Data!</div>
                    <div class="ph-sub">Amati pola titik-titik data pada diagram pencar. Apa yang kamu lihat?</div>
                </div>

                <div class="gcard">
                    <div class="gcard-head"><div class="gcard-title">📊 Scatter Plot — Data Kelompok</div></div>
                    <div class="gcard-body">
                        <div style="margin-bottom:.8rem;display:flex;gap:.6rem;flex-wrap:wrap;">
                            <button type="button" class="btn btn-sky btn-sm" onclick="plotOrientasi()">🔵 Tampilkan Titik Data</button>
                            <button type="button" class="btn btn-teal btn-sm" onclick="plotGarisOrientasi()">📏 Tampilkan Garis Perkiraan</button>
                            <button type="button" class="btn btn-ghost btn-sm" onclick="resetOrientasi()">↺ Reset</button>
                        </div>
                        <canvas id="scatter-orientasi" width="820" height="280" style="width:100%;height:auto;"></canvas>
                    </div>
                </div>

                <div class="gcard">
                    <div class="gcard-head"><div class="gcard-title">🤔 Refleksi Diagram Pencar</div></div>
                    <div class="gcard-body">
                        <div class="fgroup">
                            <label class="flabel">Apa hubungan yang kelompokmu lihat dari hasil diagram pencar?</label>
                            <textarea class="finput" id="scatter-refleksi" name="pattern" rows="3"
                                placeholder="Dari diagram pencar, kelompok kami melihat bahwa..." required>{{ old('pattern', $myPresentation->pattern ?? '') }}</textarea>
                        </div>
                        <div class="fgroup">
                            <label class="flabel">Apakah titik-titik data membentuk pola linear? Diskusikan dan jelaskan!</label>
                            <textarea class="finput" id="scatter-linear" name="conclusion" rows="3"
                                placeholder="Menurut kelompok kami..." required>{{ old('conclusion', $myPresentation->conclusion ?? '') }}</textarea>
                        </div>
                    </div>
                </div>

                <div style="display:flex;justify-content:space-between;flex-wrap:wrap;gap:12px;">
                    <button type="button" class="btn btn-ghost btn-sm" onclick="goSubStep(1)">← Kembali</button>
                    <button type="button" class="btn btn-sky btn-sm" onclick="goSubStep(3)">Lanjut ke Identifikasi Masalah →</button>
                </div>
            </div>

            <div class="sub-page" id="sp-3">
                <div class="ph" style="background:linear-gradient(135deg,rgba(7,18,37,.9),rgba(167,139,250,.08));border:1px solid rgba(167,139,250,.15);">
                    <div class="ph-tag">🧩 Langkah 4 — Identifikasi Masalah</div>
                    <div class="ph-title">Temukan Clue Tersembunyi! 🌱</div>
                    <div class="ph-sub">Kamu hanya bisa membuka <strong>4 dari 7 clue</strong> yang tersedia. Pilih dengan bijak! Clue ini akan membantumu memahami ide dasar regresi linear.</div>
                </div>

                <div class="clue-counter">
                    <span style="font-size:1.1rem;">🔑</span>
                    <div>
                        <div class="cc-label" id="clue-counter-text">0 / 4 Clue Dibuka</div>
                        <div style="font-size:.68rem;color:rgba(255,255,255,.35);">Klik kartu untuk membuka clue</div>
                    </div>
                    <div class="cc-dots" id="clue-dots">
                        <div class="cc-dot" id="cd-0"></div>
                        <div class="cc-dot" id="cd-1"></div>
                        <div class="cc-dot" id="cd-2"></div>
                        <div class="cc-dot" id="cd-3"></div>
                    </div>
                </div>

                <div class="gcard" style="margin-bottom:1rem;">
                    <div class="gcard-body">
                        <div style="font-size:.84rem;font-weight:600;color:#e2e7ef;margin-bottom:.4rem;">❓ Pertanyaan yang harus dijawab:</div>
                        <div style="font-size:.8rem;color:rgba(255,255,255,.7);line-height:1.7;">
                            1. Bisakah dibuat satu garis yang mewakili semua titik? Mengapa?<br>
                            2. Mengapa ada titik yang dekat dengan garis dan ada yang jauh?<br>
                            3. Bagaimana cara mengukur "jarak" antara titik data dengan garis?
                        </div>
                    </div>
                </div>

                <div class="clue-grid" id="clue-grid"></div>

                <div class="gcard" style="margin-top:1rem;">
                    <div class="gcard-head"><div class="gcard-title">📝 Kesimpulanmu dari Clue yang Dibuka</div></div>
                    <div class="gcard-body">
                        <div class="fgroup">
                            <label class="flabel">Berdasarkan clue yang dibuka, apa kesimpulan kelompokmu tentang hubungan data ini?</label>
                            <textarea class="finput" id="clue-kesimpulan" rows="3"
                                placeholder="Berdasarkan clue yang kami buka, kelompok kami menyimpulkan bahwa..."></textarea>
                        </div>
                    </div>
                </div>

                <div style="display:flex;justify-content:space-between;flex-wrap:wrap;gap:12px;margin-top:1rem;">
                    <button type="button" class="btn btn-ghost btn-sm" onclick="goSubStep(2)">← Kembali</button>
                    <button type="button" class="btn btn-teal btn-lg" onclick="submitPresentation()">
                        🖼️ Publikasikan Hasil & Lihat Gallery Walk →
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div class="content-card gallery-card">
        <div class="section-title">
            <h2>Gallery Walk</h2>
            <p>
                Semua hasil kelompok yang sudah dipublikasikan akan muncul di sini.
            </p>
        </div>

        @if($presentations->count() === 0)
            <div class="empty-state">
                Belum ada kelompok yang mempublikasikan hasil.
            </div>
        @else
            <div class="presentation-grid">
                @foreach($presentations as $presentation)
                    <div class="presentation-card {{ $presentation->group_name === $student->group_name ? 'my-group-card' : '' }}">
                        <div class="presentation-header">
                            <h3>Kelompok {{ $presentation->group_name }}</h3>

                            @if($presentation->group_name === $student->group_name)
                                <span class="joined-badge">Kelompokmu</span>
                            @endif
                        </div>

                        <div class="presentation-section">
                            <h4>Hipotesis</h4>
                            <p>{{ $presentation->hypothesis }}</p>
                        </div>

                        <div class="presentation-section">
                            <h4>Pola Diagram Pencar</h4>
                            <p>{{ $presentation->pattern }}</p>
                        </div>

                        <div class="presentation-section">
                            <h4>Kesimpulan</h4>
                            <p>{{ $presentation->conclusion }}</p>
                        </div>

                        <div class="like-row">
                            <form action="{{ route('presentasi.like', $presentation->id) }}" method="POST">
                                @csrf

                                <button 
                                    type="submit" 
                                    class="like-btn {{ in_array($presentation->id, $likedPresentationIds) ? 'liked' : '' }}"
                                    {{ in_array($presentation->id, $likedPresentationIds) ? 'disabled' : '' }}
                                >
                                    💙 Suka
                                </button>
                            </form>

                            <span>
                                {{ $presentation->likes->count() }} suka
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="content-card" style="margin-top:1.5rem; text-align:right;">
            <a href="{{ route('presentasi3') }}" class="btn-next">
                Lanjut ke Presentasi 3 →
            </a>
        </div>
    </div>
</div>

<script>
    function goSubStep(step) {
        document.querySelectorAll('.sub-page').forEach(function(el) {
            el.classList.remove('active');
        });
        document.querySelectorAll('.step-pill').forEach(function(el) {
            el.classList.remove('active');
        });
        const target = document.getElementById('sp-' + step);
        if (target) {
            target.classList.add('active');
        }
        const pill = document.querySelector('.step-pill[data-step="' + step + '"]');
        if (pill) {
            pill.classList.add('active');
        }
    }

    function submitPresentation() {
        document.getElementById('presentationForm').submit();
    }

    const orientations = [
        {x:6,y:1.0},
        {x:8,y:1.3},
        {x:10,y:1.7},
        {x:12,y:2.0},
        {x:14,y:2.3}
    ];

    function plotOrientasi() {
        const canvas = document.getElementById('scatter-orientasi');
        if (!canvas) return;
        const ctx = canvas.getContext('2d');
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        ctx.fillStyle = '#22d3ee';
        const pad = 40;
        const w = canvas.width - pad * 2;
        const h = canvas.height - pad * 2;
        const xs = orientations.map(o => o.x);
        const ys = orientations.map(o => o.y);
        const minX = Math.min(...xs);
        const maxX = Math.max(...xs);
        const minY = Math.min(...ys);
        const maxY = Math.max(...ys);
        const axisColor = '#334155';
        ctx.strokeStyle = axisColor;
        ctx.lineWidth = 1;
        ctx.beginPath();
        ctx.moveTo(pad, pad);
        ctx.lineTo(pad, canvas.height - pad);
        ctx.lineTo(canvas.width - pad, canvas.height - pad);
        ctx.stroke();
        orientations.forEach(function(point) {
            const x = pad + ((point.x - minX) / (maxX - minX)) * w;
            const y = canvas.height - pad - ((point.y - minY) / (maxY - minY)) * h;
            ctx.beginPath();
            ctx.arc(x, y, 6, 0, Math.PI * 2);
            ctx.fill();
        });
    }

    function plotGarisOrientasi() {
        plotOrientasi();
        const canvas = document.getElementById('scatter-orientasi');
        if (!canvas) return;
        const ctx = canvas.getContext('2d');
        const pad = 40;
        const xs = orientations.map(o => o.x);
        const ys = orientations.map(o => o.y);
        const minX = Math.min(...xs);
        const maxX = Math.max(...xs);
        const minY = Math.min(...ys);
        const maxY = Math.max(...ys);
        const m = 0.14;
        const b = 0.2;
        const x1 = pad;
        const y1 = canvas.height - pad - ((m * minX + b - minY) / (maxY - minY)) * (canvas.height - pad * 2);
        const x2 = canvas.width - pad;
        const y2 = canvas.height - pad - ((m * maxX + b - minY) / (maxY - minY)) * (canvas.height - pad * 2);
        ctx.strokeStyle = '#facc15';
        ctx.lineWidth = 3;
        ctx.beginPath();
        ctx.moveTo(x1, y1);
        ctx.lineTo(x2, y2);
        ctx.stroke();
    }

    function resetOrientasi() {
        const canvas = document.getElementById('scatter-orientasi');
        if (!canvas) return;
        const ctx = canvas.getContext('2d');
        ctx.clearRect(0, 0, canvas.width, canvas.height);
    }

    const clues = [
        {title: 'Clue 1', text: 'Data menunjukkan bahwa ketika X naik, Y juga cenderung naik.'},
        {title: 'Clue 2', text: 'Terdapat beberapa titik yang berjauhan dari garis utama.'},
        {title: 'Clue 3', text: 'Pola garis menunjukkan hubungan positif antara kedua variabel.'},
        {title: 'Clue 4', text: 'Nilai Y lebih kecil pada beberapa titik meski X besar.'},
        {title: 'Clue 5', text: 'Ada titik yang berada di bawah dan di atas garis perkiraan.'},
        {title: 'Clue 6', text: 'Clue ini membantu menjelaskan jarak titik ke garis.'},
        {title: 'Clue 7', text: 'Semakin konsisten pola titik, semakin baik garisnya mewakili data.'}
    ];
    let openedClues = 0;
    const maxClues = 4;

    function renderClues() {
        const grid = document.getElementById('clue-grid');
        grid.innerHTML = '';
        clues.forEach(function(clue, index) {
            const card = document.createElement('div');
            card.className = 'clue-card';
            card.setAttribute('data-index', index);
            card.onclick = function() { openClue(index); };
            const title = document.createElement('h4');
            title.textContent = clue.title;
            const desc = document.createElement('p');
            desc.textContent = openedClues > index ? clue.text : 'Klik untuk membuka clue.';
            card.appendChild(title);
            card.appendChild(desc);
            if (openedClues > index) {
                card.classList.add('opened');
                const small = document.createElement('small');
                small.textContent = 'Clue terbuka';
                card.appendChild(small);
            }
            grid.appendChild(card);
        });
        const text = document.getElementById('clue-counter-text');
        if (text) {
            text.textContent = openedClues + ' / ' + maxClues + ' Clue Dibuka';
        }
        for (let i = 0; i < maxClues; i++) {
            const dot = document.getElementById('cd-' + i);
            if (dot) {
                dot.classList.toggle('active', i < openedClues);
            }
        }
    }

    function openClue(index) {
        if (openedClues >= maxClues && index >= openedClues) {
            return;
        }
        if (index < openedClues) {
            return;
        }
        openedClues = Math.min(maxClues, index + 1);
        renderClues();
    }

    renderClues();
</script>
@endsection