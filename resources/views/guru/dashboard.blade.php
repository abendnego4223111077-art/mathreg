@extends('guru.layout')

@section('content')
<div class="page-header">
    <h1>Ringkasan Pembelajaran</h1>
    <p>Dashboard ini menampilkan ringkasan aktivitas siswa pada MathReg.</p>
</div>

<div class="stats-grid">
    <div class="stat-card">
        <span>Total Siswa</span>
        <h2>{{ $totalStudents }}</h2>
    </div>

    <div class="stat-card">
        <span>Kelompok Terisi</span>
        <h2>{{ $totalGroups }}</h2>
    </div>

    <div class="stat-card">
        <span>Kuis Dikerjakan</span>
        <h2>{{ $totalQuiz }}</h2>
    </div>

    <div class="stat-card">
        <span>Rata-rata Skor</span>
        <h2>{{ $averageScore }}</h2>
    </div>
</div>

<div class="content-card">
    <h2>Daftar Siswa Terbaru</h2>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Pertemuan</th>
                    <th>Kelompok</th>
                    <th>Step</th>
                    <th>Waktu Daftar</th>
                </tr>
            </thead>

            <tbody>
                @foreach($students as $student)
                    <tr>
                        <td>{{ $student->full_name }}</td>
                        <td>{{ $student->meeting }}</td>
                        <td>
                            @if($student->group_name)
                                <span class="badge">{{ $student->group_name }}</span>
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ $student->step }}</td>
                        <td>{{ $student->created_at->format('d M Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection