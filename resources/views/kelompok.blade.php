@extends('layouts.app')

@section('content')
<div class="page">

    <div class="hero-card">
        <div class="badge">PEMBENTUKAN KELOMPOK</div>

        <h1>Pilih Kelompok Belajarmu</h1>

        <p>
            Klik tombol acak otomatis untuk bergabung ke salah satu kelompok.
            Sistem akan memilih kelompok yang masih memiliki slot kosong.
        </p>
    </div>

    @if(session('error'))
        <div class="alert-error">
            {{ session('error') }}
        </div>
    @endif

    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="content-card">

        <div class="group-action">
            @if(!$student->group_name)
                <form action="{{ route('kelompok.random') }}" method="POST">
                    @csrf

                    <button type="submit" class="btn-submit">
                        🎲 Acak Otomatis
                    </button>
                </form>
            @else
                <div class="joined-info">
                    Kamu sudah bergabung di 
                    <b>Kelompok {{ $student->group_name }}</b>
                </div>
            @endif
        </div>

        <div class="group-grid">
            @foreach($groups as $group)
                <div class="group-card {{ $student->group_name === $group['name'] ? 'selected' : '' }}">
                    <div class="group-header">
                        <h3>Kelompok {{ $group['name'] }}</h3>

                        @if($student->group_name === $group['name'])
                            <span class="joined-badge">Bergabung</span>
                        @endif
                    </div>

                    <p class="member-count">
                        {{ $group['count'] }} / {{ $group['max'] }} anggota
                    </p>

                    <div class="progress-track">
                        <div 
                            class="progress-fill"
                            style="width: {{ ($group['count'] / $group['max']) * 100 }}%">
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if($student->group_name)
            <div class="members-section">
                <h2>Anggota Kelompok {{ $student->group_name }}</h2>

                <div class="member-list">
                    @foreach($members as $member)
                        <div class="member-item">
                            <div class="mini-avatar">
                                {{ strtoupper(substr($member->full_name, 0, 1)) }}
                            </div>

                            <span>
                                {{ $member->full_name }}

                                @if($member->id === $student->id)
                                    <b>(Kamu)</b>
                                @endif
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>

            <a href="{{ route('orientasi') }}" class="btn-next">
                  lanjut ke halaman orientasi →
        </a>
    </div>
        @endif

    </div>

</div>

@if(session('group_joined'))
    <div class="modal-overlay" id="groupModal">
        <div class="modal-box">
            <button class="modal-close" onclick="closeGroupModal()">×</button>

            <div class="modal-icon">🎉</div>

            <h2>Selamat Bergabung!</h2>

            <p>
                Kamu sudah terdaftar di 
                <b>Kelompok {{ session('group_joined') }}</b>
            </p>

            <div class="modal-members">
                <h3>Anggota Kelompok</h3>

                @foreach($members as $member)
                    <div class="member-item">
                        <div class="mini-avatar">
                            {{ strtoupper(substr($member->full_name, 0, 1)) }}
                        </div>

                        <span>
                            {{ $member->full_name }}

                            @if($member->id === $student->id)
                                <b>(Kamu)</b>
                            @endif
                        </span>
                    </div>
                @endforeach
            </div>

            <button class="btn-submit" onclick="closeGroupModal()">
                Oke, Mengerti
            </button>
        </div>
    </div>
@endif

<script>
    function closeGroupModal() {
        const modal = document.getElementById('groupModal');

        if (modal) {
            modal.style.display = 'none';
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const groupName = "{{ $student->group_name ?? session('group_joined') ?? '' }}";

        if (groupName) {
            try {
                localStorage.setItem('selectedGroup', groupName);
            } catch (e) {
                // ignore storage errors
            }

            if (window.updateSelectedGroup) {
                window.updateSelectedGroup(groupName);
            }

            const event = new CustomEvent('groupSelected', {
                detail: { name: groupName }
            });
            document.dispatchEvent(event);
        }
    });
</script>
@endsection