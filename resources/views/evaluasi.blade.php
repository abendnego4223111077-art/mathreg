@extends('layouts.app')

@section('content')
<div class="page">

    <div class="hero-card">
        <div class="badge">EVALUASI & PENGUATAN</div>

        <h1>Penguatan Konsep oleh Guru</h1>

        <p>
            Setelah melakukan diskusi dan Gallery Walk, sekarang kita kuatkan kembali
            konsep utama dalam regresi linear dan Metode Kuadrat Terkecil.
        </p>
    </div>

    <div class="content-card">

        <div class="section-title">
            <h2>Materi Konsep Utama</h2>
            <p>
                Klik tombol tambah pada setiap konsep untuk membuka penjelasan lengkap.
            </p>
        </div>

        <div class="concept-list">
            @foreach($concepts as $concept)
                <div class="concept-row" onclick="openConceptModal({{ $concept['id'] }})">
                    <div class="concept-left">
                        <div class="concept-icon">
                            {{ $concept['icon'] }}
                        </div>

                        <div>
                            <h3>Konsep {{ $concept['id'] }}: {{ $concept['title'] }}</h3>
                            <p>{{ $concept['short'] }}</p>
                        </div>
                    </div>

                    <button type="button" class="plus-btn">
                        +
                    </button>
                </div>
            @endforeach
        </div>

       
 <a href="{{ route('lkpd') }}" class="btn-next">
            lanjut ke halaman lkpd →
        </a>
    </div>
    </div>

</div>

<!-- MODAL POPUP -->
<div class="concept-modal-overlay" id="conceptModal" style="display: none;">
    <div class="concept-modal-box">
        <button class="concept-modal-close" onclick="closeConceptModal()">×</button>

        <div class="concept-modal-header">
            <div class="concept-modal-icon" id="modalIcon">📘</div>

            <div>
                <h2 id="modalTitle">Judul Konsep</h2>
                <p id="modalSubtitle">Penjelasan singkat konsep</p>
            </div>
        </div>

        <div class="modal-body">
            <p id="modalDescription"></p>

            <div id="modalFormulaArea"></div>

            <div class="modal-note" id="modalNote"></div>
        </div>
    </div>
</div>

<script>
    const conceptData = {
        1: {
            icon: '📈',
            title: 'Konsep 1: Regresi Linear',
            subtitle: 'Model garis lurus untuk menjelaskan hubungan dua variabel.',
            description: 'Regresi linear sederhana digunakan untuk memodelkan hubungan antara variabel bebas X dan variabel terikat Y. Model ini membantu kita melihat kecenderungan data dan membuat prediksi sederhana.',
            formula: `
                <div class="single-formula-box">
                    <h3>ŷ = a + bx</h3>
                    <p>a = intercept | b = slope</p>
                </div>
            `,
            note: `
                <p><b>ŷ</b> adalah nilai prediksi Y.</p>
                <p><b>a</b> adalah nilai Y ketika X = 0.</p>
                <p><b>b</b> menunjukkan perubahan Y setiap X naik 1 satuan.</p>
            `
        },

        2: {
            icon: '📍',
            title: 'Konsep 2: Residu',
            subtitle: 'Selisih antara nilai aktual dan nilai prediksi.',
            description: 'Residu menunjukkan seberapa jauh titik data sebenarnya dari garis prediksi. Semakin kecil residu secara keseluruhan, semakin baik garis tersebut mewakili data.',
            formula: `
                <div class="single-formula-box">
                    <h3>e = y - ŷ</h3>
                    <p>residu = nilai aktual - nilai prediksi</p>
                </div>
            `,
            note: `
                <p>Jika titik berada di atas garis, residu bernilai positif.</p>
                <p>Jika titik berada di bawah garis, residu bernilai negatif.</p>
            `
        },

        3: {
            icon: '🧮',
            title: 'Konsep 3: Metode Kuadrat Terkecil (OLS)',
            subtitle: 'Metode mencari garis terbaik dengan meminimalkan jumlah kuadrat error.',
            description: 'OLS atau Ordinary Least Squares mencari nilai slope dan intercept sehingga jumlah kuadrat selisih antara nilai aktual dan nilai prediksi menjadi sekecil mungkin.',
            formula: `
                <div class="formula-grid">
                    <div class="formula-card">
                        <h3>b = (nΣxy − Σx·Σy) / (nΣx² − (Σx)²)</h3>
                        <p>Slope — kemiringan garis regresi</p>
                    </div>

                    <div class="formula-card">
                        <h3>a = ȳ − b·x̄</h3>
                        <p>Intercept — titik potong sumbu Y</p>
                    </div>
                </div>
            `,
            note: `
                <p><b>Slope (b):</b> perubahan rata-rata Y ketika X naik 1 satuan.</p>
                <p><b>Intercept (a):</b> nilai prediksi Y ketika X = 0.</p>
                <p><b>Contoh:</b> Jika ŷ = 0,01 + 0,165x, maka setiap kenaikan 1 km/jam kecepatan, jarak tempuh naik rata-rata 0,165 km.</p>
            `
        },

        4: {
            icon: '🔎',
            title: 'Konsep 4: Interpretasi Koefisien',
            subtitle: 'Membaca makna slope dan intercept dalam konteks masalah.',
            description: 'Interpretasi koefisien berarti menjelaskan arti angka dalam persamaan regresi sesuai konteks data. Dalam kasus kecepatan dan jarak, slope menunjukkan perubahan jarak tempuh akibat kenaikan kecepatan.',
            formula: `
                <div class="single-formula-box">
                    <h3>ŷ = 0,01 + 0,165x</h3>
                    <p>Contoh model regresi linear</p>
                </div>
            `,
            note: `
                <p><b>0,165</b> berarti setiap kecepatan naik 1 km/jam, jarak tempuh diprediksi naik sekitar 0,165 km.</p>
                <p><b>0,01</b> adalah nilai awal model ketika kecepatan bernilai 0.</p>
                <p>Interpretasi harus selalu dikaitkan dengan konteks data.</p>
            `
        }
    };

    function openConceptModal(id) {
        const data = conceptData[id];

        document.getElementById('modalIcon').innerText = data.icon;
        document.getElementById('modalTitle').innerText = data.title;
        document.getElementById('modalSubtitle').innerText = data.subtitle;
        document.getElementById('modalDescription').innerText = data.description;
        document.getElementById('modalFormulaArea').innerHTML = data.formula;
        document.getElementById('modalNote').innerHTML = data.note;

        document.getElementById('conceptModal').style.display = 'flex';
    }

    function closeConceptModal() {
        document.getElementById('conceptModal').style.display = 'none';
    }

    document.getElementById('conceptModal').addEventListener('click', function(event) {
        if (event.target === this) {
            closeConceptModal();
        }
    });
</script>
@endsection