@extends('layouts.app')

@section('content')
<div class="page">

    <div class="content-card">
        <h3 class="mod-h3" style="margin-bottom:10px;">Fase 1 — Orientasi Masalah</h3>

        <div class="scenario-box">
            <div class="sb-tag">🌱 Studi Kasus A — Konteks Pertanian</div>
            <h3>Prediksi Panen: Berapa Ton Jika Pupuk 160 kg/ha?</h3>

            <p>
                Seorang peneliti pertanian memiliki data hubungan antara jumlah pupuk
                (kg/ha) dan hasil panen padi (ton/ha) dari 8 musim tanam. Dengan menggunakan
                model regresi, peneliti ingin memprediksi hasil panen untuk dosis pupuk yang
                belum pernah dicoba, yaitu <strong>160 kg/ha</strong> dan <strong>300 kg/ha</strong>.
            </p>

            <table class="data-t">
                <thead>
                    <tr>
                        <th>n</th>
                        <th>Pupuk x (kg/ha)</th>
                        <th>Panen ŷ (ton/ha)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td>1</td><td>50</td><td>2.1</td></tr>
                    <tr><td>2</td><td>75</td><td>2.8</td></tr>
                    <tr><td>3</td><td>100</td><td>3.4</td></tr>
                    <tr><td>4</td><td>125</td><td>4.0</td></tr>
                    <tr><td>5</td><td>150</td><td>4.5</td></tr>
                    <tr><td>6</td><td>175</td><td>5.1</td></tr>
                    <tr><td>7</td><td>200</td><td>5.6</td></tr>
                    <tr><td>8</td><td>225</td><td>6.0</td></tr>
                </tbody>
            </table>
        </div>

        <div class="big-question" style="margin-top:16px;">
            Pertanyaan Pemandu Investigasi: Apakah prediksi pada x = 160 dan x = 300 sama-sama dapat dipercaya?
            Apa yang membedakannya? Apa risiko menggunakan model regresi untuk nilai yang sangat jauh dari rentang data?
        </div>

        <div class="section-title" style="margin-top:24px;">
            <h2>📚 Konsep Kunci yang Perlu Diketahui</h2>
            <p>📐 Konsep: Interpolasi vs Ekstrapolasi</p>
        </div>

        <div class="concept-table" style="margin-top:16px;">
            <div class="concept-row concept-header">
                <div>Interpolasi</div>
                <div>Ekstrapolasi</div>
            </div>
            <div class="concept-row">
                <div>Prediksi untuk nilai x yang berada di dalam rentang data observasi (xmin ≤ x ≤ xmax)</div>
                <div>Prediksi untuk nilai x yang berada di luar rentang data observasi (x < xmin atau x > xmax)</div>
            </div>
            <div class="concept-row">
                <div>Tingkat kepercayaan lebih tinggi karena model dibangun dari data dalam rentang tersebut</div>
                <div>Tingkat kepercayaan lebih rendah karena model belum tentu berlaku di luar rentang data</div>
            </div>
        </div>

        <a href="{{ route('presentasi') }}" class="btn-next" style="margin-top:24px;">
            lanjut ke halaman presentasi →
        </a>
    </div>

</div>
@endsection