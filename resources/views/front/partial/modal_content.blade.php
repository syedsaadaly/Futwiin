<div class="prediction-details">
    <div class="row">
        <div class="col-md-6">
            <h4>{{ $prediction->team1->name }} vs {{ $prediction->team2->name }}</h4>
            <p><strong>League:</strong> {{ $prediction->league?->title ?? 'FIFA Club World Cup' }}</p>
            <p><strong>Date:</strong> {{ $prediction->match_date->format('M d, Y') }}</p>
            <p class="time-with-status">
                <strong>Time:</strong>
                {{ \Carbon\Carbon::parse($prediction->match_time)->format('g:i A') }} ({{ $prediction->getTimezoneAbbreviation() }})
                @if($prediction->isLive())
                    <span class="live-status-modal">
                        <span class="live-pulse-modal"></span>
                        LIVE
                    </span>
                @endif
            </p>
        </div>
    </div>

    <hr>

    <div class="prediction-analysis">
        <h5>Analysis</h5>
        <p>{{ $prediction->text }}</p>

        @if($prediction->analysis)
        <div class="mt-3">
            {!! $prediction->analysis !!}
        </div>
        @endif
    </div>
</div>
