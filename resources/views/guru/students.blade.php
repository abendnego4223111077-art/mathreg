@extends('guru.layout')

@section('content')
<div class="page-header">
    <h1>Daftar Siswa</h1>
    <p>Data semua siswa/pendaftar yang masuk ke aplikasi.</p>
</div>

<div class="content-card">
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Nama Lengkap</th>
                    <th>Pertemuan</th>
                    <th>Kelompok</th>
                    <th>Step Terakhir</th>
                    <th>Daftar Pada</th>
                </tr>
            </thead>

            <tbody>
                @foreach($students as $student)
                    <tr>
                        <td>{{ $student->full_name }}</td>
                        <td>{{ $student->meeting }}</td>
                        <td>{{ $student->group_name ?? '-' }}</td>
                        <td>{{ $student->step }}</td>
                        <td>{{ $student->created_at->format('d M Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection