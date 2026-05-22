@extends('guru.layout')

@section('content')
<div class="page-header">
    <h1>Jawaban Pemantik</h1>
    <p>Guru dapat melihat jawaban awal siswa sebelum masuk ke aktivitas utama.</p>
</div>

<div class="content-card">
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Siswa</th>
                    <th>Jawaban 1</th>
                    <th>Jawaban 2</th>
                    <th>Jawaban 3</th>
                </tr>
            </thead>

            <tbody>
                @foreach($answers as $answer)
                    <tr>
                        <td>{{ $answer->student->full_name ?? '-' }}</td>
                        <td>{{ $answer->answer_1 }}</td>
                        <td>{{ $answer->answer_2 }}</td>
                        <td>{{ $answer->answer_3 }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection