@extends('guru.layout')

@section('content')
<div class="page-header">
    <h1>LKPD Individu</h1>
    <p>Guru dapat melihat hasil analisis, garis manual, dan OLS siswa.</p>
</div>

<div class="content-card">
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Siswa</th>
                    <th>Analisis Scatter</th>
                    <th>Garis Manual</th>
                    <th>OLS</th>
                    <th>Alasan</th>
                </tr>
            </thead>

            <tbody>
                @foreach($lkpds as $lkpd)
                    <tr>
                        <td>{{ $lkpd->student->full_name ?? '-' }}</td>

                        <td>
                            <div class="answer-box">
                                <b>Pola:</b><br>
                                {{ $lkpd->scatter_pattern }}
                            </div>

                            <div class="answer-box">
                                <b>Relasi:</b><br>
                                {{ $lkpd->scatter_relation }}
                            </div>
                        </td>

                        <td>
                            @if($lkpd->manual_intercept !== null && $lkpd->manual_slope !== null)
                                ŷ = {{ round($lkpd->manual_intercept, 3) }}
                                + {{ round($lkpd->manual_slope, 3) }}x
                            @else
                                -
                            @endif
                        </td>

                        <td>
                            @if($lkpd->ols_intercept !== null && $lkpd->ols_slope !== null)
                                ŷ = {{ round($lkpd->ols_intercept, 3) }}
                                + {{ round($lkpd->ols_slope, 3) }}x
                            @else
                                -
                            @endif
                        </td>

                        <td>
                            <div class="answer-box">
                                <b>Alasan garis:</b><br>
                                {{ $lkpd->manual_line_reason }}
                            </div>

                            <div class="answer-box">
                                <b>Titik jauh:</b><br>
                                {{ $lkpd->outlier_reason }}
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection