@extends('layouts.app')

@section('content')
<div class="page">

    <div class="hero-card finish-hero">
        <div class="badge">SELESAI</div>

        <h1>🎉 Pertemuan 1 Selesai!</h1>

        <p>
            Kamu telah menyelesaikan pembelajaran tentang
            <b>Regresi Linear dan Metode Kuadrat Terkecil</b>.
        </p>
    </div>

    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert-error">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <!-- PENCAPAIAN -->
    <div class="content-card">
        <div class="section-title">
            <h2>Pencapaianmu Hari Ini</h2>
            <p>Berikut kemampuan yang sudah kamu latih dalam pembelajaran ini.</p>
        </div>

        <div class="achievement-grid">
            <div class="achievement-item">✅ Memahami hubungan dua variabel melalui data bivariat.</div>
            <div class="achievement-item">✅ Mengidentifikasi pola data menggunakan scatter plot.</div>
            <div class="achievement-item">✅ Membuat hipotesis berdasarkan data.</div>
            <div class="achievement-item">✅ Memahami konsep garis perkiraan.</div>
            <div class="achievement-item">✅ Memahami dasar Metode Kuadrat Terkecil atau OLS.</div>
            <div class="achievement-item">✅ Menginterpretasikan slope dan intercept.</div>
            <div class="achievement-item">✅ Membuat prediksi sederhana dengan regresi linear.</div>
            <div class="achievement-item">✅ Menggunakan teknologi digital untuk analisis data.</div>
        </div>
    </div>

    <!-- HASIL AKHIR -->
    <div class="content-card mt-card">
        <div class="section-title">
            <h2>Hasil Akhir Pembelajaran</h2>
            <p>Ringkasan hasil LKPD dan Kuis Akhir.</p>
        </div>

        <div class="final-result-grid">

            <div class="final-result-card">
                <span>Persamaan Regresi OLS</span>

                @if($lkpd && $lkpd->ols_intercept !== null && $lkpd->ols_slope !== null)
                    <h2>
                        ŷ = {{ round($lkpd->ols_intercept, 3) }}
                        + {{ round($lkpd->ols_slope, 3) }}x
                    </h2>
                @else
                    <h2>Belum dihitung</h2>
                @endif

                <p>Persamaan ini berasal dari hasil LKPD individu.</p>
            </div>

            <div class="final-result-card">
                <span>Skor Kuis Akhir</span>

                @if($quizResult)
                    <h2>{{ $quizResult->score }} / 100</h2>
                    <p>{{ $quizResult->correct_count }} dari 10 soal benar.</p>
                @else
                    <h2>Belum ada skor</h2>
                    <p>Siswa belum mengerjakan kuis.</p>
                @endif
            </div>

        </div>
    </div>

    <!-- JURNAL REFLEKSI -->
    <div class="content-card mt-card">
        <div class="section-title">
            <h2>Jurnal Refleksi Akhir</h2>
            <p>
                Tuliskan refleksi pembelajaranmu. Jawaban ini akan disimpan
                dan dapat dilihat kembali oleh guru.
            </p>
        </div>

       <form action="{{ route('final-reflection.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Apa hal paling menarik yang kamu pelajari hari ini?</label>
                <textarea
                    name="most_interesting"
                    rows="4"
                    placeholder="Hal paling menarik yang saya pelajari adalah..."
                    required>{{ old('most_interesting', $finalReflection->most_interesting ?? '') }}</textarea>
            </div>

            <div class="form-group">
                <label>Apa yang masih kurang kamu pahami?</label>
                <textarea
                    name="still_confused"
                    rows="4"
                    placeholder="Hal yang masih kurang saya pahami adalah..."
                    required>{{ old('still_confused', $finalReflection->still_confused ?? '') }}</textarea>
            </div>

            <div class="form-group">
                <label>Bagaimana kamu bisa menerapkan regresi linear di kehidupan nyata?</label>
                <textarea
                    name="real_life_application"
                    rows="4"
                    placeholder="Saya bisa menerapkan regresi linear untuk..."
                    required>{{ old('real_life_application', $finalReflection->real_life_application ?? '') }}</textarea>
            </div>

            <button type="submit" class="btn-submit">
                Simpan Jurnal Refleksi
            </button>
        </form>
    </div>

    <!-- PENUTUP -->
    <div class="content-card mt-card final-message-card">
        <h2>🚀 Pembelajaran Selesai</h2>

        <p>
            Terima kasih sudah mengikuti pembelajaran MathReg.
            Kamu telah menyelesaikan seluruh alur mulai dari petunjuk,
            eksplorasi data, diskusi kelompok, LKPD, hingga kuis akhir.
        </p>

        <div class="next-meeting-box">
            <b>Pertemuan berikutnya:</b>
            Interpolasi dan Ekstrapolasi menggunakan model regresi.
        </div>
    </div>

</div>
@endsection