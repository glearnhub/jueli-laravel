@php
    $palette = ['#102A54', '#DC3545', '#F4B400', '#28A745'];
@endphp

<div class="row row-cols-2 row-cols-md-{{ count($stats) }} g-3 mb-4">
    @foreach ($stats as $i => $stat)
        <div class="col">
            <div class="card stat-card text-center p-3 h-100" style="border-top: 4px solid {{ $palette[$i % count($palette)] }};">
                <h2 class="mb-1">{{ $stat['value'] }}</h2>
                <div class="text-muted">{{ $stat['label'] }}</div>
            </div>
        </div>
    @endforeach
</div>
