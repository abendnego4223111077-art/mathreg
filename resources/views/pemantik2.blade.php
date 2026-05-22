@extends('layouts.app')

@section('content')
<div class="page">

    <div class="hero-card">
        <div class="badge">PERTANYAAN PEMANTIK</div>

        <h1>Ayo Mulai Berpikir!</h1>

        <p>
            Jawab pertanyaan berikut berdasarkan pemahaman awalmu.
            Jawaban ini akan disimpan dan dapat dilihat kembali.
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

    <div class="content-card">
          <form action="{{ route('pemantik.store') }}" method="POST">
            @csrf

            <div class="question-block">
                <div class="question-number">1</div>

                <div class="question-content">
                    <h3>
                      Berdasarkan persamaan regresi ŷ = a + bx yang diperoleh di pertemuan 1, dapatkah kamu memprediksi nilai untuk x yang belum ada di data? Bagaimana caranya?
                    </h3>

                    <p class="hint">
                        Tuliskan pendapat awalmu sebelum melihat data lebih lanjut.
                    </p>

                    <textarea 
                        name="answer_1" 
                        rows="5" 
                        placeholder="Menurut saya..."
                        required>{{ old('answer_1', $answer->answer_1 ?? '') }}</textarea>
                </div>
            </div>

            <div class="question-block">
                <div class="question-number">2</div>

                <div class="question-content">
                    <h3>
Menurutmu, apakah prediksi akan lebih akurat untuk nilai x yang dekat dengan rentang data asli, ataukah yang jauh di luar rentang? Mengapa demikian?                     </h3>

                    <p class="hint">
                        Jelaskan apakah jarak akan bertambah, berkurang, atau tidak berubah.
                    </p>

                    <textarea 
                        name="answer_2" 
                        rows="5" 
                        placeholder="Saya menduga bahwa..."
                        required>{{ old('answer_2', $answer->answer_2 ?? '') }}</textarea>
                </div>
            </div>

          
            </div>

            <button type="submit" class="btn-submit">
                Simpan Jawaban Pemantik
            </button>
        </form>
    </div>
   <a href="{{ route('orientasi') }}" class="btn-next">
            lanjut pilih  kelompok →
        </a>
    </div>
</div>
@endsection