@extends('guru.layout')

@section('content')
<div class="page-header">
    <h1>Hasil Kuis</h1>
    <p>Nilai kuis akhir semua siswa.</p>
</div>

<div class="content-card">
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Siswa</th>
                    <th>Benar</th>
                    <th>Skor</th>
                    <th>Detail Jawaban</th>
                    <th>Waktu Submit</th>
                </tr>
            </thead>

            <tbody>
                @foreach($quizzes as $quiz)
                    <tr>
                        <td>{{ $quiz->student->full_name ?? '-' }}</td>

                        <td>{{ $quiz->correct_count }} / 10</td>

                        <td>
                            @if($quiz->score >= 80)
                                <span class="score-good">{{ $quiz->score }}</span>
                            @elseif($quiz->score >= 60)
                                <span class="score-mid">{{ $quiz->score }}</span>
                            @else
                                <span class="score-low">{{ $quiz->score }}</span>
                            @endif
                        </td>

                        <td>
                            @foreach($quiz->results as $result)
                                <div class="answer-box">
                                    <b>{{ $result['number'] }}. {{ $result['question'] }}</b><br>
                                    Jawaban siswa:
                                    <b>{{ $result['user_answer'] ?? '-' }}</b><br>
                                    Jawaban benar:
                                    <b>{{ $result['correct_answer'] }}</b><br>

                                    @if($result['is_correct'])
                                        <span class="score-good">Benar</span>
                                    @else
                                        <span class="score-low">Salah</span>
                                    @endif
                                </div>
                            @endforeach
                        </td>

                        <td>{{ $quiz->created_at->format('d M Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection