@extends('layouts.app')

@section('content')
<div class="page">

    <div class="hero-card">
        <div class="badge">4 TUJUAN</div>

        <h1>Apa yang Akan Kamu Pelajari?</h1>

        <p>
            Pada pertemuan ini kamu akan belajar tentang regresi linear
            dan Metode Kuadrat Terkecil melalui aktivitas interaktif.
        </p>
    </div>

    <div class="content-card">
        <div class="objective-item">
            <div class="number">1</div>
            <div class="objective-text">
                Menggunakan persamaan regresi untuk menentukan nilai data yang belum diketahui
            </div>
        </div>
        <div class="objective-item">
            <div class="number">2</div>
            <div class="objective-text">
                Membedakan konsep interpolasi dan ekstrapolasi secara matematis dan kontekstual
            </div>
        </div>
        <div class="objective-item">
            <div class="number">3</div>
            <div class="objective-text">
                Menyajikan hasil prediksi dengan argumentasi matematis yang logis dan tepat
            </div>
        </div>
        <div class="objective-item">
            <div class="number">4</div>
            <div class="objective-text">
                Mengkomunikasikan hasil investigasi melalui diagram, model matematika, dan interpretasi
            </div>
        </div>

        <a href="{{ route('orientasi2') }}" class="btn-next">
            lanjut ke halaman orientasi →
        </a>
    </div>

</div>
@endsection