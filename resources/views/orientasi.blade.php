@extends('layouts.app')

@section('content')
<div class="page">

    <div class="hero-card">
        <div class="badge">ORIENTASI MASALAH</div>

        <h1>Memahami Situasi Masalah</h1>

        <p>
            Pada tahap ini kamu akan membaca skenario masalah,
            mengamati data, dan mengenali konsep kunci sebelum masuk
            ke aktivitas analisis.
        </p>
    </div>

    @if(session('error'))
        <div class="alert-error">
            {{ session('error') }}
        </div>
    @endif

    <div class="content-card">

        <div class="scenario-box">
            <div class="scenario-label">SKENARIO MASALAH</div>

            <h2>Kecepatan Sepeda dan Jarak Tempuh</h2>

            <p>
                Seorang siswa melakukan percobaan sederhana menggunakan sepeda.
                Siswa tersebut mencatat kecepatan sepeda dalam satuan km/jam
                dan jarak tempuh dalam waktu tertentu.
            </p>

            <p>
                Data hasil percobaan digunakan untuk melihat apakah terdapat
                hubungan antara kecepatan sepeda dan jarak tempuh.
            </p>

            <div class="big-question">
                ❓ Dapatkah kita menemukan model matematika untuk memperkirakan
                jarak tempuh berdasarkan kecepatan sepeda?
            </div>
        </div>

        <div class="section-title">
            <h2>Data Percobaan</h2>
            <p>Amati pasangan data X dan Y berikut.</p>
        </div>

        <div class="table-wrapper">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>X — Kecepatan Sepeda</th>
                        <th>Y — Jarak Tempuh</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($data as $index => $row)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $row['x'] }} km/jam</td>
                            <td>{{ $row['y'] }} km</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="section-title">
            <h2>Konsep Kunci</h2>
            <p>Beberapa konsep yang akan digunakan dalam pembelajaran ini.</p>
        </div>

        <div class="concept-grid">
            @foreach($concepts as $concept)
                <div class="concept-card">
                    <h3>{{ $concept['title'] }}</h3>
                    <p>{{ $concept['description'] }}</p>
                </div>
            @endforeach
        </div>

        
 <a href="{{ route('presentasi') }}" class="btn-next">
            lanjut ke halaman presentasi →
        </a>

    </div>

</div>
@endsection