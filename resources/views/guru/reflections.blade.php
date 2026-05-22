@extends('guru.layout')

@section('content')
<div class="page-header">
    <h1>Jurnal Refleksi Akhir</h1>
    <p>Jawaban refleksi akhir siswa setelah menyelesaikan pembelajaran.</p>
</div>

<div class="content-card">
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Siswa</th>
                    <th>Hal Menarik</th>
                    <th>Masih Kurang Dipahami</th>
                    <th>Penerapan Kehidupan Nyata</th>
                    <th>Waktu Simpan</th>
                </tr>
            </thead>

            <tbody>
                @foreach($reflections as $reflection)
                    <tr>
                        <td>{{ $reflection->student->full_name ?? '-' }}</td>
                        <td>{{ $reflection->most_interesting }}</td>
                        <td>{{ $reflection->still_confused }}</td>
                        <td>{{ $reflection->real_life_application }}</td>
                        <td>{{ $reflection->created_at->format('d M Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection