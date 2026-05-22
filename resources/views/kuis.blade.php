@extends('layouts.app')

@section('content')
<div class="page">

    <div class="hero-card">
        <div class="badge">KUIS AKHIR</div>

        <h1>Uji Pemahamanmu!</h1>

        <p>
            Jawab 10 soal pilihan ganda berikut berdasarkan pembelajaran
            tentang scatter plot, regresi linear, residu, dan OLS.
        </p>
    </div>

    @if ($errors->any())
        <div class="alert-error">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <div class="content-card">
        <form action="{{ route('kuis.submit') }}" method="POST">
            @csrf
            <input type="hidden" name="quiz_variant" value="{{ $quizVariant ?? 1 }}">

            @foreach($questions as $index => $question)
                <div class="quiz-question">
                    <div class="quiz-number">
                        {{ $index + 1 }}
                    </div>

                    <div class="quiz-content">
                        <h3>{{ $question['question'] }}</h3>

                        <div class="option-list">
                            @foreach($question['options'] as $key => $option)
                                <label class="option-item">
                                    <input 
                                        type="radio" 
                                        name="answers[{{ $index }}]" 
                                        value="{{ $key }}"
                                        required
                                    >

                                    <span>
                                        <b>{{ $key }}.</b> {{ $option }}
                                    </span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach

            <button type="submit" class="btn-submit">
                Submit Kuis
            </button>
        </form>
    </div>

</div>
@endsection