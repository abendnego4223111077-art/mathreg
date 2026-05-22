@php
    $student = \App\Models\Student::find(session('student_id'));

    $currentStep = $student->step ?? 1;

    $steps = [
        1 => ['label' => 'Petunjuk', 'url' => '/petunjuk'],
        2 => ['label' => 'Tujuan', 'url' => '/tujuan'],
        3 => ['label' => 'Pemantik', 'url' => '/pemantik'],
        4 => ['label' => 'Kelompok', 'url' => '/kelompok'],
        5 => ['label' => 'Orientasi', 'url' => '/orientasi'],
        6 => ['label' => 'Orientasi', 'url' => '/presentasi'],
        7 => ['label' => 'Evaluasi', 'url' => '/evaluasi'],
        8 => ['label' => 'LKPD', 'url' => '/lkpd'],
        9 => ['label' => 'Kuis', 'url' => '/kuis '],
        10 => ['label' => 'Selesai', 'url' => '/selesai'],
    ];
@endphp

<div class="topbar">
    <div class="brand">
        MathReg
    </div>

    <div class="user-area">
        <span class="timer" id="timer" data-seconds="{{ session('remaining_seconds', 2700) }}">45:00</span>

        <div class="user-info">
            <span class="group-badge" id="selected-group">{{ $student->group_name ?? session('group') ?? 'Belum memilih' }}</span>
            <span class="username">
                {{ session('student_name') }}
            </span>
        </div>

        <div class="avatar">
            {{ strtoupper(substr(session('student_name'), 0, 1)) }}
        </div>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="logout-btn" type="submit">Logout</button>
        </form>
    </div>
</div>

<div class="stepbar">
    @foreach($steps as $number => $step)
        @if($number < $currentStep)
            <a href="{{ $step['url'] }}" class="step-item done">
                ✓ {{ $step['label'] }}
            </a>
        @elseif($number == $currentStep)
            <a href="{{ $step['url'] }}" class="step-item active">
                {{ $number }} {{ $step['label'] }}
            </a>
        @else
            <span class="step-item locked">
                {{ $number }} {{ $step['label'] }}
            </span>
        @endif
    @endforeach
</div>

<script>
    (function(){
        const timerEl = document.getElementById('timer');
        if(!timerEl) return;

        let seconds = parseInt(timerEl.dataset.seconds, 10) || 2700;

        function formatTime(value){
            const minutes = Math.floor(value / 60).toString().padStart(2, '0');
            const secs = (value % 60).toString().padStart(2, '0');
            return `${minutes}:${secs}`;
        }

        function updateTimer(){
            timerEl.textContent = formatTime(seconds);
        }

        updateTimer();

        const interval = setInterval(() => {
            seconds -= 1;
            if(seconds <= 0){
                seconds = 0;
                updateTimer();
                clearInterval(interval);
                document.dispatchEvent(new CustomEvent('timerEnded'));
                return;
            }
            updateTimer();
        }, 1000);

        const selectedEl = document.getElementById('selected-group');
        function setGroup(name){
            if(!selectedEl) return;
            selectedEl.textContent = name ? `   ${name}` : 'Kelompok: Belum memilih';
        }

        const initialGroup = "{{ $student->group_name ?? session('group') ?? '' }}";
        if(initialGroup){
            try { localStorage.setItem('selectedGroup', initialGroup); } catch (e) {}
            setGroup(initialGroup);
        }

        const storedGroup = localStorage.getItem('selectedGroup');
        if(storedGroup){
            setGroup(storedGroup);
        }

        window.updateSelectedGroup = function(name){
            if(!name) return;
            try { localStorage.setItem('selectedGroup', name); } catch (e) {}
            setGroup(name);
        };

        document.addEventListener('groupSelected', function(event){
            const name = event.detail && event.detail.name;
            if(name){ window.updateSelectedGroup(name); }
        });
    })();
</script>