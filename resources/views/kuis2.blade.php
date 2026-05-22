@extends('layouts.app')

@section('content')
<div class="page page-break">
    <div class="content-page">
        <div class="page-header-bar"><div class="phb-left">Modul Pertemuan 2</div><div class="phb-right">F. Quiz Website — 15 Soal HOTS</div></div>

        <div class="section-banner" style="background:linear-gradient(135deg,#1e3a5f,#1d4ed8);">
            <div class="sb-icon">🎯</div>
            <div class="sb-text"><h2>F. Quiz Website Pertemuan 2</h2><p>10 Soal HOTS · Kontekstual · Berbasis Website · Kunci Jawaban &amp; Pembahasan</p></div>
        </div>

        @if ($errors->any())
            <div class="alert-error">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form action="{{ route('kuis.submit') }}" method="POST">
            @csrf

            @php
                $pages = [
                    [
                        'title' => 'F. Quiz Website — 15 Soal HOTS',
                        'questions' => array_slice($questions, 0, 3),
                        'start' => 0,
                        'footer' => 'Modul 2 · Quiz Website Pertemuan 2',
                    ],
                    [
                        'title' => 'Quiz Website — Lanjutan',
                        'questions' => array_slice($questions, 3, 4),
                        'start' => 3,
                        'footer' => 'Modul 2 · Quiz Website — Soal 4–7',
                    ],
                    [
                        'title' => 'Quiz Website — Soal 8–10',
                        'questions' => array_slice($questions, 7, 3),
                        'start' => 7,
                        'footer' => 'Modul 2 · Quiz Website — Soal 8–10',
                    ],
                ];
            @endphp

            @foreach($pages as $page)
                <div class="page page-break">
                    <div class="content-page">
                        <div class="page-header-bar"><div class="phb-left">Modul Pertemuan 2</div><div class="phb-right">{{ $page['title'] }}</div></div>

                        @foreach($page['questions'] as $offset => $question)
                            @php $index = $page['start'] + $offset; @endphp
                            <div class="quiz-card">
                                <div class="qz-header">
                                    <div class="qz-num" style="background:#eef2ff; color:var(--indigo);">{{ $index + 1 }}</div>
                                    <div>
                                        <div style="font-weight:700; font-size:10pt; color:var(--slate-800);">Soal {{ $index + 1 }}</div>
                                        <div class="qz-meta"><span class="qz-pill type">Pilihan Ganda</span><span class="qz-pill mid">Medium</span></div>
                                    </div>
                                </div>

                                <div class="qz-question">{{ $question['question'] }}</div>

                                <div class="qz-options">
                                    @foreach($question['options'] as $key => $option)
                                        <label class="qz-opt">
                                            <input
                                                type="radio"
                                                name="answers[{{ $index }}]"
                                                value="{{ $key }}"
                                                required
                                            >
                                            <span class="qz-opt-letter">{{ $key }}</span>
                                            {{ $option }}
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach

                        <div class="page-footer-bar"><span>{{ $page['footer'] }}</span><span>Abednego Pradja Tumanggor · SMA Negeri 8 Medan · 2025</span></div>
                    </div>
                </div>
            @endforeach

            <div class="content-card" style="text-align:center; margin-top: 1.5rem;">
                <button type="submit" class="btn-submit">
                    Submit Kuis
                </button>
            </div>
        </form>
    </div>
</div>
@endsection