@extends('layouts.app')

@section('content')
<div class="page">

    <div class="hero-card result-hero">
        <div class="badge">HASIL KUIS</div>

        <h1>Hasil Kuis Kamu</h1>

        <p>
            Berikut nilai akhir, jumlah jawaban benar, dan detail jawaban kamu.
        </p>
    </div>

    <div class="content-card result-summary-card">
        <div class="score-circle">
            {{ $quizResult->score }}
        </div>

        <h2>{{ $quizResult->correct_count }} / 10 Benar</h2>

        <p>Skor Akhir: {{ $quizResult->score }} / 100</p>

        @if($quizResult->score >= 80)
            <div class="grade-badge excellent">Sangat Baik</div>
        @elseif($quizResult->score >= 60)
            <div class="grade-badge good">Cukup Baik</div>
        @else
            <div class="grade-badge low">Perlu Belajar Lagi</div>
        @endif
    </div>

    <div class="content-card mt-card">
        <div class="section-title">
            <h2>Detail Jawaban</h2>
            <p>
                Jawaban benar ditandai hijau. Jawaban salah yang kamu pilih ditandai merah.
            </p>
        </div>

        @foreach($quizResult->results as $result)
            <div class="result-question-card">
                <div class="result-question-header">
                    <h3>
                        {{ $result['number'] }}. {{ $result['question'] }}
                    </h3>

                    @if($result['is_correct'])
                        <span class="status-correct">✅ Benar</span>
                    @else
                        <span class="status-wrong">❌ Salah</span>
                    @endif
                </div>

                <div class="result-option-list">
                    @foreach($result['options'] as $key => $option)
                        @php
                            $class = '';

                            if ($key === $result['correct_answer']) {
                                $class = 'correct-option';
                            }

                            if ($key === $result['user_answer'] && !$result['is_correct']) {
                                $class = 'wrong-option';
                            }
                        @endphp

                        <div class="result-option {{ $class }}">
                            <span>
                                <b>{{ $key }}.</b> {{ $option }}
                            </span>

                            @if($key === $result['correct_answer'])
                                <span class="option-note">Jawaban benar</span>
                            @endif

                            @if($key === $result['user_answer'])
                                <span class="option-note">Jawaban kamu</span>
                            @endif
                        </div>
                    @endforeach
                </div>

                <div class="answer-info">
                    <p>
                        Jawaban kamu:
                        <b>{{ $result['user_answer'] ?? '-' }}</b>
                    </p>

                    <p>
                        Jawaban benar:
                        <b>{{ $result['correct_answer'] }}</b>
                    </p>
                </div>
            </div>
        @endforeach

        <a href="{{ route('selesai') }}" class="btn-next">
            Lanjut ke Halaman Selesai →
        </a>
    </div>

</div>
@endsection