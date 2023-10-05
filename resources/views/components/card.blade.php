<div class="govuk-grid-column-one-third">
    <div class="app-card">
        <h2 class="app-card__title">{{ $title }}</h2>
        <div class="app-card__count">Total: {{ $count }}</div>
        @if($chartId ?? null)
            <canvas id="{{ $chartId }}" width="{{ $width ?? '200' }}" height="{{ $height ?? '140' }}"
                    aria-label="{{ $title . ' chart displaying ' . $ariaLabel }}" role="img"
            ></canvas>
        @endif
        @if($count > 0)
            <x-nav-link href="{{$view}}" class="govuk-button">
                Manage
            </x-nav-link>
        @endif
        @if(($new ?? null))
            <x-nav-link href="{{ $new }}" class="govuk-button">
                Add new
            </x-nav-link>
        @endif
    </div>
</div>
