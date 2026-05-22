@extends('guru.layout')

@section('content')
<div class="page-header">
    <h1>Presentasi Kelompok</h1>
    <p>Hasil Gallery Walk dari setiap kelompok.</p>
</div>

<div class="content-card">
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Kelompok</th>
                    <th>Hipotesis</th>
                    <th>Pola</th>
                    <th>Kesimpulan</th>
                    <th>Suka</th>
                </tr>
            </thead>

            <tbody>
                @foreach($presentations as $presentation)
                    <tr>
                        <td>
                            <span class="badge">{{ $presentation->group_name }}</span>
                        </td>
                        <td>{{ $presentation->hypothesis }}</td>
                        <td>{{ $presentation->pattern }}</td>
                        <td>{{ $presentation->conclusion }}</td>
                        <td>{{ $presentation->likes->count() }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection