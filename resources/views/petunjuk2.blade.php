@extends('layouts.app')

@section('content')
<div class="page">

    <div class="hero-card">
        <div class="badge">ONBOARDING</div>

        <h1>Petunjuk Penggunaan MathReg</h1>

        <p>
            Baca petunjuk sebelum memulai pembelajaran.
            Ikuti setiap tahap secara berurutan sampai selesai.
        </p>
    </div>

    <div class="content-card">
        <div class="objective-item-group">
            <div class="objective-item">
                <div class="number">6</div>
                <div class="objective-text">
                    Cara Mengisi LKPD digital
                </div>
            </div>
            <div class="objective-item">
                <div class="number">7</div>
                <div class="objective-text">
                    Cara Menggunakan Tabel
                </div>
            </div>
            <div class="objective-item">
                <div class="number">8</div>
                <div class="objective-text">
                    Cara Menggunakan Grafik
                </div>
            </div>
            <div class="objective-item">
                <div class="number">9</div>
                <div class="objective-text">
                    Cara Menarik Kesimpulan
                </div>
            </div>
        </div>

        <div class="objective-item">
            <div class="number">10</div>
            <div class="objective-text">
                Cara Menyelesaikan Kuis
            </div>
        </div>

        <div class="button-row">
            <a href="{{ route('petunjuk') }}" class="btn-next">
                Kembali ke Petunjuk 1-5
            </a>
            <a href="{{ route('tujuan2') }}" class="btn-next">
                Mulai Perjalanan Pembelajaran →
            </a>
        </div>
    </div>

</div>
@endsection