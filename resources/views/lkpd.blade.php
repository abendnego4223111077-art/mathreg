@extends('layouts.app')

@section('content')
<div class="page">

    <div class="hero-card">
        <div class="badge">LKPD INDIVIDU</div>

        <h1>LKPD Regresi Linear</h1>

        <p>
            Kerjakan LKPD secara individu. Amati data, buat scatter plot,
            geser garis manual, lalu hitung persamaan regresi menggunakan OLS.
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

    @if(session('error'))
        <div class="alert-error">
            {{ session('error') }}
        </div>
    @endif

    <!-- BAGIAN 1: DATA -->
    <div class="content-card">
        <div class="section-title">
            <h2>Bagian 1 — Tabel Data</h2>
            <p>Lengkapi pemahamanmu dengan memperhatikan nilai X, Y, X², dan XY.</p>
        </div>

        <div class="table-wrapper">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>X</th>
                        <th>Y</th>
                        <th>X²</th>
                        <th>XY</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($data as $index => $row)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $row['x'] }}</td>
                            <td>{{ $row['y'] }}</td>
                            <td>{{ $row['x2'] }}</td>
                            <td>{{ $row['xy'] }}</td>
                        </tr>
                    @endforeach

                    <tr class="total-row">
                        <td><b>Σ</b></td>
                        <td><b>{{ $totals['sum_x'] }}</b></td>
                        <td><b>{{ $totals['sum_y'] }}</b></td>
                        <td><b>{{ $totals['sum_x2'] }}</b></td>
                        <td><b>{{ $totals['sum_xy'] }}</b></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- BAGIAN 2: REFLEKSI SCATTER -->
    <div class="content-card mt-card">
        <div class="section-title">
            <h2>Bagian 2 — Analisis Awal</h2>
            <p>Jawab pertanyaan berdasarkan data yang kamu lihat.</p>
        </div>

        <form action="{{ route('lkpd.scatter') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Apa pola yang terlihat dari data X dan Y?</label>
                <textarea 
                    name="scatter_pattern" 
                    rows="4" 
                    placeholder="Dari data tersebut, saya melihat bahwa..."
                    required>{{ old('scatter_pattern', $lkpd->scatter_pattern ?? '') }}</textarea>
            </div>

            <div class="form-group">
                <label>Apakah hubungan antara X dan Y terlihat linear?</label>
                <textarea 
                    name="scatter_relation" 
                    rows="4" 
                    placeholder="Menurut saya hubungan data tersebut..."
                    required>{{ old('scatter_relation', $lkpd->scatter_relation ?? '') }}</textarea>
            </div>

            <button type="submit" class="btn-submit">
                Simpan Analisis Awal
            </button>
        </form>
    </div>

    <!-- BAGIAN 3: SCATTER PLOT DAN GARIS MANUAL -->
     




    <div class="content-card mt-card">
        <div class="scard" style="animation-delay:.2s">
            <div class="s-bg-num">03</div>
            <div class="stag t3">📊 Bagian 3 — Diagram Pencar</div>
            <div class="stitle">Buat Diagram Pencarmu!</div>
            <p class="sdesc">Klik setiap tombol data point di bawah secara berurutan untuk memplotnya pada diagram. Amati pola yang muncul!</p>

            <div class="pt-ctrl">
                <span class="pt-ctrl-lbl">Plot titik:</span>
                <button class="ptbtn" id="ptbtn0" type="button" onclick="plotPoint(0)">P1 (6, 1.0)</button>
                <button class="ptbtn" id="ptbtn1" type="button" onclick="plotPoint(1)" disabled>P2 (8, 1.3)</button>
                <button class="ptbtn" id="ptbtn2" type="button" onclick="plotPoint(2)" disabled>P3 (10, 1.7)</button>
                <button class="ptbtn" id="ptbtn3" type="button" onclick="plotPoint(3)" disabled>P4 (12, 2.0)</button>
                <button class="ptbtn" id="ptbtn4" type="button" onclick="plotPoint(4)" disabled>P5 (14, 2.3)</button>
                <button class="btn btn-ghost" type="button" onclick="resetPoints()" style="padding:6px 14px;font-size:12px;margin-left:auto">↺ Reset</button>
            </div>

            <div class="cv-wrap">
                <canvas id="cv1" height="300"></canvas>
            </div>

            <div class="dvr"></div>
        </div>

        <div class="scatter-form">
            <div class="section-title">
                <h2>Bagian 3 — Analisis Garis Manual</h2>
                <p>Geser nilai intercept dan slope untuk membuat garis perkiraanmu sendiri.</p>
            </div>

            <div class="chart-box">
                <canvas id="scatterChart"></canvas>
            </div>

            <div class="slider-grid">
                <div class="slider-box">
                    <label>Intercept (a): <span id="interceptLabel">0.50</span></label>
                    <input type="range" id="interceptSlider" min="0" max="2" step="0.01" value="{{ $lkpd->manual_intercept ?? 0.50 }}">
                </div>

                <div class="slider-box">
                    <label>Slope (b): <span id="slopeLabel">0.120</span></label>
                    <input type="range" id="slopeSlider" min="0" max="1" step="0.001" value="{{ $lkpd->manual_slope ?? 0.120 }}">
                </div>
            </div>

            <div class="equation-box">
                <span>Persamaan Garis Manual</span>
                <h2 id="equationText">ŷ = 0.50 + 0.120x</h2>
            </div>

            <form action="{{ route('lkpd.manual-line') }}" method="POST">
                @csrf

                <input type="hidden" name="manual_intercept" id="manualInterceptInput">
                <input type="hidden" name="manual_slope" id="manualSlopeInput">

                <div class="form-group">
                    <label>Mengapa kamu memilih garis tersebut?</label>
                    <textarea 
                        name="manual_line_reason" 
                        rows="4" 
                        placeholder="Saya memilih garis ini karena..."
                        required>{{ old('manual_line_reason', $lkpd->manual_line_reason ?? '') }}</textarea>
                </div>

                <div class="form-group">
                    <label>Apakah ada titik yang jauh dari garis? Jelaskan.</label>
                    <textarea 
                        name="outlier_reason" 
                        rows="4" 
                        placeholder="Menurut saya..."
                        required>{{ old('outlier_reason', $lkpd->outlier_reason ?? '') }}</textarea>
                </div>

                <button type="submit" class="btn-submit">
                    Simpan Garis Manual
                </button>
            </form>
        </div>
    </div>

    <!-- BAGIAN 4: HITUNG OLS -->
    <div class="content-card mt-card">
        <div class="section-title">
            <h2>Bagian 4 — Hitung OLS</h2>
            <p>
                Masukkan nilai jumlah data, lalu sistem akan menghitung slope dan intercept OLS.
            </p>
        </div>

        <form action="{{ route('lkpd.ols') }}" method="POST">
            @csrf

            <div class="ols-grid">
                <div class="form-group">
                    <label>Σx</label>
                    <input 
                        type="number" 
                        step="0.01" 
                        name="sum_x" 
                        value="{{ old('sum_x', $lkpd->sum_x ?? '') }}"
                        placeholder="Contoh: 50"
                        required>
                </div>

                <div class="form-group">
                    <label>Σy</label>
                    <input 
                        type="number" 
                        step="0.01" 
                        name="sum_y" 
                        value="{{ old('sum_y', $lkpd->sum_y ?? '') }}"
                        placeholder="Contoh: 8.3"
                        required>
                </div>

                <div class="form-group">
                    <label>Σx²</label>
                    <input 
                        type="number" 
                        step="0.01" 
                        name="sum_x2" 
                        value="{{ old('sum_x2', $lkpd->sum_x2 ?? '') }}"
                        placeholder="Contoh: 540"
                        required>
                </div>

                <div class="form-group">
                    <label>Σxy</label>
                    <input 
                        type="number" 
                        step="0.01" 
                        name="sum_xy" 
                        value="{{ old('sum_xy', $lkpd->sum_xy ?? '') }}"
                        placeholder="Contoh: 89.6"
                        required>
                </div>
            </div>

            <button type="submit" class="btn-submit">
                🧮 Hitung OLS Otomatis
            </button>
        </form>

        @if($lkpd && $lkpd->ols_intercept !== null && $lkpd->ols_slope !== null)
            <div class="ols-result-box">
                <span>Hasil Regresi OLS</span>

                <h2>
                    ŷ = {{ round($lkpd->ols_intercept, 3) }} + {{ round($lkpd->ols_slope, 3) }}x
                </h2>

                <p>
                    Artinya, setiap kenaikan 1 satuan X diprediksi menaikkan Y sebesar
                    {{ round($lkpd->ols_slope, 3) }}.
                </p>
            </div>
        @endif

<a href="{{ route('kuis2') }}" class="btn-next">
            lanjut ke halaman kuis →
        </a>
    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
// ================= DATA AWAL =================
const dataPoints = [
    {x: 6, y: 1.0},
    {x: 8, y: 1.3},
    {x: 10, y: 1.7},
    {x: 12, y: 2.0},
    {x: 14, y: 2.3}
];

const pointButtons = [
    document.getElementById('ptbtn0'),
    document.getElementById('ptbtn1'),
    document.getElementById('ptbtn2'),
    document.getElementById('ptbtn3'),
    document.getElementById('ptbtn4')
];

const plottedData = [];

const cvCtx = document.getElementById('cv1');
const pointChart = new Chart(cvCtx, {
    type: 'scatter',
    data: {
        datasets: [
            {
                label: 'Titik Plot',
                data: [],
                backgroundColor: '#22d3ee',
                pointRadius: 6
            }
        ]
    },
    options: {
        plugins: {
            legend: { display: false }
        },
        scales: {
            x: {
                type: 'linear',
                title: { display: true, text: 'X', color: '#94a3b8' },
                ticks: { color: 'white' },
                grid: { color: 'rgba(148,163,184,0.15)' }
            },
            y: {
                title: { display: true, text: 'Y', color: '#94a3b8' },
                ticks: { color: 'white' },
                grid: { color: 'rgba(148,163,184,0.15)' }
            }
        }
    }
});

function updatePointButtons() {
    pointButtons.forEach((button, index) => {
        button.disabled = index !== plottedData.length;
    });
}

function plotPoint(index) {
    if (index !== plottedData.length) {
        return;
    }

    plottedData.push(dataPoints[index]);
    pointChart.data.datasets[0].data = [...plottedData];
    pointChart.update();
    updatePointButtons();
}

function resetPoints() {
    plottedData.length = 0;
    pointChart.data.datasets[0].data = [];
    pointChart.update();
    updatePointButtons();
}

resetPoints();

// ================= MANUAL LINE CHART =================
const manualCtx = document.getElementById('scatterChart');
const manualChart = new Chart(manualCtx, {
    type: 'scatter',
    data: {
        datasets: [
            {
                label: 'Data',
                data: dataPoints,
                backgroundColor: '#22d3ee'
            },
            {
                label: 'Garis (Manual)',
                data: [],
                type: 'line',
                borderColor: '#facc15',
                borderWidth: 2,
                fill: false,
                pointRadius: 0
            }
        ]
    },
    options: {
        plugins: {
            legend: {
                labels: {
                    color: 'white'
                }
            }
        },
        scales: {
            x: {
                ticks: { color: 'white' },
                grid: { color: 'rgba(148,163,184,0.15)' }
            },
            y: {
                ticks: { color: 'white' },
                grid: { color: 'rgba(148,163,184,0.15)' }
            }
        }
    }
});

const slopeSlider = document.getElementById('slopeSlider');
const interceptSlider = document.getElementById('interceptSlider');
const slopeLabel = document.getElementById('slopeLabel');
const interceptLabel = document.getElementById('interceptLabel');
const equationText = document.getElementById('equationText');
const manualInterceptInput = document.getElementById('manualInterceptInput');
const manualSlopeInput = document.getElementById('manualSlopeInput');

function updateManualLine() {
    const m = parseFloat(slopeSlider.value);
    const b = parseFloat(interceptSlider.value);

    slopeLabel.innerText = m.toFixed(3);
    interceptLabel.innerText = b.toFixed(2);
    equationText.innerText = `ŷ = ${b.toFixed(2)} + ${m.toFixed(3)}x`;
    manualInterceptInput.value = b;
    manualSlopeInput.value = m;

    const xValues = dataPoints.map(p => p.x);
    const minX = Math.min(...xValues);
    const maxX = Math.max(...xValues);

    manualChart.data.datasets[1].data = [
        {x: minX, y: m * minX + b},
        {x: maxX, y: m * maxX + b}
    ];
    manualChart.update();
}

slopeSlider.addEventListener('input', updateManualLine);
interceptSlider.addEventListener('input', updateManualLine);

updateManualLine();
</script>
@endsection