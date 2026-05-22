@extends('layouts.app')

@section('content')
<div class="page">

    <div class="hero-card">
        <div class="badge">8 TUJUAN</div>

        <h1>Apa yang Akan Kamu Pelajari?</h1>

        <p>
            Pada pertemuan ini kamu akan belajar tentang regresi linear
            dan Metode Kuadrat Terkecil melalui aktivitas interaktif.
        </p>
    </div>

    <div class="content-card">
        @foreach($objectives as $index => $objective)
            <div class="objective-item">
                <div class="number">
                    {{ $index + 1 }}
                </div>

                <div class="objective-text">
                    {{ $objective }}
                </div>
            </div>
        @endforeach
   <a href="{{ route('pemantik') }}" class="btn-next">
          lanjut ke halaman pemantik →
        </a>
    </div>

</div>
@endsection