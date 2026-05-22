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
                <div class="number">1</div>
                <div class="objective-text">
                    Ikuti Alur Secara Berurutan
                </div>
            </div>
            <div class="objective-item">
                <div class="number">2</div>
                <div class="objective-text">
                    Cara Menjawab Pertanyaan
                </div>
            </div>
            <div class="objective-item">
                <div class="number">3</div>
                <div class="objective-text">
                    Cara Menggunakan Diagram Pencar
                </div>
            </div>
            <div class="objective-item">
                <div class="number">4</div>
                <div class="objective-text">
                    Cara Berdiskusi
                </div>
            </div>
            <div class="objective-item">
                <div class="number">5</div>
                <div class="objective-text">
                    Cara Membaca Clue
                </div>
            </div>
        </div>

        <a href="{{ route('petunjuk2') }}" class="btn-next">
            Lihat Petunjuk Lanjutan →
        </a>
    </div>

</div>
@endsection